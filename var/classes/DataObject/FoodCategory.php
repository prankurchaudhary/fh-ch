<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - categoryName [input]
 * - description [textarea]
 * - slug [input]
 * - restaurants [reverseObjectRelation]
 * - expert [reverseObjectRelation]
 * - items [reverseObjectRelation]
 * - foodCategoryImage [image]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\FoodCategory\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\FoodCategory\Listing|\Pimcore\Model\DataObject\FoodCategory|null getByCategoryName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\FoodCategory\Listing|\Pimcore\Model\DataObject\FoodCategory|null getByDescription(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\FoodCategory\Listing|\Pimcore\Model\DataObject\FoodCategory|null getBySlug(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\FoodCategory\Listing|\Pimcore\Model\DataObject\FoodCategory|null getByRestaurants(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\FoodCategory\Listing|\Pimcore\Model\DataObject\FoodCategory|null getByExpert(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\FoodCategory\Listing|\Pimcore\Model\DataObject\FoodCategory|null getByItems(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\FoodCategory\Listing|\Pimcore\Model\DataObject\FoodCategory|null getByFoodCategoryImage(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class FoodCategory extends Concrete
{
public const FIELD_CATEGORY_NAME = 'categoryName';
public const FIELD_DESCRIPTION = 'description';
public const FIELD_SLUG = 'slug';
public const FIELD_RESTAURANTS = 'restaurants';
public const FIELD_EXPERT = 'expert';
public const FIELD_ITEMS = 'items';
public const FIELD_FOOD_CATEGORY_IMAGE = 'foodCategoryImage';

protected $classId = "FoodCategory";
protected $className = "FoodCategory";
protected $categoryName;
protected $description;
protected $slug;
protected $foodCategoryImage;


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
* Get categoryName - Category Name
* @return string|null
*/
public function getCategoryName(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("categoryName");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->categoryName;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set categoryName - Category Name
* @param string|null $categoryName
* @return $this
*/
public function setCategoryName(?string $categoryName): static
{
	$this->markFieldDirty("categoryName", true);

	$this->categoryName = $categoryName;

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

	$data = $this->description;

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
* Get restaurants - Restaurants
* @return \Pimcore\Model\DataObject\AbstractObject[]
*/
public function getRestaurants(): array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("restaurants");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("restaurants")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Get expert - Expert
* @return \Pimcore\Model\DataObject\AbstractObject[]
*/
public function getExpert(): array
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
* Get items - Items
* @return \Pimcore\Model\DataObject\AbstractObject[]
*/
public function getItems(): array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("items");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("items")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Get foodCategoryImage - Food Category Image
* @return \Pimcore\Model\Asset\Image|null
*/
public function getFoodCategoryImage(): ?\Pimcore\Model\Asset\Image
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("foodCategoryImage");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->foodCategoryImage;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set foodCategoryImage - Food Category Image
* @param \Pimcore\Model\Asset\Image|null $foodCategoryImage
* @return $this
*/
public function setFoodCategoryImage(?\Pimcore\Model\Asset\Image $foodCategoryImage): static
{
	$this->markFieldDirty("foodCategoryImage", true);

	$this->foodCategoryImage = $foodCategoryImage;

	return $this;
}

}

