<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="todo_task")
 */
class Task
{

 /**
 * @ORM\Id
 * @ORM\Column(type="integer")
 * @ORM\GeneratedValue(strategy="AUTO")
 */
 private $id;

 /**
 * @ORM\ManyToMany(targetEntity="Tag")
 */
 private $tags;

 /**
 * @ORM\Column(type="string", length=255)
 * @Assert\NotBlank()
 */
 private $name;

 /**
 * @ORM\Column(type="text", nullable=true)
 */
 private $notes;

 /**
 * @ORM\Column(type="date", nullable=true)
 */
 private $due_date;

 /**
 * @ORM\Column(type="datetime")
 */
 private $created_at;

 /**
 * @ORM\Column(type="boolean")
 */
 private $finished = false;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        // adding default values
	 $this->due_date = new \DateTime('+1 day');
	 $this->created_at = new \DateTime();
	 $this->finished = false;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return Task
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set due_date
     *
     * @param \DateTime $dueDate
     * @return Task
     */
    public function setDueDate($dueDate)
    {
        $this->due_date = $dueDate;

        return $this;
    }

    /**
     * Get due_date
     *
     * @return \DateTime 
     */
    public function getDueDate()
    {
        return $this->due_date;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Task
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Add tags
     *
     * @param \AppBundle\Entity\Tag $tags
     * @return Task
     */
    public function addTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \AppBundle\Entity\Tag $tags
     */
    public function removeTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set finished
     *
     * @param boolean $finished
     * @return Task
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;

        return $this;
    }

    /**
     * Get finished
     *
     * @return boolean 
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Task
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
