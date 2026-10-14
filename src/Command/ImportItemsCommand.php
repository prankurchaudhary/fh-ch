<?php

namespace App\Command;

use Pimcore\Model\DataObject\City;
use Pimcore\Model\DataObject\Restaurant;
use Pimcore\Model\DataObject\Item;
use Pimcore\Model\DataObject;
use Pimcore\Model\Asset;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportItemsCommand extends Command
{
    protected static $defaultName = 'chowzter:import:items';

    protected function configure(): void
    {
        $this
            ->addArgument('csv', InputArgument::REQUIRED);
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {

        $csvFile = $input->getArgument('csv');

        if (!file_exists($csvFile)) {
            $output->writeln('<error>CSV file not found</error>');
            return Command::FAILURE;
        }

        $handle = fopen($csvFile, 'r');

        $header = fgetcsv($handle);

        $itemFolder = DataObject\Service::createFolderByPath('/Items');

        while (($row = fgetcsv($handle)) !== false) {

            $data = array_combine($header, $row);

            try {

                $city = $this->findCity($data['cityName']);
                $restaurant = $this->findRestaurant($data['Restaurant Name']);

                if (!$city) {
                    $output->writeln(
                        "<error>City not found: {$data['cityName']}</error>"
                    );
                    continue;
                }

                if (!$restaurant) {
                    $output->writeln(
                        "<error>Restaurant not found: {$data['Restaurant Name']}</error>"
                    );
                    continue;
                }

                $existing = Item::getByUniqueId(
                    $data['uniqueId'],
                    1
                );

                if ($existing instanceof Item) {
                    $output->writeln(
                        "Skipping existing item {$data['itemName']}"
                    );
                    continue;
                }

                $item = new Item();

                $item->setParent($itemFolder);

                $itemSlug = \Pimcore\Model\Element\Service::getValidKey(
                    $data['itemName'],
                    'object'
                );

                $key = $city->getSlug() . '-' . $restaurant->getSlug() . '-' . $itemSlug;
                $item->setKey($key);


                $item->setUniqueId($data['uniqueId']);
                $item->setItemName($data['itemName']);

                $item->setCity($city);
                $item->setRestaurant($restaurant);

                $item->setDescription(
                    $data['description']
                );

                $item->setVideoUrl(
                    $data['videoUrl']
                );

                $item->setIsTastiest(
                    (bool)$data['isTastiest']
                );
                $item->setMetaTitle($data['itemName']. ' at ' . $restaurant->getName() . ' in ' . $city->getName());

                /*
                 * listType multiselect
                 */

                if (!empty($data['listType'])) {

                    $listTypes = array_map(
                        'trim',
                        explode(',', $data['listType'])
                    );

                    $item->setListType($listTypes);
                }

                $item->setPublished(true);
                $item->save();

                $output->writeln(
                    "Imported: {$data['itemName']}"
                );

            } catch (\Exception $e) {

                $output->writeln(
                    "<error>{$e->getMessage()}</error>"
                );
            }
        }

        fclose($handle);

        return Command::SUCCESS;
    }

    private function findCity(string $cityName): ?City
    {
        $list = new City\Listing();

        $list->setCondition(
            'name = ?',
            [$cityName]
        );

        return $list->current() ?: null;
    }

    private function findRestaurant(string $restaurantName): ?Restaurant
    {
        $list = new Restaurant\Listing();

        $list->setCondition(
            'name = ?',
            [$restaurantName]
        );

        return $list->current() ?: null;
    }
}