<?php

/**
 * Inheritance: yes
 * Variants: yes
 *
 * Fields Summary:
 * - title [input]
 * - blogIntro [textarea]
 * - author [manyToOneRelation]
 * - slug [input]
 * - featuredRestaurants [manyToManyObjectRelation]
 * - category [manyToOneRelation]
 * - recommendedPosts [manyToManyObjectRelation]
 * - publishedDate [datetime]
 * - blogType [select]
 * - content [wysiwyg]
 * - coverImage [image]
 * - metaTitle [input]
 * - metaDescription [textarea]
 * - metaKeywords [input]
 * - ogTitle [input]
 * - ogDescription [input]
 * - ogImage [image]
 * - noIndex [checkbox]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\BlogPost\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByTitle(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByBlogIntro(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByAuthor(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getBySlug(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByFeaturedRestaurants(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByCategory(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByRecommendedPosts(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByPublishedDate(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByBlogType(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByContent(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByCoverImage(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByMetaTitle(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByMetaDescription(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByMetaKeywords(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByOgTitle(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByOgDescription(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByOgImage(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\BlogPost\Listing|\Pimcore\Model\DataObject\BlogPost|null getByNoIndex(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class BlogPost extends Concrete
{
public const FIELD_TITLE = 'title';
public const FIELD_BLOG_INTRO = 'blogIntro';
public const FIELD_AUTHOR = 'author';
public const FIELD_SLUG = 'slug';
public const FIELD_FEATURED_RESTAURANTS = 'featuredRestaurants';
public const FIELD_CATEGORY = 'category';
public const FIELD_RECOMMENDED_POSTS = 'recommendedPosts';
public const FIELD_PUBLISHED_DATE = 'publishedDate';
public const FIELD_BLOG_TYPE = 'blogType';
public const FIELD_CONTENT = 'content';
public const FIELD_COVER_IMAGE = 'coverImage';
public const FIELD_META_TITLE = 'metaTitle';
public const FIELD_META_DESCRIPTION = 'metaDescription';
public const FIELD_META_KEYWORDS = 'metaKeywords';
public const FIELD_OG_TITLE = 'ogTitle';
public const FIELD_OG_DESCRIPTION = 'ogDescription';
public const FIELD_OG_IMAGE = 'ogImage';
public const FIELD_NO_INDEX = 'noIndex';

protected $classId = "Blog";
protected $className = "BlogPost";
protected $title;
protected $blogIntro;
protected $author;
protected $slug;
protected $featuredRestaurants;
protected $category;
protected $recommendedPosts;
protected $publishedDate;
protected $blogType;
protected $content;
protected $coverImage;
protected $metaTitle;
protected $metaDescription;
protected $metaKeywords;
protected $ogTitle;
protected $ogDescription;
protected $ogImage;
protected $noIndex;


/**
* @param array $values
* @return static
*/
public static function create(array $values = []): static
{
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get title - Title
* @return string|null
*/
public function getTitle(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("title");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->title;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("title")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("title");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set title - Title
* @param string|null $title
* @return $this
*/
public function setTitle(?string $title): static
{
	$this->markFieldDirty("title", true);

	$this->title = $title;

	return $this;
}

/**
* Get blogIntro - Blog Intro
* @return string|null
*/
public function getBlogIntro(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("blogIntro");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->blogIntro;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("blogIntro")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("blogIntro");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set blogIntro - Blog Intro
* @param string|null $blogIntro
* @return $this
*/
public function setBlogIntro(?string $blogIntro): static
{
	$this->markFieldDirty("blogIntro", true);

	$this->blogIntro = $blogIntro;

	return $this;
}

/**
* Get author - Author
* @return \Pimcore\Model\DataObject\WebsiteUser|null
*/
public function getAuthor(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("author");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("author")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("author")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("author");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set author - Author
* @param \Pimcore\Model\DataObject\WebsiteUser|null $author
* @return $this
*/
public function setAuthor(?\Pimcore\Model\Element\AbstractElement $author): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("author");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getAuthor();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $author);
	if (!$isEqual) {
		$this->markFieldDirty("author", true);
	}
	$this->author = $fd->preSetData($this, $author);
	return $this;
}

/**
* Get slug - Slug
* @return string|null
*/
public function getSlug(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("slug");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->slug;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("slug")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("slug");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set slug - Slug
* @param string|null $slug
* @return $this
*/
public function setSlug(?string $slug): static
{
	$this->markFieldDirty("slug", true);

	$this->slug = $slug;

	return $this;
}

/**
* Get featuredRestaurants - Featured Restaurants
* @return \Pimcore\Model\DataObject\Restaurant[]
*/
public function getFeaturedRestaurants(): array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("featuredRestaurants");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("featuredRestaurants")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("featuredRestaurants")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("featuredRestaurants");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set featuredRestaurants - Featured Restaurants
* @param \Pimcore\Model\DataObject\Restaurant[] $featuredRestaurants
* @return $this
*/
public function setFeaturedRestaurants(?array $featuredRestaurants): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("featuredRestaurants");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getFeaturedRestaurants();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $featuredRestaurants);
	if (!$isEqual) {
		$this->markFieldDirty("featuredRestaurants", true);
	}
	$this->featuredRestaurants = $fd->preSetData($this, $featuredRestaurants);
	return $this;
}

/**
* Get category - Category
* @return \Pimcore\Model\DataObject\FoodCategory|null
*/
public function getCategory(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("category");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("category")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("category")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("category");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set category - Category
* @param \Pimcore\Model\DataObject\FoodCategory|null $category
* @return $this
*/
public function setCategory(?\Pimcore\Model\Element\AbstractElement $category): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("category");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getCategory();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $category);
	if (!$isEqual) {
		$this->markFieldDirty("category", true);
	}
	$this->category = $fd->preSetData($this, $category);
	return $this;
}

/**
* Get recommendedPosts - Recommended Posts
* @return \Pimcore\Model\DataObject\Blog[]
*/
public function getRecommendedPosts(): array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("recommendedPosts");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("recommendedPosts")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("recommendedPosts")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("recommendedPosts");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set recommendedPosts - Recommended Posts
* @param \Pimcore\Model\DataObject\Blog[] $recommendedPosts
* @return $this
*/
public function setRecommendedPosts(?array $recommendedPosts): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("recommendedPosts");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getRecommendedPosts();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $recommendedPosts);
	if (!$isEqual) {
		$this->markFieldDirty("recommendedPosts", true);
	}
	$this->recommendedPosts = $fd->preSetData($this, $recommendedPosts);
	return $this;
}

/**
* Get publishedDate - Published Date
* @return \Carbon\Carbon|null
*/
public function getPublishedDate(): ?\Carbon\Carbon
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("publishedDate");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->publishedDate;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("publishedDate")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("publishedDate");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set publishedDate - Published Date
* @param \Carbon\Carbon|null $publishedDate
* @return $this
*/
public function setPublishedDate(?\Carbon\Carbon $publishedDate): static
{
	$this->markFieldDirty("publishedDate", true);

	$this->publishedDate = $publishedDate;

	return $this;
}

/**
* Get blogType - Blog Type
* @return string|null
*/
public function getBlogType(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("blogType");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->blogType;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("blogType")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("blogType");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set blogType - Blog Type
* @param string|null $blogType
* @return $this
*/
public function setBlogType(?string $blogType): static
{
	$this->markFieldDirty("blogType", true);

	$this->blogType = $blogType;

	return $this;
}

/**
* Get content - Content
* @return string|null
*/
public function getContent(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("content");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("content")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("content")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("content");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set content - Content
* @param string|null $content
* @return $this
*/
public function setContent(?string $content): static
{
	$this->markFieldDirty("content", true);

	$this->content = $content;

	return $this;
}

/**
* Get coverImage - Cover Image
* @return \Pimcore\Model\Asset\Image|null
*/
public function getCoverImage(): ?\Pimcore\Model\Asset\Image
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("coverImage");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->coverImage;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("coverImage")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("coverImage");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set coverImage - Cover Image
* @param \Pimcore\Model\Asset\Image|null $coverImage
* @return $this
*/
public function setCoverImage(?\Pimcore\Model\Asset\Image $coverImage): static
{
	$this->markFieldDirty("coverImage", true);

	$this->coverImage = $coverImage;

	return $this;
}

/**
* Get metaTitle - Meta Title
* @return string|null
*/
public function getMetaTitle(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("metaTitle");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->metaTitle;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("metaTitle")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("metaTitle");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set metaTitle - Meta Title
* @param string|null $metaTitle
* @return $this
*/
public function setMetaTitle(?string $metaTitle): static
{
	$this->markFieldDirty("metaTitle", true);

	$this->metaTitle = $metaTitle;

	return $this;
}

/**
* Get metaDescription - Meta Description
* @return string|null
*/
public function getMetaDescription(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("metaDescription");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->metaDescription;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("metaDescription")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("metaDescription");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set metaDescription - Meta Description
* @param string|null $metaDescription
* @return $this
*/
public function setMetaDescription(?string $metaDescription): static
{
	$this->markFieldDirty("metaDescription", true);

	$this->metaDescription = $metaDescription;

	return $this;
}

/**
* Get metaKeywords - Meta Keywords
* @return string|null
*/
public function getMetaKeywords(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("metaKeywords");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->metaKeywords;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("metaKeywords")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("metaKeywords");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set metaKeywords - Meta Keywords
* @param string|null $metaKeywords
* @return $this
*/
public function setMetaKeywords(?string $metaKeywords): static
{
	$this->markFieldDirty("metaKeywords", true);

	$this->metaKeywords = $metaKeywords;

	return $this;
}

/**
* Get ogTitle - Og Title
* @return string|null
*/
public function getOgTitle(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("ogTitle");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->ogTitle;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("ogTitle")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("ogTitle");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set ogTitle - Og Title
* @param string|null $ogTitle
* @return $this
*/
public function setOgTitle(?string $ogTitle): static
{
	$this->markFieldDirty("ogTitle", true);

	$this->ogTitle = $ogTitle;

	return $this;
}

/**
* Get ogDescription - Og Description
* @return string|null
*/
public function getOgDescription(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("ogDescription");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->ogDescription;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("ogDescription")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("ogDescription");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set ogDescription - Og Description
* @param string|null $ogDescription
* @return $this
*/
public function setOgDescription(?string $ogDescription): static
{
	$this->markFieldDirty("ogDescription", true);

	$this->ogDescription = $ogDescription;

	return $this;
}

/**
* Get ogImage - Og Image
* @return \Pimcore\Model\Asset\Image|null
*/
public function getOgImage(): ?\Pimcore\Model\Asset\Image
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("ogImage");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->ogImage;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("ogImage")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("ogImage");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set ogImage - Og Image
* @param \Pimcore\Model\Asset\Image|null $ogImage
* @return $this
*/
public function setOgImage(?\Pimcore\Model\Asset\Image $ogImage): static
{
	$this->markFieldDirty("ogImage", true);

	$this->ogImage = $ogImage;

	return $this;
}

/**
* Get noIndex - No Index
* @return bool|null
*/
public function getNoIndex(): ?bool
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("noIndex");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->noIndex;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("noIndex")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("noIndex");
		} catch (InheritanceParentNotFoundException $e) {
			// no data from parent available, continue ...
		}
	}

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set noIndex - No Index
* @param bool|null $noIndex
* @return $this
*/
public function setNoIndex(?bool $noIndex): static
{
	$this->markFieldDirty("noIndex", true);

	$this->noIndex = $noIndex;

	return $this;
}

}

