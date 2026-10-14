<?php

namespace Pimcore\Model\DataObject\City;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\City|false current()
 * @method DataObject\City[] load()
 * @method DataObject\City[] getData()
 * @method DataObject\City[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "City";
protected $className = "City";


/**
* Filter by name (City Name)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByName ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("name")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by country (Country)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCountry ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("country")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by active (Active)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByActive ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("active")->addListingFilter($this, $data, $operator);
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
* Filter by latitude (Latitude)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByLatitude ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("latitude")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by longitude (Longitude)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByLongitude ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("longitude")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by timezone (Timezone)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByTimezone ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("timezone")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by zipcode (Zipcode)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByZipcode ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("zipcode")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by cityPhoto (City Photo)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCityPhoto ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("cityPhoto")->addListingFilter($this, $data, $operator);
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
* Filter by Continent (Continent)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByContinent ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("Continent")->addListingFilter($this, $data, $operator);
	return $this;
}



}
