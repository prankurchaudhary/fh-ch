<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Pimcore\Model\DataObject\FoodCategory;
use Symfony\Component\Console\Command\Command;
use Pimcore\Model\DataObject\Continent;
use Pimcore\Model\Element\Service;


#[AsCommand(
name: 'import:categories',
description: 'Comamnd to import categories'
)]
class ImportCategoriesCommand extends AbstractCommand
{
protected function execute(InputInterface $input, OutputInterface $output): int
{

$data = [
    ['name' => 'Fried Chicken', 'slug' => 'fried-chicken'],
];

$data  = require_once PIMCORE_PROJECT_ROOT.'/public/genres_data.php';

foreach ($data as $row) {


    //  // Fetch Category
    $categoryListing = new FoodCategory\Listing();
    $categoryListing->setCondition('slug = ?', [$row['slug']]);
    $categoryListing->setLimit(1);

    $category = $categoryListing->current();

    if ($category) {
        $output->writeln("<error>category found ... ignoring</error> ");
        //return Command::FAILURE;
        continue;
    }
    $category = new FoodCategory();

     $category->setCategoryName($row['name']);
     $category->setSlug($row['slug']);
     $category->setParentId(19506);
     $category->setKey($row['slug']);
     $category->setPublished(true);
    $category->save();

    $output->writeln($row['name']." - <info>Category created successfully</info>");
  
}

$output->writeln('<info>✅ City import completed</info>');
return 0;
}
}