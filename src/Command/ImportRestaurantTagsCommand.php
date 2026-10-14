<?php

namespace App\Command;

use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Item;
use Pimcore\Model\DataObject\Tag;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportRestaurantTagsCommand extends Command
{
    protected static $defaultName = 'app:import-restaurant-tags';

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {

        $csvFile = PIMCORE_PROJECT_ROOT . '/var/import/item_tags1.csv';

        if (!file_exists($csvFile)) {
            $output->writeln('CSV file not found');
            return Command::FAILURE;
        }

        $handle = fopen($csvFile, 'r');

        $header = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {

            $uniqueId = trim($row[0]);
            $tagName = trim($row[1]);

            if (!$uniqueId || !$tagName) {
                continue;
            }

            // Find Item
            $itemListing = new Item\Listing();
            $itemListing->setCondition(
                'uniqueId = ?',
                [$uniqueId]
            );

            $item = $itemListing->current();

            if (!$item) {
                $output->writeln(
                    "item not found: {$uniqueId} "
                );
                continue;
            }

            // Find tag
            $tagListing = new Tag\Listing();
            $tagListing->setCondition(
                'TRIM(tagName) = ?',
                [$tagName]
            );

            $tag = $tagListing->current();

            // Create tag if missing
            if (!$tag) {

                $tagFolder = DataObject::getByPath('/Tags');

                $tag = new Tag();
                $tag->setParent($tagFolder);
                $tag->setKey(\Pimcore\File::getValidFilename($tagName));
                $tag->setTagName($tagName);
                $tag->setPublished(true);

                $tag->save();

                $output->writeln(
                    "Created Tag: {$tagName}"
                );
            }

            // Existing tags
            $existingTags = $item->getTags() ?: [];

            $alreadyExists = false;

            foreach ($existingTags as $existingTag) {
                if ($existingTag->getId() === $tag->getId()) {
                    $alreadyExists = true;
                    break;
                }
            }

            if (!$alreadyExists) {

                $existingTags[] = $tag;

                $item->setTags($existingTags);
                $item->save();

                $output->writeln(
                    "Added {$tagName} to {$uniqueId} "
                );
            }
        }

        fclose($handle);

        $output->writeln('Import completed');

        return Command::SUCCESS;
    }
}