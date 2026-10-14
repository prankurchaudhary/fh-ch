<?php

namespace Pimcore\Model\DataObject\Item;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\Item|false current()
 * @method DataObject\Item[] load()
 * @method DataObject\Item[] getData()
 * @method DataObject\Item[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "Item";
protected $className = "Item";


/**
* Filter by itemName (Item Name)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByItemName ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("itemName")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by uniqueId (Unique Id)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByUniqueId ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("uniqueId")->addListingFilter($this, $data, $operator);
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
* Filter by videoUrl (Video Url)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByVideoUrl ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("videoUrl")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by city (City)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCity ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("city")->addListingFilter($this, $data, $operator);
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
* Filter by isTastiest (Is Tastiest)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByIsTastiest ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("isTastiest")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by listType (List Type)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByListType ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("listType")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by category (Category)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCategory ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("category")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by tags (Tags)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByTags ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("tags")->addListingFilter($this, $data, $operator);
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
* Filter by metaTitle (Meta Title)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByMetaTitle ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("metaTitle")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by metaDescription (Meta Description)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByMetaDescription ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("metaDescription")->addListingFilter($this, $data, $operator);
	return $this;
}



}
