<?php

namespace Pimcore\Model\DataObject\RestaurantWishlist;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\RestaurantWishlist|false current()
 * @method DataObject\RestaurantWishlist[] load()
 * @method DataObject\RestaurantWishlist[] getData()
 * @method DataObject\RestaurantWishlist[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "RestaurantWishlist";
protected $className = "RestaurantWishlist";


/**
* Filter by user (User)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByUser ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("user")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by restaurant (Restaurant)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByRestaurant ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("restaurant")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by createdAt (Created At)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCreatedAt ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("createdAt")->addListingFilter($this, $data, $operator);
	return $this;
}



}
