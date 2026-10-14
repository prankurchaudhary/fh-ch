<?php

/**
 * Inheritance: yes
 * Variants: yes
 *
 * Fields Summary:
 * - name [input]
 * - dishName [input]
 * - address [textarea]
 * - description [wysiwyg]
 * - timings [textarea]
 * - status [checkbox]
 * - urlSlug [urlSlug]
 * - city [manyToOneRelation]
 * - slug [input]
 * - dishSlug [input]
 * - items [reverseObjectRelation]
 * - restaurantPhotos [imageGallery]
 * - instagramLink [input]
 * - youtubeLink [input]
 * - twitterLink [input]
 * - website [input]
 * - phone [input]
 * - location [geopoint]
 * - category [manyToOneRelation]
 * - expert [manyToOneRelation]
 * - openingHours [block]
 * -- day [select]
 * -- openTime [time]
 * -- closeTime [time]
 * -- isClosed [checkbox]
 * - essentialEats [block]
 * -- essentialType [select]
 * -- essentialDetail [textarea]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\Restaurant\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByDishName(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByAddress(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByDescription(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByTimings(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByStatus(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByUrlSlug(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByCity(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getBySlug(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByDishSlug(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByItems(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByInstagramLink(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByYoutubeLink(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByTwitterLink(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByWebsite(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByPhone(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByCategory(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\Restaurant\Listing|\Pimcore\Model\DataObject\Restaurant|null getByExpert(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class Restaurant extends Concrete
{
public const FIELD_NAME = 'name';
public const FIELD_DISH_NAME = 'dishName';
public const FIELD_ADDRESS = 'address';
public const FIELD_DESCRIPTION = 'description';
public const FIELD_TIMINGS = 'timings';
public const FIELD_STATUS = 'status';
public const FIELD_URL_SLUG = 'urlSlug';
public const FIELD_CITY = 'city';
public const FIELD_SLUG = 'slug';
public const FIELD_DISH_SLUG = 'dishSlug';
public const FIELD_ITEMS = 'items';
public const FIELD_RESTAURANT_PHOTOS = 'restaurantPhotos';
public const FIELD_INSTAGRAM_LINK = 'instagramLink';
public const FIELD_YOUTUBE_LINK = 'youtubeLink';
public const FIELD_TWITTER_LINK = 'twitterLink';
public const FIELD_WEBSITE = 'website';
public const FIELD_PHONE = 'phone';
public const FIELD_LOCATION = 'location';
public const FIELD_CATEGORY = 'category';
public const FIELD_EXPERT = 'expert';
public const FIELD_OPENING_HOURS = 'openingHours';
public const FIELD_ESSENTIAL_EATS = 'essentialEats';

protected $classId = "Restaurant";
protected $className = "Restaurant";
protected $name;
protected $dishName;
protected $address;
protected $description;
protected $timings;
protected $status;
protected $urlSlug;
protected $city;
protected $slug;
protected $dishSlug;
protected $restaurantPhotos;
protected $instagramLink;
protected $youtubeLink;
protected $twitterLink;
protected $website;
protected $phone;
protected $location;
protected $category;
protected $expert;
protected $openingHours;
protected $essentialEats;


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

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("name");
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
* Get dishName - Dish Name
* @return string|null
*/
public function getDishName(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("dishName");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->dishName;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("dishName")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("dishName");
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
* Set dishName - Dish Name
* @param string|null $dishName
* @return $this
*/
public function setDishName(?string $dishName): static
{
	$this->markFieldDirty("dishName", true);

	$this->dishName = $dishName;

	return $this;
}

/**
* Get address - Address
* @return string|null
*/
public function getAddress(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("address");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->address;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("address")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("address");
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
* Set address - Address
* @param string|null $address
* @return $this
*/
public function setAddress(?string $address): static
{
	$this->markFieldDirty("address", true);

	$this->address = $address;

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

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("description")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("description");
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
* Get timings - Timings
* @return string|null
*/
public function getTimings(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("timings");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->timings;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("timings")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("timings");
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
* Set timings - Timings
* @param string|null $timings
* @return $this
*/
public function setTimings(?string $timings): static
{
	$this->markFieldDirty("timings", true);

	$this->timings = $timings;

	return $this;
}

/**
* Get status - Status
* @return bool|null
*/
public function getStatus(): ?bool
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("status");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->status;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("status")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("status");
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
* Set status - Status
* @param bool|null $status
* @return $this
*/
public function setStatus(?bool $status): static
{
	$this->markFieldDirty("status", true);

	$this->status = $status;

	return $this;
}

/**
* Get urlSlug - Url Slug
* @return \Pimcore\Model\DataObject\Data\UrlSlug[]
*/
public function getUrlSlug(): ?array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("urlSlug");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("urlSlug")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set urlSlug - Url Slug
* @param \Pimcore\Model\DataObject\Data\UrlSlug[] $urlSlug
* @return $this
*/
public function setUrlSlug(?array $urlSlug): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\UrlSlug $fd */
	$fd = $this->getClass()->getFieldDefinition("urlSlug");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getUrlSlug();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $urlSlug);
	if (!$isEqual) {
		$this->markFieldDirty("urlSlug", true);
	}
	$this->urlSlug = $fd->preSetData($this, $urlSlug);
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

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("city")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("city");
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
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getCity();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $city);
	if (!$isEqual) {
		$this->markFieldDirty("city", true);
	}
	$this->city = $fd->preSetData($this, $city);
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
* Get dishSlug - Dish Slug
* @return string|null
*/
public function getDishSlug(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("dishSlug");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->dishSlug;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("dishSlug")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("dishSlug");
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
* Set dishSlug - Dish Slug
* @param string|null $dishSlug
* @return $this
*/
public function setDishSlug(?string $dishSlug): static
{
	$this->markFieldDirty("dishSlug", true);

	$this->dishSlug = $dishSlug;

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

/**
* Get restaurantPhotos - Restaurant Photos
* @return \Pimcore\Model\DataObject\Data\ImageGallery|null
*/
public function getRestaurantPhotos(): ?\Pimcore\Model\DataObject\Data\ImageGallery
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("restaurantPhotos");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->restaurantPhotos;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("restaurantPhotos")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("restaurantPhotos");
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
* Set restaurantPhotos - Restaurant Photos
* @param \Pimcore\Model\DataObject\Data\ImageGallery|null $restaurantPhotos
* @return $this
*/
public function setRestaurantPhotos(?\Pimcore\Model\DataObject\Data\ImageGallery $restaurantPhotos): static
{
	$this->markFieldDirty("restaurantPhotos", true);

	$this->restaurantPhotos = $restaurantPhotos;

	return $this;
}

/**
* Get instagramLink - Instagram Link
* @return string|null
*/
public function getInstagramLink(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("instagramLink");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->instagramLink;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("instagramLink")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("instagramLink");
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
* Set instagramLink - Instagram Link
* @param string|null $instagramLink
* @return $this
*/
public function setInstagramLink(?string $instagramLink): static
{
	$this->markFieldDirty("instagramLink", true);

	$this->instagramLink = $instagramLink;

	return $this;
}

/**
* Get youtubeLink - Youtube Link
* @return string|null
*/
public function getYoutubeLink(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("youtubeLink");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->youtubeLink;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("youtubeLink")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("youtubeLink");
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
* Set youtubeLink - Youtube Link
* @param string|null $youtubeLink
* @return $this
*/
public function setYoutubeLink(?string $youtubeLink): static
{
	$this->markFieldDirty("youtubeLink", true);

	$this->youtubeLink = $youtubeLink;

	return $this;
}

/**
* Get twitterLink - Twitter Link
* @return string|null
*/
public function getTwitterLink(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("twitterLink");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->twitterLink;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("twitterLink")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("twitterLink");
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
* Set twitterLink - Twitter Link
* @param string|null $twitterLink
* @return $this
*/
public function setTwitterLink(?string $twitterLink): static
{
	$this->markFieldDirty("twitterLink", true);

	$this->twitterLink = $twitterLink;

	return $this;
}

/**
* Get website - Website
* @return string|null
*/
public function getWebsite(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("website");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->website;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("website")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("website");
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
* Set website - Website
* @param string|null $website
* @return $this
*/
public function setWebsite(?string $website): static
{
	$this->markFieldDirty("website", true);

	$this->website = $website;

	return $this;
}

/**
* Get phone - Phone
* @return string|null
*/
public function getPhone(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("phone");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->phone;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("phone")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("phone");
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
* Set phone - Phone
* @param string|null $phone
* @return $this
*/
public function setPhone(?string $phone): static
{
	$this->markFieldDirty("phone", true);

	$this->phone = $phone;

	return $this;
}

/**
* Get location - Location
* @return \Pimcore\Model\DataObject\Data\GeoCoordinates|null
*/
public function getLocation(): ?\Pimcore\Model\DataObject\Data\GeoCoordinates
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("location");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->location;

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("location")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("location");
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
* Set location - Location
* @param \Pimcore\Model\DataObject\Data\GeoCoordinates|null $location
* @return $this
*/
public function setLocation(?\Pimcore\Model\DataObject\Data\GeoCoordinates $location): static
{
	$this->markFieldDirty("location", true);

	$this->location = $location;

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

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("expert")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("expert");
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
	$currentData = \Pimcore\Model\DataObject\Service::useInheritedValues(false, function() {
		return $this->getExpert();
	});
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $expert);
	if (!$isEqual) {
		$this->markFieldDirty("expert", true);
	}
	$this->expert = $fd->preSetData($this, $expert);
	return $this;
}

/**
* Get openingHours - Opening Hours
* @return \Pimcore\Model\DataObject\Data\BlockElement[][]
*/
public function getOpeningHours(): ?array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("openingHours");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("openingHours")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("openingHours")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("openingHours");
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
* Set openingHours - Opening Hours
* @param \Pimcore\Model\DataObject\Data\BlockElement[][] $openingHours
* @return $this
*/
public function setOpeningHours(?array $openingHours): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\Block $fd */
	$fd = $this->getClass()->getFieldDefinition("openingHours");
	$this->openingHours = $fd->preSetData($this, $openingHours);
	return $this;
}

/**
* Get essentialEats - Essential Eats
* @return \Pimcore\Model\DataObject\Data\BlockElement[][]
*/
public function getEssentialEats(): ?array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("essentialEats");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("essentialEats")->preGetData($this);

	if (\Pimcore\Model\DataObject::doGetInheritedValues() && $this->getClass()->getFieldDefinition("essentialEats")->isEmpty($data)) {
		try {
			return $this->getValueFromParent("essentialEats");
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
* Set essentialEats - Essential Eats
* @param \Pimcore\Model\DataObject\Data\BlockElement[][] $essentialEats
* @return $this
*/
public function setEssentialEats(?array $essentialEats): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\Block $fd */
	$fd = $this->getClass()->getFieldDefinition("essentialEats");
	$this->essentialEats = $fd->preSetData($this, $essentialEats);
	return $this;
}

}

