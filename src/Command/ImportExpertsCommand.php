<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Pimcore\Model\DataObject\WebsiteUser;
use Pimcore\Model\DataObject\City;
use Pimcore\Model\Asset;
use Pimcore\Model\Asset\Folder;

#[AsCommand(
    name: 'chowzter:import-experts',
    description: 'Import experts into Chowzter'
)]
class ImportExpertsCommand extends AbstractCommand
{
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $io = new SymfonyStyle($input, $output);

        $data = require PIMCORE_PROJECT_ROOT . '/public/experts_data_full_with_slug.php';

        if (!is_array($data)) {
            $io->error('experts.php must return an array.');
            return self::FAILURE;
        }

        /*
         * Get or create Experts asset folder
         */
        $assetFolder = Asset::getByPath('/expert-profile-photos');

        if (!$assetFolder) {
            $assetFolder = new Folder();

            $assetFolder->setKey('expert-profile-photos');
            $assetFolder->setParentId(1);
            $assetFolder->save();

            $io->text('Created /expert-profile-photos asset folder');
        }
        $expertsFolder = Folder::getByPath('/Experts');

        $created = 0;
        $updated = 0;
        $failed = 0;
        $imagesImported = 0;

        foreach ($data as $index => $row) {

            try {

                /*
                 * Validate required fields
                 */
                if (empty($row['name'])) {
                    $io->warning(
                        "Row {$index}: Expert name is missing."
                    );

                    $failed++;
                    continue;
                }

                $name = trim($row['name']);

                $handle = !empty($row['slug'])
                    ? trim($row['slug'])
                    : strtolower(
                        preg_replace(
                            '/[^a-z0-9]+/i',
                            '-',
                            $name
                        )
                    );

                /*
                 * Find existing Expert by handle
                 */
                $listing = new WebsiteUser\Listing();

                $listing->setCondition(
                    'handle = ?',
                    [$handle]
                );

                $listing->setLimit(1);

                $expert = $listing->current();

                /*
                 * Create Expert if it doesn't exist
                 */
                if (!$expert) {

                    $expert = new WebsiteUser();

                    $expert->setKey($handle);
                    $expert->setPublished(true);
                    $expert->setParentId(426);
                    $expert->setIsExpert(1);
                    $expert->setIsActive(1);

                    $created++;

                    $io->text(
                        "Creating: {$name}"
                    );

                } else {

                    $updated++;

                    $io->text(
                        "Updating: {$name}"
                    );
                }

                /*
                 * Split name into first / last name
                 *
                 * Example:
                 * Dinner Stories
                 * firstname = Dinner
                 * lastname  = Stories
                 */
                $nameParts = preg_split(
                    '/\s+/',
                    $name,
                    -1,
                    PREG_SPLIT_NO_EMPTY
                );

                $firstname = $nameParts[0] ?? '';
                $lastname = '';

                if (count($nameParts) > 1) {
                    $lastname = implode(
                        ' ',
                        array_slice($nameParts, 1)
                    );
                }

                $expert->setFirstname($firstname);
                $expert->setLastname($lastname);

                /*
                 * Handle
                 */
                $expert->setHandle($handle);

                /*
                 * Random 3-4 line bio
                 */
                $expert->setBio(
                    $this->generateRandomBio($name)
                );

                /*
                 * Country Object Relation
                 *
                 * Adjust "code" if your Country object uses
                 * another field for the country code.
                 */
                if (!empty($row['city'])) {

                    $countryListing = new City\Listing();

                    $countryListing->setCondition(
                        'name = ?',
                        [$row['city']]
                    );

                    $countryListing->setLimit(1);

                    $country = $countryListing->current();

                    if ($country) {

                        $expert->setCity($country);

                    } else {

                        $io->warning(
                            "Country '{$row['city']}' " .
                            "not found for {$name}"
                        );
                    }
                }

                /*
                 * Profile image
                 */
                if (!empty($row['img'])) {

                    $asset = $this->importRandomAvatar(
                        $handle,
                        $assetFolder,
                        $io
                    );

                    if ($asset) {
                        $expert->setAvatar($asset);
                        $imagesImported++;
                    }

                    if ($asset) {

                        /*
                         * Change this if your Pimcore field
                         * has a different name.
                         */
                        $expert->setAvatar($asset);

                        $imagesImported++;
                    }
                }

                /*
                 * Save Expert
                 */
                $expert->save();

            } catch (\Throwable $e) {

                $failed++;

                $io->error(
                    "Failed to import {$row['name']}: " .
                    $e->getMessage()
                );
            }
        }

        $io->success([
            'Expert import completed.',
            "Created: {$created}",
            "Updated: {$updated}",
            "Images imported: {$imagesImported}",
            "Failed: {$failed}",
        ]);

        return $failed > 0
            ? self::FAILURE
            : self::SUCCESS;
    }


    /**
     * Download and create Pimcore image asset.
     */
    private function importImage(
        string $url,
        string $handle,
        Folder $assetFolder,
        SymfonyStyle $io
    ): ?Asset\Image {

        try {

            $imageData = @file_get_contents($url);

            if ($imageData === false) {

                $io->warning(
                    "Unable to download image: {$url}"
                );

                return null;
            }

            /*
             * Get extension from URL
             */
            $path = parse_url($url, PHP_URL_PATH);
            $extension = strtolower(
                pathinfo($path, PATHINFO_EXTENSION)
            );

            if (!$extension) {
                $extension = 'jpg';
            }

            /*
             * Safe asset name
             */
            $assetKey = $handle . '.' . $extension;

            /*
             * Check if image already exists
             */
            $existingAsset = Asset::getByPath(
                '/Experts/' . $assetKey
            );

            if ($existingAsset instanceof Asset\Image) {

                $io->text(
                    "Image already exists: {$assetKey}"
                );

                return $existingAsset;
            }

            /*
             * Create image asset
             */
            $asset = new Asset\Image();

            $asset->setKey($assetKey);
            $asset->setParent($assetFolder);
            $asset->setData($imageData);

            $asset->save();

            $io->text(
                "Image imported: {$assetKey}"
            );

            return $asset;

        } catch (\Throwable $e) {

            $io->warning(
                "Image import failed: " . $e->getMessage()
            );

            return null;
        }
    }


    /**
     * Generate a random 3-4 line expert bio.
     */
    private function generateRandomBio(string $name): string
    {
        $bios = [

            "{$name} is a passionate food explorer with a love for discovering memorable dishes and hidden culinary gems. "
            . "From local favourites to unique dining experiences, their recommendations are driven by curiosity and great taste.",

            "{$name} loves exploring cities through their food and discovering the stories behind every dish. "
            . "They seek authentic flavours, interesting restaurants and experiences worth sharing with fellow food lovers.",

            "{$name} is a dedicated food enthusiast who enjoys finding remarkable dishes wherever the journey takes them. "
            . "Their food discoveries combine local culture, great flavours and memorable dining experiences.",

            "{$name} explores the world one plate at a time, always looking for delicious discoveries and authentic experiences. "
            . "They enjoy uncovering restaurants, dishes and food stories that deserve to be shared.",

            "{$name} is passionate about food, travel and the people behind memorable culinary experiences. "
            . "Their recommendations highlight distinctive flavours, local favourites and restaurants that make a city special.",
        ];

        return $bios[array_rand($bios)];
    }

    /**
 * Download a random AI-generated human avatar.
 */

    private function importRandomAvatar(
    string $handle,
    Folder $assetFolder,
    SymfonyStyle $io
): ?Asset\Image {

    try {

        $url = 'https://thispersondoesnotexist.com/random-person.jpeg';

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CONNECTTIMEOUT => 10,

            CURLOPT_HTTPHEADER => [
                'Accept: image/jpeg,image/*,*/*;q=0.8',
                'Cache-Control: no-cache',
                'Pragma: no-cache',
            ],

            CURLOPT_USERAGENT =>
                'Mozilla/5.0 (X11; Linux x86_64) '
                . 'AppleWebKit/537.36 '
                . '(KHTML, like Gecko) '
                . 'Chrome/120.0 Safari/537.36',
        ]);

        $imageData = curl_exec($ch);

        $httpCode = curl_getinfo(
            $ch,
            CURLINFO_HTTP_CODE
        );

        $contentType = curl_getinfo(
            $ch,
            CURLINFO_CONTENT_TYPE
        );

        $curlError = curl_error($ch);

        curl_close($ch);

        /*
         * Check CURL error
         */
        if ($imageData === false) {

            $io->warning(
                "Avatar download failed for {$handle}: {$curlError}"
            );

            return null;
        }

        /*
         * Check HTTP response
         */
        if ($httpCode !== 200) {

            $io->warning(
                "Avatar download failed for {$handle}. " .
                "HTTP status: {$httpCode}"
            );

            return null;
        }

        /*
         * Check that response is actually an image
         */
        if (
            !$contentType ||
            stripos($contentType, 'image/') !== 0
        ) {

            $io->warning(
                "Invalid avatar response for {$handle}. " .
                "Content-Type: {$contentType}"
            );

            return null;
        }

        /*
         * Validate actual image data
         */
        $imageInfo = @getimagesizefromstring($imageData);

        if ($imageInfo === false) {

            $io->warning(
                "Downloaded data is not a valid image for {$handle}"
            );

            return null;
        }

        /*
         * Always save as JPG.
         *
         * The endpoint returns JPEG, but we explicitly
         * use .jpg for the Pimcore asset.
         */
        $assetKey = $handle . '.jpg';

        /*
         * Check whether avatar already exists
         */
        $existingAsset = Asset::getByPath(
            '/Experts/' . $assetKey
        );

        if ($existingAsset instanceof Asset\Image) {

            $io->text(
                "Avatar already exists: {$assetKey}"
            );

            return $existingAsset;
        }

        /*
         * Create Pimcore image asset
         */
        $asset = new Asset\Image();

        $asset->setKey($assetKey);
        $asset->setParent($assetFolder);
        $asset->setData($imageData);

        $asset->save();

        $io->text(
            "Avatar imported: {$assetKey} " .
            "({$imageInfo[0]}x{$imageInfo[1]})"
        );

        return $asset;

    } catch (\Throwable $e) {

        $io->warning(
            "Avatar import failed for {$handle}: " .
            $e->getMessage()
        );

        return null;
    }
}

}