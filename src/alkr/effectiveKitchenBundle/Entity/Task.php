<?php

namespace alkr\effectiveKitchenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Task extends BasicEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="time", type="integer")
     */
    protected $time;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    protected $active;

    /**
     * @ORM\ManyToOne(targetEntity="Flow", inversedBy="tasks")
     * @ORM\JoinColumn(name="flow_id", referencedColumnName="id")
     **/
    protected $flow;


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
     *
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
     * Set description
     *
     * @param string $description
     *
     * @return Task
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set time
     *
     * @param integer $time
     *
     * @return Task
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return integer
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Task
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set flow
     *
     * @param \alkr\effectiveKitchenBundle\Entity\Flow $flow
     *
     * @return Task
     */
    public function setFlow(\alkr\effectiveKitchenBundle\Entity\Flow $flow = null)
    {
        $this->flow = $flow;

        return $this;
    }

    /**
     * Get flow
     *
     * @return \alkr\effectiveKitchenBundle\Entity\Flow
     */
    public function getFlow()
    {
        return $this->flow;
    }
}
