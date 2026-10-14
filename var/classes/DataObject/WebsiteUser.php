<?php

/**
 * Inheritance: no
 * Variants: no
 *
 * Fields Summary:
 * - firstname [firstname]
 * - lastname [lastname]
 * - email [email]
 * - Avatar [image]
 * - subscribeForNewsletter [checkbox]
 * - isActive [checkbox]
 * - isExpert [checkbox]
 * - handle [input]
 * - bio [textarea]
 * - categories [manyToManyObjectRelation]
 * - city [manyToOneRelation]
 * - reviews [reverseObjectRelation]
 * - passwordResetExpiresAt [datetime]
 * - emailVerificationToken [input]
 * - passwordResetToken [input]
 * - tokenExpiresAt [datetime]
 * - adminUser [user]
 * - emailVerified [booleanSelect]
 * - roles [input]
 * - password [password]
 * - instagram [input]
 * - website [input]
 * - youtube [input]
 * - twitter [input]
 */

namespace Pimcore\Model\DataObject;

use Pimcore\Model\DataObject\Exception\InheritanceParentNotFoundException;
use Pimcore\Model\DataObject\PreGetValueHookInterface;

/**
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing getList(array $config = [])
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByFirstname(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByLastname(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByEmail(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByAvatar(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getBySubscribeForNewsletter(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByIsActive(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByIsExpert(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByHandle(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByBio(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByCategories(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByCity(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByReviews(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByPasswordResetExpiresAt(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByEmailVerificationToken(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByPasswordResetToken(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByTokenExpiresAt(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByAdminUser(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByRoles(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByInstagram(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByWebsite(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByYoutube(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
* @method static \Pimcore\Model\DataObject\WebsiteUser\Listing|\Pimcore\Model\DataObject\WebsiteUser|null getByTwitter(mixed $value, ?int $limit = null, int $offset = 0, ?array $objectTypes = null)
*/

class WebsiteUser extends Concrete
{
public const FIELD_FIRSTNAME = 'firstname';
public const FIELD_LASTNAME = 'lastname';
public const FIELD_EMAIL = 'email';
public const FIELD_AVATAR = 'Avatar';
public const FIELD_SUBSCRIBE_FOR_NEWSLETTER = 'subscribeForNewsletter';
public const FIELD_IS_ACTIVE = 'isActive';
public const FIELD_IS_EXPERT = 'isExpert';
public const FIELD_HANDLE = 'handle';
public const FIELD_BIO = 'bio';
public const FIELD_CATEGORIES = 'categories';
public const FIELD_CITY = 'city';
public const FIELD_REVIEWS = 'reviews';
public const FIELD_PASSWORD_RESET_EXPIRES_AT = 'passwordResetExpiresAt';
public const FIELD_EMAIL_VERIFICATION_TOKEN = 'emailVerificationToken';
public const FIELD_PASSWORD_RESET_TOKEN = 'passwordResetToken';
public const FIELD_TOKEN_EXPIRES_AT = 'tokenExpiresAt';
public const FIELD_ADMIN_USER = 'adminUser';
public const FIELD_EMAIL_VERIFIED = 'emailVerified';
public const FIELD_ROLES = 'roles';
public const FIELD_PASSWORD = 'password';
public const FIELD_INSTAGRAM = 'instagram';
public const FIELD_WEBSITE = 'website';
public const FIELD_YOUTUBE = 'youtube';
public const FIELD_TWITTER = 'twitter';

protected $classId = "WebsiteUser";
protected $className = "WebsiteUser";
protected $firstname;
protected $lastname;
protected $email;
protected $Avatar;
protected $subscribeForNewsletter;
protected $isActive;
protected $isExpert;
protected $handle;
protected $bio;
protected $categories;
protected $city;
protected $passwordResetExpiresAt;
protected $emailVerificationToken;
protected $passwordResetToken;
protected $tokenExpiresAt;
protected $adminUser;
protected $emailVerified;
protected $roles;
protected $password;
protected $instagram;
protected $website;
protected $youtube;
protected $twitter;


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
* Get firstname - First Name
* @return string|null
*/
public function getFirstname(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("firstname");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->firstname;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set firstname - First Name
* @param string|null $firstname
* @return $this
*/
public function setFirstname(?string $firstname): static
{
	$this->markFieldDirty("firstname", true);

	$this->firstname = $firstname;

	return $this;
}

/**
* Get lastname - Last Name
* @return string|null
*/
public function getLastname(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("lastname");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->lastname;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set lastname - Last Name
* @param string|null $lastname
* @return $this
*/
public function setLastname(?string $lastname): static
{
	$this->markFieldDirty("lastname", true);

	$this->lastname = $lastname;

	return $this;
}

/**
* Get email - Email
* @return string|null
*/
public function getEmail(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("email");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->email;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set email - Email
* @param string|null $email
* @return $this
*/
public function setEmail(?string $email): static
{
	$this->markFieldDirty("email", true);

	$this->email = $email;

	return $this;
}

/**
* Get Avatar - Avatar
* @return \Pimcore\Model\Asset\Image|null
*/
public function getAvatar(): ?\Pimcore\Model\Asset\Image
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("Avatar");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->Avatar;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set Avatar - Avatar
* @param \Pimcore\Model\Asset\Image|null $Avatar
* @return $this
*/
public function setAvatar(?\Pimcore\Model\Asset\Image $Avatar): static
{
	$this->markFieldDirty("Avatar", true);

	$this->Avatar = $Avatar;

	return $this;
}

/**
* Get subscribeForNewsletter - Subscribe For Newsletter
* @return bool|null
*/
public function getSubscribeForNewsletter(): ?bool
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("subscribeForNewsletter");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->subscribeForNewsletter;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set subscribeForNewsletter - Subscribe For Newsletter
* @param bool|null $subscribeForNewsletter
* @return $this
*/
public function setSubscribeForNewsletter(?bool $subscribeForNewsletter): static
{
	$this->markFieldDirty("subscribeForNewsletter", true);

	$this->subscribeForNewsletter = $subscribeForNewsletter;

	return $this;
}

/**
* Get isActive - Is Active
* @return bool|null
*/
public function getIsActive(): ?bool
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("isActive");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->isActive;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set isActive - Is Active
* @param bool|null $isActive
* @return $this
*/
public function setIsActive(?bool $isActive): static
{
	$this->markFieldDirty("isActive", true);

	$this->isActive = $isActive;

	return $this;
}

/**
* Get isExpert - Is Expert
* @return bool|null
*/
public function getIsExpert(): ?bool
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("isExpert");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->isExpert;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set isExpert - Is Expert
* @param bool|null $isExpert
* @return $this
*/
public function setIsExpert(?bool $isExpert): static
{
	$this->markFieldDirty("isExpert", true);

	$this->isExpert = $isExpert;

	return $this;
}

/**
* Get handle - Handle
* @return string|null
*/
public function getHandle(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("handle");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->handle;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set handle - Handle
* @param string|null $handle
* @return $this
*/
public function setHandle(?string $handle): static
{
	$this->markFieldDirty("handle", true);

	$this->handle = $handle;

	return $this;
}

/**
* Get bio - Bio
* @return string|null
*/
public function getBio(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("bio");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->bio;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set bio - Bio
* @param string|null $bio
* @return $this
*/
public function setBio(?string $bio): static
{
	$this->markFieldDirty("bio", true);

	$this->bio = $bio;

	return $this;
}

/**
* Get categories - Categories
* @return \Pimcore\Model\DataObject\FoodCategory[]
*/
public function getCategories(): array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("categories");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("categories")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set categories - Categories
* @param \Pimcore\Model\DataObject\FoodCategory[] $categories
* @return $this
*/
public function setCategories(?array $categories): static
{
	/** @var \Pimcore\Model\DataObject\ClassDefinition\Data\ManyToManyObjectRelation $fd */
	$fd = $this->getClass()->getFieldDefinition("categories");
	$hideUnpublished = \Pimcore\Model\DataObject\Concrete::getHideUnpublished();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished(false);
	$currentData = $this->getCategories();
	\Pimcore\Model\DataObject\Concrete::setHideUnpublished($hideUnpublished);
	$isEqual = $fd->isEqual($currentData, $categories);
	if (!$isEqual) {
		$this->markFieldDirty("categories", true);
	}
	$this->categories = $fd->preSetData($this, $categories);
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
* Get reviews - Reviews
* @return \Pimcore\Model\DataObject\Item[]
*/
public function getReviews(): array
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("reviews");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->getClass()->getFieldDefinition("reviews")->preGetData($this);

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Get passwordResetExpiresAt - Password Reset Expires At
* @return \Carbon\Carbon|null
*/
public function getPasswordResetExpiresAt(): ?\Carbon\Carbon
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("passwordResetExpiresAt");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->passwordResetExpiresAt;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set passwordResetExpiresAt - Password Reset Expires At
* @param \Carbon\Carbon|null $passwordResetExpiresAt
* @return $this
*/
public function setPasswordResetExpiresAt(?\Carbon\Carbon $passwordResetExpiresAt): static
{
	$this->markFieldDirty("passwordResetExpiresAt", true);

	$this->passwordResetExpiresAt = $passwordResetExpiresAt;

	return $this;
}

/**
* Get emailVerificationToken - Verification Token
* @return string|null
*/
public function getEmailVerificationToken(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("emailVerificationToken");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->emailVerificationToken;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set emailVerificationToken - Verification Token
* @param string|null $emailVerificationToken
* @return $this
*/
public function setEmailVerificationToken(?string $emailVerificationToken): static
{
	$this->markFieldDirty("emailVerificationToken", true);

	$this->emailVerificationToken = $emailVerificationToken;

	return $this;
}

/**
* Get passwordResetToken - Password Reset Token
* @return string|null
*/
public function getPasswordResetToken(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("passwordResetToken");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->passwordResetToken;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set passwordResetToken - Password Reset Token
* @param string|null $passwordResetToken
* @return $this
*/
public function setPasswordResetToken(?string $passwordResetToken): static
{
	$this->markFieldDirty("passwordResetToken", true);

	$this->passwordResetToken = $passwordResetToken;

	return $this;
}

/**
* Get tokenExpiresAt - Reset Token Expires At
* @return \Carbon\Carbon|null
*/
public function getTokenExpiresAt(): ?\Carbon\Carbon
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("tokenExpiresAt");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->tokenExpiresAt;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set tokenExpiresAt - Reset Token Expires At
* @param \Carbon\Carbon|null $tokenExpiresAt
* @return $this
*/
public function setTokenExpiresAt(?\Carbon\Carbon $tokenExpiresAt): static
{
	$this->markFieldDirty("tokenExpiresAt", true);

	$this->tokenExpiresAt = $tokenExpiresAt;

	return $this;
}

/**
* Get adminUser - Admin User
* @return string|null
*/
public function getAdminUser(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("adminUser");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->adminUser;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set adminUser - Admin User
* @param string|null $adminUser
* @return $this
*/
public function setAdminUser(?string $adminUser): static
{
	$this->markFieldDirty("adminUser", true);

	$this->adminUser = $adminUser;

	return $this;
}

/**
* Get emailVerified - Is Verified
* @return bool|null
*/
public function getEmailVerified(): ?bool
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("emailVerified");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->emailVerified;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set emailVerified - Is Verified
* @param bool|null $emailVerified
* @return $this
*/
public function setEmailVerified(?bool $emailVerified): static
{
	$this->markFieldDirty("emailVerified", true);

	$this->emailVerified = $emailVerified;

	return $this;
}

/**
* Get roles - Roles
* @return string|null
*/
public function getRoles(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("roles");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->roles;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set roles - Roles
* @param string|null $roles
* @return $this
*/
public function setRoles(?string $roles): static
{
	$this->markFieldDirty("roles", true);

	$this->roles = $roles;

	return $this;
}

/**
* Get password - Password
* @return string|null
*/
public function getPassword(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("password");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->password;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set password - Password
* @param string|null $password
* @return $this
*/
public function setPassword(?string $password): static
{
	$this->markFieldDirty("password", true);

	$this->password = $password;

	return $this;
}

/**
* Get instagram - Instagram
* @return string|null
*/
public function getInstagram(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("instagram");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->instagram;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set instagram - Instagram
* @param string|null $instagram
* @return $this
*/
public function setInstagram(?string $instagram): static
{
	$this->markFieldDirty("instagram", true);

	$this->instagram = $instagram;

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
* Get youtube - Youtube
* @return string|null
*/
public function getYoutube(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("youtube");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->youtube;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set youtube - Youtube
* @param string|null $youtube
* @return $this
*/
public function setYoutube(?string $youtube): static
{
	$this->markFieldDirty("youtube", true);

	$this->youtube = $youtube;

	return $this;
}

/**
* Get twitter - Twitter
* @return string|null
*/
public function getTwitter(): ?string
{
	if ($this instanceof PreGetValueHookInterface && !\Pimcore::inAdmin()) {
		$preValue = $this->preGetValue("twitter");
		if ($preValue !== null) {
			return $preValue;
		}
	}

	$data = $this->twitter;

	if ($data instanceof \Pimcore\Model\DataObject\Data\EncryptedField) {
		return $data->getPlain();
	}

	return $data;
}

/**
* Set twitter - Twitter
* @param string|null $twitter
* @return $this
*/
public function setTwitter(?string $twitter): static
{
	$this->markFieldDirty("twitter", true);

	$this->twitter = $twitter;

	return $this;
}

}

