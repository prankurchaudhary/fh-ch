<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Pimcore\Model\DataObject\Tag;
use Symfony\Component\Console\Command\Command;
use Pimcore\Model\DataObject\Continent;
use Pimcore\Model\Element\Service;


#[AsCommand(
name: 'import:tags',
description: 'Comamnd to import tags'
)]
class ImportTagsCommand extends AbstractCommand
{
protected function execute(InputInterface $input, OutputInterface $output): int
{

// $data = [
//     ['name' => 'Fried Chicken', 'slug' => 'fried-chicken'],
// ];

$data  = require_once PIMCORE_PROJECT_ROOT.'/public/tags.php';

foreach ($data as $row) {


    //  // Fetch tag
    $tagListing = new Tag\Listing();
    $tagListing->setCondition('slug = ?', [$row['slug']]);
    $tagListing->setLimit(1);

    $tag = $tagListing->current();

    if ($tag) {
        $output->writeln("<error>tag found ... ignoring</error> ");
        //return Command::FAILURE;
        continue;
    }
    $tag = new Tag();

     $tag->setTagName($row['tagName']);
     $tag->setSlug($row['slug']);
     $tag->setParentId(17709);
     $tag->setKey($row['slug']);
     $tag->setPublished(true);
    $tag->save();

    $output->writeln($row['tagName']." - <info>tag created successfully</info>");
  
}

$output->writeln('<info>✅ Tag import completed</info>');
return 0;
}
}