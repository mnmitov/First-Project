<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="This email is already used! Please enter another valid email.")
 */
class User implements UserInterface, \Serializable
{
  const LIVINGPLACES = ['Sofia', 'Plovdiv', 'Varna', 'Burgas', 'Stara Zagora', 'Ruse', 'Dobrich'];
  const GENDERS = ['Male', 'Female'];

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var ArrayCollection
   *
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\Tender", cascade={"persist"}, mappedBy="owner")
   */
  private $tenders;

  /**
   * @var ArrayCollection
   *
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\Meeting", cascade={"persist"}, mappedBy="author")
   */
  private $meeting;


  /**
   * @var string
   *
   * @Assert\NotBlank(message="Please enter your email!")
   * @Assert\Email(message="This is not a valid email.")
   *
   * @ORM\Column(name="email", type="string", length=255, unique=true)
   */
  private $email;

  /**
   * @var string
   *
   * @Assert\Length(min="4", minMessage="First Name should be at least 4 symbols")
   * @Assert\NotBlank(message="Please enter your first name!")
   *
   * @ORM\Column(name="firstName", type="string", length=255)
   */
  private $firstName;

  /**
   * @var string
   *
   * @Assert\Length(min="4", minMessage="Last Name should be at least 4 symbols")
   * @Assert\NotBlank(message="Please enter your last name!")
   *
   * @ORM\Column(name="lastName", type="string", length=255)
   */
  private $lastName;

  /**
   * @var \DateTime
   *
   * @Assert\NotBlank(message="Please pick your birth date!")
   * @Assert\Date(message="The date must be in the right format!")
   *
   * @ORM\Column(name="bornDate", type="datetime")
   */
  private $bornDate;

  /**
   * @var string
   *
     * @Assert\NotBlank(message="Please enter a valid password!")
     * @Assert\Length(min="6", minMessage="Password must be at least 6 symbols")
   *
   * @ORM\Column(name="password", type="string", length=255)
   */
  private $password;

  /**
   * @var string
   *
   * @Assert\NotBlank(message="Please enter additional information about you with at least 10 symbols!")
   * @Assert\Length(min="10", minMessage="Additional information must be at least 10 symbols!")
   *
   * @ORM\Column(name="additInfo", type="text")
   */
  private $additInfo;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="createdOn", type="datetime")
   */
  private $createdOn;

  /**
   * @var string
   *
   * @Assert\Choice(choices=User::GENDERS, message="Please select your gender!")
   * @Assert\NotBlank(message="Please select your gender!")
   *
   * @ORM\Column(name="gender", type="string", length=255)
   */
  private $gender;


  /**
   * @var string
   *
   * @Assert\Choice(choices=User::LIVINGPLACES, message="Please select your city!")
   * @Assert\NotBlank(message="Please select your city!")
   *
   * @ORM\Column(name="livingPlace", type="string", length=255)
   */
  private $livingPlace;

  /**
   * @var ArrayCollection
   * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role")
   */
  private $role;


  /**
   * Get id.
   *
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set email.
   *
   * @param string $email
   *
   * @return User
   */
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get email.
   *
   * @return string
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set firstName.
   *
   * @param string $firstName
   *
   * @return User
   */
  public function setFirstName($firstName)
  {
    $this->firstName = $firstName;

    return $this;
  }

  /**
   * Get firstName.
   *
   * @return string
   */
  public function getFirstName()
  {
    return $this->firstName;
  }

  /**
   * Set lastName.
   *
   * @param string $lastName
   *
   * @return User
   */
  public function setLastName($lastName)
  {
    $this->lastName = $lastName;

    return $this;
  }

  /**
   * Get lastName.
   *
   * @return string
   */
  public function getLastName()
  {
    return $this->lastName;
  }

  /**
   * Set bornDate.
   *
   * @param \DateTime $bornDate
   *
   * @return User
   */
  public function setBornDate($bornDate)
  {
    $this->bornDate = $bornDate;

    return $this;
  }

  /**
   * Get bornDate.
   *
   * @return \DateTime
   */
  public function getBornDate()
  {
    return $this->bornDate;
  }

  /**
   * Set password.
   *
   * @param string $password
   *
   * @return User
   */
  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

  /**
   * Get password.
   *
   * @return string
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set additInfo.
   *
   * @param string $additInfo
   *
   * @return User
   */
  public function setAdditInfo($additInfo)
  {
    $this->additInfo = $additInfo;

    return $this;
  }

  /**
   * Get additInfo.
   *
   * @return string
   */
  public function getAdditInfo()
  {
    return $this->additInfo;
  }

  /**
   * Set createdOn.
   *
   * @param mixed $createdOn
   *
   * @return User
   */
  public function setCreatedOn($createdOn)
  {
    $this->createdOn = $createdOn;

    return $this;
  }

  /**
   * Get createdOn.
   *
   * @return mixed
   */
  public function getCreatedOn()
  {
    return $this->createdOn;
  }

  /**
   * Get Gender.
   *
   * @return string
   */
  public function getGender()
  {
    return $this->gender;
  }

  /**
   * Set gender.
   *
   * @param string $gender
   *
   * @return User
   */
  public function setGender($gender)
  {
    $this->gender = $gender;

    return $this;
  }

  /**
   * Get livingPlace.
   *
   * @return string
   */
  public function getLivingPlace()
  {
    return $this->livingPlace;
  }

  /**
   * Set livingPlace.
   *
   * @param string $livingPlace
   *
   * @return User
   */
  public function setLivingPlace($livingPlace)
  {
    $this->livingPlace = $livingPlace;
    return $this;
  }

  /**
   * @return Tender[]|ArrayCollection
   */
  public function getTenders(): ArrayCollection
  {
    return $this->tenders;
  }

  public function setTenders($tenders)
  {
    $this->tenders = $tenders;
    return $this;
  }

  /**
   * @return Meeting[]|ArrayCollection
   */
  public function getMeeting(): ArrayCollection
  {
    return $this->meeting;
  }


  public function setMeeting($meeting)
  {
    $this->meeting = $meeting;
    return $this;
  }



  /**
   * @param Role $role
   * @return User
   */
  public function addRole(Role $role)
  {
    $this->role[] = $role;
    return $this;
  }


  public function setRole($role)
  {
    $this->role = $role;
    return $this;
  }


  /**
   * @param Tender $tender
   * @return bool
   */
  public function isAuthor(Tender $tender)
  {
    return $tender->getOwner()->getId() === $this->getId();
  }

  /**
   * @return bool
   */
  public function isAdmin()
  {
    return in_array('ROLE_ADMIN', $this->getRoles());
  }


  /**
   * @param Meeting $meeting
   * @return bool
   */
  public function isInitiator(Meeting $meeting)
  {
    return $meeting->getAuthor()->getId() === $this->getId();
  }




  /**
   * User constructor.
   * @throws \Exception
   */
  public function __construct()
  {
    $this->createdOn = new \DateTime('now');
    $this->tenders = new ArrayCollection();
    $this->role = new ArrayCollection();
    $this->meeting = new ArrayCollection();
  }


  /**
   * Returns the roles granted to the user.
   *
   *     public function getRoles()
   *     {
   *         return ['ROLE_USER'];
   *     }
   *
   * Alternatively, the roles might be stored on a ``roles`` property,
   * and populated in any number of different ways when the user object
   * is created.
   *
   * @return array (Role|string)[] The user roles
   */
  public function getRoles()
  {
    $stringRoles = [];

    /** @var Role $role */
    foreach ($this->role as $role) {
      $stringRoles[] = $role->getRole();
    }
    return $stringRoles;
  }

  /**
   * Returns the salt that was originally used to encode the password.
   *
   * This can return null if the password was not encoded using a salt.
   *
   * @return string|null The salt
   */
  public function getSalt()
  {
    // TODO: Implement getSalt() method.
  }

  /**
   * Returns the username used to authenticate the user.
   *
   * @return string The username
   */
  public function getUsername()
  {
    return $this->email;
  }

  /**
   * Removes sensitive data from the user.
   *
   * This is important if, at any given point, sensitive information like
   * the plain-text password is stored on this object.
   */
  public function eraseCredentials()
  {
    // TODO: Implement eraseCredentials() method.
  }

  /**
   * @see \Serializable::serialize()
   */
  public function serialize()
  {
    return serialize([
      $this->id,
      $this->email,
      $this->password,
    ]);
  }

  /**
   * @see \Serializable::unserialize()
   */
  public function unserialize($serialized)
  {
    list (
      $this->id,
      $this->email,
      $this->password,
      ) = unserialize($serialized, ['allowed_classes' => false]);
  }
}
