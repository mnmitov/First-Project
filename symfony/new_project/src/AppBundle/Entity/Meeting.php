<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Meeting
 *
 * @ORM\Table(name="meetings")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeetingRepository")
 */
class Meeting
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
     *
     * @Assert\NotBlank(message="Meeting place is a mandatory field!")
     *
     * @ORM\Column(name="meetingPlace", type="string", length=255)
     */
    private $meetingPlace;

    /**
     * @var string
     *
     * @ORM\Column(name="initiatedBy", type="string", length=255)
     */
    private $initiatedBy;


    /**
     * @var \DateTime
     *
     * @Assert\NotBlank(message="Meeting date is a mandatory field!")
     *
     * @ORM\Column(name="meetingDate", type="datetime")
     */
    private $meetingDate;

  /**
   * @var string
   *
   * @Assert\NotBlank(message="Meeting subject is a mandatory field!")
   *
   * @ORM\Column(name="meetingSubject", type="string", length=255)
   */
    private $meetingSubject;

  /**
   * @var User
   *
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="meeting")
   */
    private $author;

    public function __construct()
    {
      $this->author = new ArrayCollection();
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
     * Set meetingPlace.
     *
     * @param string $meetingPlace
     *
     * @return Meeting
     */
    public function setMeetingPlace($meetingPlace)
    {
        $this->meetingPlace = $meetingPlace;

        return $this;
    }

    /**
     * Get meetingPlace.
     *
     * @return string
     */
    public function getMeetingPlace()
    {
        return $this->meetingPlace;
    }

    /**
     * Set initiatedBy.
     *
     * @param string $initiatedBy
     *
     * @return Meeting
     */
    public function setInitiatedBy($initiatedBy)
    {
        $this->initiatedBy = $initiatedBy;

        return $this;
    }

    /**
     * Get initiatedBy.
     *
     * @return string
     */
    public function getInitiatedBy()
    {
        return $this->initiatedBy;
    }


    /**
     * Set meetingDate.
     *
     * @param \DateTime $meetingDate
     *
     * @return Meeting
     */
    public function setMeetingDate($meetingDate)
    {
        $this->meetingDate = $meetingDate;

        return $this;
    }

    /**
     * Get meetingDate.
     *
     * @return \DateTime
     */
    public function getMeetingDate()
    {
        return $this->meetingDate;
    }


  /**
   * @return string
   */
  public function getMeetingSubject()
  {
    return $this->meetingSubject;
  }


  /**
   * @param string $meetingSubject
   *
   * @return Meeting
   */
  public function setMeetingSubject(string $meetingSubject)
  {
    $this->meetingSubject = $meetingSubject;

    return $this;
  }

  /**
   * @return User
   */
  public function getAuthor()
  {
    return $this->author;
  }


  public function setAuthor($author)
  {
    $this->author = $author;
    return $this;
  }


}
