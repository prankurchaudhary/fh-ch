<?php

namespace Pimcore\Model\DataObject\WebsiteUser;

use Pimcore\Model;
use Pimcore\Model\DataObject;

/**
 * @method DataObject\WebsiteUser|false current()
 * @method DataObject\WebsiteUser[] load()
 * @method DataObject\WebsiteUser[] getData()
 * @method DataObject\WebsiteUser[] getObjects()
 */

class Listing extends DataObject\Listing\Concrete
{
protected $classId = "WebsiteUser";
protected $className = "WebsiteUser";


/**
* Filter by firstname (First Name)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByFirstname ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("firstname")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by lastname (Last Name)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByLastname ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("lastname")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by email (Email)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByEmail ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("email")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by Avatar (Avatar)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByAvatar ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("Avatar")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by subscribeForNewsletter (Subscribe For Newsletter)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterBySubscribeForNewsletter ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("subscribeForNewsletter")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by isActive (Is Active)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByIsActive ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("isActive")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by isExpert (Is Expert)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByIsExpert ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("isExpert")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by handle (Handle)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByHandle ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("handle")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by bio (Bio)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByBio ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("bio")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by categories (Categories)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCategories ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("categories")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by city (City)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByCity ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("city")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by reviews (Reviews)
* @param mixed $data
* @param string $operator SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByReviews ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("reviews")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by passwordResetExpiresAt (Password Reset Expires At)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByPasswordResetExpiresAt ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("passwordResetExpiresAt")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by emailVerificationToken (Verification Token)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByEmailVerificationToken ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("emailVerificationToken")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by passwordResetToken (Password Reset Token)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByPasswordResetToken ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("passwordResetToken")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by tokenExpiresAt (Reset Token Expires At)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByTokenExpiresAt ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("tokenExpiresAt")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by adminUser (Admin User)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByAdminUser ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("adminUser")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by roles (Roles)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByRoles ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("roles")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by instagram (Instagram)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByInstagram ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("instagram")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by website (Website)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByWebsite ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("website")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by youtube (Youtube)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByYoutube ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("youtube")->addListingFilter($this, $data, $operator);
	return $this;
}

/**
* Filter by twitter (Twitter)
* @param string|int|float|array|Model\Element\ElementInterface $data  comparison data, can be scalar or array (if operator is e.g. "IN (?)")
* @param string $operator  SQL comparison operator, e.g. =, <, >= etc. You can use "?" as placeholder, e.g. "IN (?)"
* @return $this
*/
public function filterByTwitter ($data, $operator = '='): static
{
	$this->getClass()->getFieldDefinition("twitter")->addListingFilter($this, $data, $operator);
	return $this;
}



}
