<?php

namespace Pimcore\Model\DataObject\BlogPost;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\BlogPost|false current()
 * @method DataObject\BlogPost[] load()
 * @method DataObject\BlogPost[] getData()
 * @method DataObject\BlogPost[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "Blog";
protected $className = "BlogPost";


/**
* Filter by title (Title)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByTitle ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("title")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by blogIntro (Blog Intro)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByBlogIntro ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("blogIntro")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by author (Author)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByAuthor ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("author")->addListingFilter($this, $data, $operator);
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
* Filter by featuredRestaurants (Featured Restaurants)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByFeaturedRestaurants ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("featuredRestaurants")->addListingFilter($this, $data, $operator);
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
* Filter by recommendedPosts (Recommended Posts)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByRecommendedPosts ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("recommendedPosts")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by publishedDate (Published Date)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByPublishedDate ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("publishedDate")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by blogType (Blog Type)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByBlogType ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("blogType")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by content (Content)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByContent ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("content")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by coverImage (Cover Image)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCoverImage ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("coverImage")->addListingFilter($this, $data, $operator);
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

/**
* Filter by metaKeywords (Meta Keywords)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByMetaKeywords ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("metaKeywords")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by ogTitle (Og Title)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByOgTitle ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("ogTitle")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by ogDescription (Og Description)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByOgDescription ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("ogDescription")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by ogImage (Og Image)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByOgImage ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("ogImage")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by noIndex (No Index)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByNoIndex ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("noIndex")->addListingFilter($this, $data, $operator);
	return $this;
}



}
