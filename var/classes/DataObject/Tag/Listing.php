<?php

namespace Pimcore\Model\DataObject\Tag;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\Tag|false current()
 * @method DataObject\Tag[] load()
 * @method DataObject\Tag[] getData()
 * @method DataObject\Tag[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "Tag";
protected $className = "Tag";


/**
* Filter by tagName (Tag Name)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByTagName ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("tagName")->addListingFilter($this, $data, $operator);
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



}
