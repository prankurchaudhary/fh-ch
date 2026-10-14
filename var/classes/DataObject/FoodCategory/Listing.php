<?php

namespace Pimcore\Model\DataObject\FoodCategory;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\FoodCategory|false current()
 * @method DataObject\FoodCategory[] load()
 * @method DataObject\FoodCategory[] getData()
 * @method DataObject\FoodCategory[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "FoodCategory";
protected $className = "FoodCategory";


/**
* Filter by categoryName (Category Name)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCategoryName ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("categoryName")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by description (Description)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByDescription ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("description")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by slug (Slug)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterBySlug ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("slug")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by restaurants (Restaurants)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByRestaurants ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("restaurants")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by expert (Expert)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByExpert ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("expert")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by items (Items)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByItems ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("items")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by foodCategoryImage (Food Category Image)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByFoodCategoryImage ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("foodCategoryImage")->addListingFilter($this, $data, $operator);
	return $this;
}



}
