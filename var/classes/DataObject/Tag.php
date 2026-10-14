<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - tagName [input]
 * - slug [input]
 * - items [reverseObjectRelation]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\Tag\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\Tag\Listing|\Pimcore\Model\DataObject\Tag|null getByTagName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Tag\Listing|\Pimcore\Model\DataObject\Tag|null getBySlug(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Tag\Listing|\Pimcore\Model\DataObject\Tag|null getByItems(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class Tag extends Concrete
{
public const FIELD_TAG_NAME = 'tagName';
public const FIELD_SLUG = 'slug';
public const FIELD_ITEMS = 'items';

protected $classId = "Tag";
protected $className = "Tag";
protected $tagName;
protected $slug;


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
* Get tagName - Tag Name
* @return string|null
*/
public function getTagName(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("tagName");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->tagName;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set tagName - Tag Name
* @param string|null $tagName
* @return $this
*/
public function setTagName(?string $tagName): static
{
	$this->markFieldDirty("tagName", true);

	$this->tagName = $tagName;

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
* Get items - Items
* @return \Pimcore\Model\DataObject\Item[]
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

}

