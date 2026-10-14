<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - user [manyToOneRelation]
 * - restaurant [manyToOneRelation]
 * - createdAt [datetime]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\RestaurantWishlist\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\RestaurantWishlist\Listing|\Pimcore\Model\DataObject\RestaurantWishlist|null getByUser(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\RestaurantWishlist\Listing|\Pimcore\Model\DataObject\RestaurantWishlist|null getByRestaurant(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\RestaurantWishlist\Listing|\Pimcore\Model\DataObject\RestaurantWishlist|null getByCreatedAt(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class RestaurantWishlist extends Concrete
{
public const FIELD_USER = 'user';
public const FIELD_RESTAURANT = 'restaurant';
public const FIELD_CREATED_AT = 'createdAt';

protected $classId = "RestaurantWishlist";
protected $className = "RestaurantWishlist";
protected $user;
protected $restaurant;
protected $createdAt;


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
* Get user - User
* @return \Pimcore\Model\DataObject\WebsiteUser|null
*/
public function getUser(): ?\Pimcore\Model\Element\AbstractElement
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("user");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("user")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set user - User
* @param \Pimcore\Model\DataObject\WebsiteUser|null $user
* @return $this
*/
public function setUser(?\Pimcore\Model\Element\AbstractElement $user): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("user");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getUser();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $user);
	if (!$isEqual) {
		$this->markFieldDirty("user", true);
	}
	$this->user = $fd->preSetData($this, $user);
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
* Get createdAt - Created At
* @return \Carbon\Carbon|null
*/
public function getCreatedAt(): ?\Carbon\Carbon
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("createdAt");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->createdAt;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set createdAt - Created At
* @param \Carbon\Carbon|null $createdAt
* @return $this
*/
public function setCreatedAt(?\Carbon\Carbon $createdAt): static
{
	$this->markFieldDirty("createdAt", true);

	$this->createdAt = $createdAt;

	return $this;
}

}

