<?php

namespace alkr\effectiveKitchenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Recipe
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Recipe extends BasicEntity
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
     * @ORM\OneToMany(targetEntity="Flow", mappedBy="recipe", cascade="all")
     **/
    protected $flows;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->flows = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
     * @return Recipe
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
     * @return Recipe
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
     * Add flow
     *
     * @param \alkr\effectiveKitchenBundle\Entity\Flow $flow
     *
     * @return Recipe
     */
    public function addFlow(\alkr\effectiveKitchenBundle\Entity\Flow $flow)
    {
        $this->flows[] = $flow;
        $flow->setRecipe($this);

        return $this;
    }

    /**
     * Remove flow
     *
     * @param \alkr\effectiveKitchenBundle\Entity\Flow $flow
     */
    public function removeFlow(\alkr\effectiveKitchenBundle\Entity\Flow $flow)
    {
        $this->flows->removeElement($flow);
        $flow->setRecipe(null);
    }

    /**
     * Get flows
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFlows()
    {
        return $this->flows;
    }
}
