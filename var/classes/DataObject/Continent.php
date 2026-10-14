<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - name [input]
 * - slug [input]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\Continent\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\Continent\Listing|\Pimcore\Model\DataObject\Continent|null getByName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Continent\Listing|\Pimcore\Model\DataObject\Continent|null getBySlug(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class Continent extends Concrete
{
public const FIELD_NAME = 'name';
public const FIELD_SLUG = 'slug';

protected $classId = "Continent";
protected $className = "Continent";
protected $name;
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
* Get name - Name
* @return string|null
*/
public function getName(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("name");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->name;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set name - Name
* @param string|null $name
* @return $this
*/
public function setName(?string $name): static
{
	$this->markFieldDirty("name", true);

	$this->name = $name;

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

}

