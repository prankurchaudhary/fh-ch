<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - name [input]
 * - country [country]
 * - active [checkbox]
 * - slug [input]
 * - description [wysiwyg]
 * - latitude [input]
 * - longitude [input]
 * - timezone [select]
 * - zipcode [input]
 * - cityPhoto [image]
 * - restaurants [reverseObjectRelation]
 * - expert [manyToOneRelation]
 * - Continent [manyToOneRelation]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\City\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getByName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getByCountry(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getByActive(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getBySlug(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getByDescription(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getByLatitude(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getByLongitude(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getByTimezone(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getByZipcode(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getByCityPhoto(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getByRestaurants(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getByExpert(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\City\Listing|\Pimcore\Model\DataObject\City|null getByContinent(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class City extends Concrete
{
public const FIELD_NAME = 'name';
public const FIELD_COUNTRY = 'country';
public const FIELD_ACTIVE = 'active';
public const FIELD_SLUG = 'slug';
public const FIELD_DESCRIPTION = 'description';
public const FIELD_LATITUDE = 'latitude';
public const FIELD_LONGITUDE = 'longitude';
public const FIELD_TIMEZONE = 'timezone';
public const FIELD_ZIPCODE = 'zipcode';
public const FIELD_CITY_PHOTO = 'cityPhoto';
public const FIELD_RESTAURANTS = 'restaurants';
public const FIELD_EXPERT = 'expert';
public const FIELD_CONTINENT = 'Continent';

protected $classId = "City";
protected $className = "City";
protected $name;
protected $country;
protected $active;
protected $slug;
protected $description;
protected $latitude;
protected $longitude;
protected $timezone;
protected $zipcode;
protected $cityPhoto;
protected $expert;
protected $Continent;


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
* Get name - City Name
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
* Set name - City Name
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
* Get country - Country
* @return string|null
*/
public function getCountry(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("country");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->country;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set country - Country
* @param string|null $country
* @return $this
*/
public function setCountry(?string $country): static
{
	$this->markFieldDirty("country", true);

	$this->country = $country;

	return $this;
}

/**
* Get active - Active
* @return bool|null
*/
public function getActive(): ?bool
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("active");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->active;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set active - Active
* @param bool|null $active
* @return $this
*/
public function setActive(?bool $active): static
{
	$this->markFieldDirty("active", true);

	$this->active = $active;

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
* Get latitude - Latitude
* @return string|null
*/
public function getLatitude(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("latitude");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->latitude;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set latitude - Latitude
* @param string|null $latitude
* @return $this
*/
public function setLatitude(?string $latitude): static
{
	$this->markFieldDirty("latitude", true);

	$this->latitude = $latitude;

	return $this;
}

/**
* Get longitude - Longitude
* @return string|null
*/
public function getLongitude(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("longitude");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->longitude;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set longitude - Longitude
* @param string|null $longitude
* @return $this
*/
public function setLongitude(?string $longitude): static
{
	$this->markFieldDirty("longitude", true);

	$this->longitude = $longitude;

	return $this;
}

/**
* Get timezone - Timezone
* @return string|null
*/
public function getTimezone(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("timezone");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->timezone;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set timezone - Timezone
* @param string|null $timezone
* @return $this
*/
public function setTimezone(?string $timezone): static
{
	$this->markFieldDirty("timezone", true);

	$this->timezone = $timezone;

	return $this;
}

/**
* Get zipcode - Zipcode
* @return string|null
*/
public function getZipcode(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("zipcode");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->zipcode;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set zipcode - Zipcode
* @param string|null $zipcode
* @return $this
*/
public function setZipcode(?string $zipcode): static
{
	$this->markFieldDirty("zipcode", true);

	$this->zipcode = $zipcode;

	return $this;
}

/**
* Get cityPhoto - City Photo
* @return \Pimcore\Model\Asset\Image|null
*/
public function getCityPhoto(): ?\Pimcore\Model\Asset\Image
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("cityPhoto");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->cityPhoto;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set cityPhoto - City Photo
* @param \Pimcore\Model\Asset\Image|null $cityPhoto
* @return $this
*/
public function setCityPhoto(?\Pimcore\Model\Asset\Image $cityPhoto): static
{
	$this->markFieldDirty("cityPhoto", true);

	$this->cityPhoto = $cityPhoto;

	return $this;
}

/**
* Get restaurants - Restaurants
* @return \Pimcore\Model\DataObject\Restaurant[]
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
* Get Continent - Continent
* @return \Pimcore\Model\DataObject\Continent|null
*/
public function getContinent(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("Continent");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("Continent")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set Continent - Continent
* @param \Pimcore\Model\DataObject\Continent|null $Continent
* @return $this
*/
public function setContinent(?\Pimcore\Model\Element\AbstractElement $Continent): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("Continent");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getContinent();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $Continent);
	if (!$isEqual) {
		$this->markFieldDirty("Continent", true);
	}
	$this->Continent = $fd->preSetData($this, $Continent);
	return $this;
}

}

