<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Pimcore\Model\DataObject\Item;
use Pimcore\Model\DataObject\FoodCategory;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportRestaurantCategoryCommand extends AbstractCommand
{
    protected function configure(): void
    {
        $this
            ->setName('app:import:restaurant-categories')
            ->setDescription('Import restaurant categories from CSV')
            ->addArgument(
                'csv',
                InputArgument::REQUIRED,
                'CSV file path'
            );
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {

        $csvFile = $input->getArgument('csv');

        if (!file_exists($csvFile)) {

            $output->writeln(
                '<error>CSV file not found</error>'
            );

            return self::FAILURE;
        }

        $handle = fopen($csvFile, 'r');

        if (!$handle) {

            $output->writeln(
                '<error>Unable to open CSV</error>'
            );

            return self::FAILURE;
        }

        $header = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {

            $data = array_combine($header, $row);

            try {

                $itemUniqueId = trim(
                    $data['uniqueId'] ?? ''
                );

                $catName = trim(
                    $data['name'] ?? ''
                );

                if (
                    empty($itemUniqueId) ||
                    empty($catName)
                ) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | FIND RESTAURANT
                |--------------------------------------------------------------------------
                */

                $itemListing = new Item\Listing();

                

                    $itemListing->setCondition(
                        'uniqueId = ?',
                        [$itemUniqueId]
                    );


                $itemListing->setLimit(1);

                $item = $itemListing->current();

                if (!$item instanceof Item) {

                    $output->writeln(
                        '<comment>item not found: ' .
                        $itemUniqueId .
                        '</comment>'
                    );

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | FIND CATEGORY
                |--------------------------------------------------------------------------
                */

                $categoryListing = new FoodCategory\Listing();

                $categoryListing->setCondition(
                    'categoryName = ?',
                    [$catName]
                );

                $categoryListing->setLimit(1);

                $category = $categoryListing->current();

                if (!$category instanceof FoodCategory) {

                    $output->writeln(
                        '<comment>Category not found: ' .
                        $catName .
                        '</comment>'
                    );

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | ASSIGN CATEGORY
                |--------------------------------------------------------------------------
                */

                $item->setCategory($category);

                $item->save();

                $output->writeln(
                    '<info>Updated: ' .
                    $itemUniqueId .
                    ' => ' .
                    $catName .
                    '</info>'
                );

            } catch (\Exception $e) {

                $output->writeln(
                    '<error>' .
                    $e->getMessage() .
                    '</error>'
                );
            }
        }

        fclose($handle);

        $output->writeln(
            '<info>Category import completed</info>'
        );

        return self::SUCCESS;
    }
}