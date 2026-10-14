<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Pimcore\Model\DataObject\City;
use Pimcore\Model\DataObject\Continent;
use Pimcore\Model\DataObject\Folder;

#[AsCommand(
    name: 'chowzter:import-cities',
    description: 'Import cities into Chowzter'
)]
class ImportCityCommand extends AbstractCommand
{
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $io = new SymfonyStyle($input, $output);

        $data = require PIMCORE_PROJECT_ROOT . '/public/cities.php';

        if (!is_array($data)) {
            $io->error('cities.php must return an array.');
            return self::FAILURE;
        }

          /*
         * Get or create Cities folder
         */
        $citiesFolder = Folder::getByPath('/Cities');

        $created = 0;
        $updated = 0;
        $failed = 0;

        foreach ($data as $index => $row) {

            try {

                if (empty($row['name'])) {
                    $io->warning("Row {$index}: City name is missing.");
                    $failed++;
                    continue;
                }

                $name = trim($row['name']);

                $slug = !empty($row['slug'])
                    ? trim($row['slug'])
                    : strtolower($name);

                /*
                 * Find existing city by slug
                 */
                $listing = new City\Listing();
                $listing->setCondition(
                    'slug = ?',
                    [$slug]
                );
                $listing->setLimit(1);

                $city = $listing->current();

                /*
                 * Create new City if it doesn't exist
                 */
                if (!$city) {

                    $city = new City();

                    // Pimcore object key
                    $city->setKey($slug);
                    $city->setParent($citiesFolder);

                    // Publish object
                    $city->setPublished(true);

                    $created++;

                    $io->text("Creating: {$name}");

                } else {

                    $updated++;

                    $io->text("Updating: {$name}");
                }

                /*
                 * City fields
                 */
                $city->setName($name);
                $city->setSlug($slug);

                $city->setDescription(
                    $row['description'] ?? ''
                );

                if (
                    isset($row['latitude']) &&
                    $row['latitude'] !== ''
                ) {
                    $city->setLatitude(
                        (float) $row['latitude']
                    );
                }

                if (
                    isset($row['longitude']) &&
                    $row['longitude'] !== ''
                ) {
                    $city->setLongitude(
                        (float) $row['longitude']
                    );
                }

                $city->setTimezone(
                    $row['timezone'] ?? ''
                );

                $city->setActive(
                    (bool) ($row['active'] ?? 1)
                );

                /*
                 * Country is a normal Pimcore field
                 */
                $city->setCountry(
                    $row['country'] ?? ''
                );

                /*
                 * Continent is also stored directly
                 */
                if (!empty($row['continent'])) {

                    $continentListing = new Continent\Listing();

                    $continentListing->setCondition(
                        'slug = ?',
                        [$row['continent']]
                    );

                    $continentListing->setLimit(1);

                    $continent = $continentListing->current();

                    if ($continent) {
                        $city->setContinent($continent);
                    } else {
                        $io->warning(
                            "Continent '{$row['continent']}' not found for {$name}"
                        );
                    }
                }

                /*
                 * Save
                 */
                $city->save();

            } catch (\Throwable $e) {

                $failed++;

                $io->error(
                    "Failed to import {$row['name']}: " .
                    $e->getMessage()
                );
            }
        }

        $io->success([
            'City import completed.',
            "Created: {$created}",
            "Updated: {$updated}",
            "Failed: {$failed}",
        ]);

        return $failed > 0
            ? self::FAILURE
            : self::SUCCESS;
    }
}