<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Restaurant;
use Pimcore\Model\DataObject\City;
use Pimcore\Model\DataObject\Service;
use Pimcore\Model\DataObject\Concrete;
use Pimcore\Model\DataObject\Data\GeoCoordinates;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportRestaurantCommand extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('app:import:restaurants')
            ->setDescription('Import restaurants from CSV')
            ->addArgument(
                'csv',
                InputArgument::REQUIRED,
                'CSV file path'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $csvFile = $input->getArgument('csv');

        if (!file_exists($csvFile)) {
            $output->writeln('<error>CSV file not found</error>');
            return self::FAILURE;
        }

        $parentPath = '/Restaurants';

        $parent = DataObject::getByPath($parentPath);

        if (!$parent) {
            $output->writeln('<error>/Restaurants folder not found</error>');
            return self::FAILURE;
        }

        if (($handle = fopen($csvFile, 'r')) === false) {
            $output->writeln('<error>Unable to open CSV</error>');
            return self::FAILURE;
        }

        $header = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {

            $data = array_combine($header, $row);
            
            try {

                $restaurantName = trim($data['RestaurantName']);

                if (!$restaurantName) {
                    continue;
                }

                $slug = Service::getValidKey($restaurantName, 'object');

                $objectKey = Service::getValidKey(
                    $restaurantName,
                    'object'
                );
                $output->writeln("Slug fir rest - " . $slug);

                // Check existing object
                $existing = Restaurant::getBySlug($slug, 1);

                if ($existing instanceof Restaurant) {
                    $restaurant = $existing;
                    $output->writeln("Updating: " . $restaurantName);
                } else {
                    $restaurant = new Restaurant();
                    $restaurant->setKey($slug);
                    $restaurant->setParent($parent);
                    $output->writeln("Creating: " . $restaurantName);
                }

                /*
                 * BASIC FIELDS
                 */
                $restaurant->setName($restaurantName);
                $restaurant->setDishName($data['dishName'] ?? '');
                $restaurant->setDescription($data['description'] ?? '');
                $restaurant->setAddress($data['address'] ?? '');
                $restaurant->setWebsite($data['web_url'] ?? '');
                $restaurant->setTwitterLink($data['twitterHandler'] ?? '');
                $restaurant->setPhone($data['phone'] ?? '');
                $restaurant->setTimings($data['timing'] ?? '');

                /*
                 * SLUGS
                 */
               // $restaurant->setSlug($slug);

                $dishSlug = Service::getValidKey(
                    $data['dishName'] ?? '',
                    'object'
                );

                
                
               // $restaurant->setDishSlug($dishSlug);

                /*
                 * CITY RELATION
                 */
                if (!empty($data['city'])) {

                    $cityListing = new City\Listing();
                    $cityListing->setCondition('name = ?', [$data['city']]);
                    $cityListing->setLimit(1);

                    $city = $cityListing->current();

                    if ($city instanceof City) {
                        $restaurant->setCity($city);
                    } else {
                        $output->writeln(
                            '<comment>City not found: ' .
                            $data['city'] .
                            '</comment>'
                        );
                    }
                }

                /*
                 * GEO LOCATION
                 */
                if (
                    !empty($data['latitude']) &&
                    !empty($data['longitude'])
                ) {
                    $geo = new GeoCoordinates(
                        (float)$data['latitude'],
                        (float)$data['longitude']
                    );

                    $restaurant->setLocation($geo);
                }

                /*
                 * STATUS
                 */
                $restaurant->setStatus(true);

                /*
                 * PUBLISH
                 */
                $restaurant->setPublished(true);

                $restaurant->save();

            } catch (\Exception $e) {

                $output->writeln(
                    '<error>Error: ' .
                    $e->getMessage() .
                    '</error>'
                );
            }
        }

        fclose($handle);

        $output->writeln('<info>Import completed</info>');

        return self::SUCCESS;
    }
}