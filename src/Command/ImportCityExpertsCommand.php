<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Model\DataObject\City;
use Pimcore\Model\DataObject\WebsiteUser;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'chowzter:import-city-experts',
    description: 'Populate experts/WebsiteUsers in City objects from CSV'
)]
class ImportCityExpertsCommand extends AbstractCommand
{
    protected function configure(): void
    {
        $this->addArgument(
            'csv',
            InputArgument::REQUIRED,
            'Path to CSV file'
        );
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $csvFile = $input->getArgument('csv');

        if (!file_exists($csvFile)) {
            $output->writeln("<error>CSV file not found: {$csvFile}</error>");
            return self::FAILURE;
        }

        $handle = fopen($csvFile, 'r');

        if ($handle === false) {
            $output->writeln("<error>Unable to open CSV file.</error>");
            return self::FAILURE;
        }

        // Read CSV header
        $headers = fgetcsv($handle);

        if (!$headers) {
            fclose($handle);

            $output->writeln('<error>CSV file is empty.</error>');
            return self::FAILURE;
        }

        $headers = array_map(
            static fn($header) => trim($header),
            $headers
        );

        $handleIndex = array_search('handle', $headers, true);
        $citySlugIndex = array_search('slug', $headers, true);

        if ($handleIndex === false || $citySlugIndex === false) {
            fclose($handle);

            $output->writeln(
                '<error>CSV must contain "handle" and "slug" columns.</error>'
            );

            return self::FAILURE;
        }

        $processed = 0;
        $updated = 0;
        $skipped = 0;
        $missingCities = 0;
        $missingUsers = 0;

        while (($row = fgetcsv($handle)) !== false) {
            if (count($row) === 0) {
                continue;
            }

            $userHandle = trim($row[$handleIndex] ?? '');
            $citySlug = trim($row[$citySlugIndex] ?? '');

            if ($userHandle === '' || $citySlug === '') {
                $output->writeln(
                    '<comment>Skipping row with empty handle/citySlug.</comment>'
                );

                $skipped++;
                continue;
            }

            $processed++;

            /*
             * ---------------------------------------------------------
             * Find City by slug
             * ---------------------------------------------------------
             */

            $cityListing = new City\Listing();
            $cityListing->setCondition(
                'slug = ?',
                [$citySlug]
            );
            $cityListing->setLimit(1);

            $city = $cityListing->current();

            if (!$city) {
                $output->writeln(
                    "<error>City not found: {$citySlug}</error>"
                );

                $missingCities++;
                continue;
            }

            /*
             * ---------------------------------------------------------
             * Find WebsiteUser by handle
             * ---------------------------------------------------------
             */

            $userListing = new WebsiteUser\Listing();
            $userListing->setCondition(
                'handle = ?',
                [$userHandle]
            );
            $userListing->setLimit(1);

            $websiteUser = $userListing->current();

            if (!$websiteUser) {
                $output->writeln(
                    "<error>WebsiteUser not found: {$userHandle}</error>"
                );

                $missingUsers++;
                continue;
            }

            /*
             * ---------------------------------------------------------
             * Existing experts
             * ---------------------------------------------------------
             */

            $existingExperts = $city->getExpert();

            if (!is_array($existingExperts)) {
                $existingExperts = [];
            }

            /*
             * ---------------------------------------------------------
             * Check duplicate
             * ---------------------------------------------------------
             */

            $alreadyExists = false;

            foreach ($existingExperts as $existingExpert) {
                if ($existingExpert->getId() === $websiteUser->getId()) {
                    $alreadyExists = true;
                    break;
                }
            }

            if ($alreadyExists) {
                $output->writeln(
                    "<comment>Already assigned: {$userHandle} → {$citySlug}</comment>"
                );

                $skipped++;
                continue;
            }

            /*
             * ---------------------------------------------------------
             * Add WebsiteUser to City
             * ---------------------------------------------------------
             */

            $existingExperts[] = $websiteUser;

            $city->setExpert($websiteUser);
            $city->save();

            $output->writeln(
                "<info>Added: {$userHandle} → {$citySlug}</info>"
            );

            $updated++;
        }

        fclose($handle);

        $output->writeln('');
        $output->writeln('======================================');
        $output->writeln('Import completed');
        $output->writeln('======================================');
        $output->writeln("Processed       : {$processed}");
        $output->writeln("Updated         : {$updated}");
        $output->writeln("Skipped         : {$skipped}");
        $output->writeln("Missing cities  : {$missingCities}");
        $output->writeln("Missing users   : {$missingUsers}");
        $output->writeln('======================================');

        return self::SUCCESS;
    }
}