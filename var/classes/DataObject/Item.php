<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - itemName [input]
 * - uniqueId [input]
 * - slug [input]
 * - description [wysiwyg]
 * - videoUrl [input]
 * - city [manyToOneRelation]
 * - restaurant [manyToOneRelation]
 * - isTastiest [checkbox]
 * - listType [multiselect]
 * - category [manyToOneRelation]
 * - tags [manyToManyObjectRelation]
 * - expert [manyToOneRelation]
 * - itemPhotos [imageGallery]
 * - metaTitle [input]
 * - metaDescription [textarea]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\Item\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByItemName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByUniqueId(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getBySlug(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByDescription(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByVideoUrl(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByCity(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByRestaurant(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByIsTastiest(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByListType(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByCategory(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByTags(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByExpert(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByMetaTitle(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Item\Listing|\Pimcore\Model\DataObject\Item|null getByMetaDescription(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class Item extends Concrete
{
public const FIELD_ITEM_NAME = 'itemName';
public const FIELD_UNIQUE_ID = 'uniqueId';
public const FIELD_SLUG = 'slug';
public const FIELD_DESCRIPTION = 'description';
public const FIELD_VIDEO_URL = 'videoUrl';
public const FIELD_CITY = 'city';
public const FIELD_RESTAURANT = 'restaurant';
public const FIELD_IS_TASTIEST = 'isTastiest';
public const FIELD_LIST_TYPE = 'listType';
public const FIELD_CATEGORY = 'category';
public const FIELD_TAGS = 'tags';
public const FIELD_EXPERT = 'expert';
public const FIELD_ITEM_PHOTOS = 'itemPhotos';
public const FIELD_META_TITLE = 'metaTitle';
public const FIELD_META_DESCRIPTION = 'metaDescription';

protected $classId = "Item";
protected $className = "Item";
protected $itemName;
protected $uniqueId;
protected $slug;
protected $description;
protected $videoUrl;
protected $city;
protected $restaurant;
protected $isTastiest;
protected $listType;
protected $category;
protected $tags;
protected $expert;
protected $itemPhotos;
protected $metaTitle;
protected $metaDescription;


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
* Get itemName - Item Name
* @return string|null
*/
public function getItemName(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("itemName");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->itemName;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set itemName - Item Name
* @param string|null $itemName
* @return $this
*/
public function setItemName(?string $itemName): static
{
	$this->markFieldDirty("itemName", true);

	$this->itemName = $itemName;

	return $this;
}

/**
* Get uniqueId - Unique Id
* @return string|null
*/
public function getUniqueId(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("uniqueId");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->uniqueId;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set uniqueId - Unique Id
* @param string|null $uniqueId
* @return $this
*/
public function setUniqueId(?string $uniqueId): static
{
	$this->markFieldDirty("uniqueId", true);

	$this->uniqueId = $uniqueId;

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
* Get description - Description
* @return string|null
*/
public function getDescription(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("description");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("description")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set description - Description
* @param string|null $description
* @return $this
*/
public function setDescription(?string $description): static
{
	$this->markFieldDirty("description", true);

	$this->description = $description;

	return $this;
}

/**
* Get videoUrl - Video Url
* @return string|null
*/
public function getVideoUrl(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("videoUrl");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->videoUrl;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set videoUrl - Video Url
* @param string|null $videoUrl
* @return $this
*/
public function setVideoUrl(?string $videoUrl): static
{
	$this->markFieldDirty("videoUrl", true);

	$this->videoUrl = $videoUrl;

	return $this;
}

/**
* Get city - City
* @return \Pimcore\Model\DataObject\City|null
*/
public function getCity(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("city");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("city")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set city - City
* @param \Pimcore\Model\DataObject\City|null $city
* @return $this
*/
public function setCity(?\Pimcore\Model\Element\AbstractElement $city): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("city");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getCity();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $city);
	if (!$isEqual) {
		$this->markFieldDirty("city", true);
	}
	$this->city = $fd->preSetData($this, $city);
	return $this;
}

/**
* Get restaurant - Restaurant
* @return \Pimcore\Model\DataObject\Restaurant|null
*/
public function getRestaurant(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("restaurant");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("restaurant")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set restaurant - Restaurant
* @param \Pimcore\Model\DataObject\Restaurant|null $restaurant
* @return $this
*/
public function setRestaurant(?\Pimcore\Model\Element\AbstractElement $restaurant): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("restaurant");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getRestaurant();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $restaurant);
	if (!$isEqual) {
		$this->markFieldDirty("restaurant", true);
	}
	$this->restaurant = $fd->preSetData($this, $restaurant);
	return $this;
}

/**
* Get isTastiest - Is Tastiest
* @return bool|null
*/
public function getIsTastiest(): ?bool
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("isTastiest");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->isTastiest;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set isTastiest - Is Tastiest
* @param bool|null $isTastiest
* @return $this
*/
public function setIsTastiest(?bool $isTastiest): static
{
	$this->markFieldDirty("isTastiest", true);

	$this->isTastiest = $isTastiest;

	return $this;
}

/**
* Get listType - List Type
* @return string[]|null
*/
public function getListType(): ?array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("listType");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->listType;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set listType - List Type
* @param string[]|null $listType
* @return $this
*/
public function setListType(?array $listType): static
{
	$this->markFieldDirty("listType", true);

	$this->listType = $listType;

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
	$currentData = $this->getCategory();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $category);
	if (!$isEqual) {
		$this->markFieldDirty("category", true);
	}
	$this->category = $fd->preSetData($this, $category);
	return $this;
}

/**
* Get tags - Tags
* @return \Pimcore\Model\DataObject\Tag[]
*/
public function getTags(): array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("tags");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("tags")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set tags - Tags
* @param \Pimcore\Model\DataObject\Tag[] $tags
* @return $this
*/
public function setTags(?array $tags): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("tags");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getTags();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $tags);
	if (!$isEqual) {
		$this->markFieldDirty("tags", true);
	}
	$this->tags = $fd->preSetData($this, $tags);
	return $this;
}

/**
* Get expert - Expert
* @return \Pimcore\Model\DataObject\WebsiteUser|null
*/
public function getExpert(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("expert");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("expert")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set expert - Expert
* @param \Pimcore\Model\DataObject\WebsiteUser|null $expert
* @return $this
*/
public function setExpert(?\Pimcore\Model\Element\AbstractElement $expert): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("expert");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getExpert();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $expert);
	if (!$isEqual) {
		$this->markFieldDirty("expert", true);
	}
	$this->expert = $fd->preSetData($this, $expert);
	return $this;
}

/**
* Get itemPhotos - Item Photos
* @return \Pimcore\Model\DataObject\Data\ImageGallery|null
*/
public function getItemPhotos(): ?\Pimcore\Model\DataObject\Data\ImageGallery
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("itemPhotos");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->itemPhotos;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set itemPhotos - Item Photos
* @param \Pimcore\Model\DataObject\Data\ImageGallery|null $itemPhotos
* @return $this
*/
public function setItemPhotos(?\Pimcore\Model\DataObject\Data\ImageGallery $itemPhotos): static
{
	$this->markFieldDirty("itemPhotos", true);

	$this->itemPhotos = $itemPhotos;

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

}

