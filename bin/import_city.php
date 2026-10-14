<?php

use Pimcore\Bootstrap;
use App\Kernel;
use Pimcore\Model\DataObject\City;

require '/home/prankur/Chowzter/vendor/pimcore/pimcore/cli-script.php';




$data = [
    ['name' => 'Aberdeen','description'=>'desc','latitude'=>'1234','longitude'=>'1234','timezone'=>'UTC','active'=>1]
];

foreach ($data as $row) {
    $city = new City();
    //$city->setKey($row['slug']);
    $city->setParentId(4);
    $city->setPublished(true);
    $city->setActive(1);
    $city->setName($row['name']);
    $city->setLatitude($row['latitude']);
    $city->setLongitude($row['longitude']);
    $city->setTimezone($row['timezone']);
    $city->setDescription($row['description']);

    $city->save();
}
