<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tender
 *
 * @ORM\Table(name="tenders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TenderRepository")
 */
class Tender
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string
   * @Assert\NotBlank(message="Tender name field should not be empty!")
   * @ORM\Column(name="Name", type="string", length=255)
   */
  private $name;

  /**
   * @var User
   *
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", cascade={"persist"}, inversedBy="tenders")
   */
  private $owner;

  /**
   * @var string
   * @Assert\NotBlank(message="City field should not be empty!")
   * @ORM\Column(name="City", type="string", length=255)
   */
  private $city;

  /**
   * @var string
   * @Assert\NotBlank(message="Tender type field should not be empty!")
   * @ORM\Column(name="Type", type="string", length=255)
   */
  private $type;

  /**
   * @var float
   *
   * @Assert\NotBlank(message="Budget field should not be empty!")
   *
   * @ORM\Column(name="Money", type="decimal", scale=2, precision=10)
   */
  private $money;

  /**
   * @var \DateTime
   *
   * @Assert\NotBlank(message="The deadline field should not be empty!")
   *
   * @ORM\Column(name="Deadline", type="datetime")
   */
  private $deadline;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="addedOn", type="datetime")
   */
  private $addedOn;

  /**
   * @var string
   *
   * @ORM\Column(name="addedBy", type="string", length=255)
   */
  private $addedBy;

  /**
   * Tender constructor.
   */
  public function __construct()
  {
    $this->addedOn = new \DateTime('now');
    $this->owner = new ArrayCollection();
  }


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
   * Set name.
   *
   * @param string $name
   *
   * @return Tender
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get name.
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set city.
   *
   * @param string $city
   *
   * @return Tender
   */
  public function setCity($city)
  {
    $this->city = $city;

    return $this;
  }

  /**
   * Get city.
   *
   * @return string
   */
  public function getCity()
  {
    return $this->city;
  }

  /**
   * Set type.
   *
   * @param string $type
   *
   * @return Tender
   */
  public function setType($type)
  {
    $this->type = $type;

    return $this;
  }

  /**
   * Get type.
   *
   * @return string
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * Set money.
   *
   * @param string $money
   *
   * @return Tender
   */
  public function setMoney($money)
  {
    $this->money = $money;

    return $this;
  }

  /**
   * Get money.
   *
   * @return string
   */
  public function getMoney()
  {
    return $this->money;
  }

  /**
   * Set deadline.
   *
   * @param \DateTime $deadline
   *
   * @return Tender
   */
  public function setDeadline($deadline)
  {
    $this->deadline = $deadline;

    return $this;
  }

  /**
   * Get deadline.
   *
   * @return \DateTime
   */
  public function getDeadline()
  {
    return $this->deadline;
  }

  /**
   * @return mixed
   */
  public function getAddedOn()
  {
    return $this->addedOn;
  }

  /**
   * @param mixed $addedOn
   */
  public function setAddedOn($addedOn)
  {
    $this->addedOn = $addedOn;
  }

  /**
   * Get addedBy.
   *
   * @return string
   */
  public function getAddedBy()
  {
    return $this->addedBy;
  }

  /**
   * @param string $addedBy
   *
   * @return Tender
   */
  public function setAddedBy($addedBy)
  {
    $this->addedBy = $addedBy;
    return $this;
  }

  /**
   * @return User
   */
  public function getOwner()
  {
    return $this->owner;
  }

  public function setOwner($owner)
  {
    $this->owner = $owner;
    return $this;
  }



}
