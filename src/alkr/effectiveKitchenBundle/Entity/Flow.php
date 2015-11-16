<?php

namespace alkr\effectiveKitchenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flow
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Flow extends BasicEntity
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
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="flows")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     **/
    protected $recipe;

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="flow", cascade="all")
     **/
    protected $tasks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set recipe
     *
     * @param \alkr\effectiveKitchenBundle\Entity\Recipe $recipe
     *
     * @return Flow
     */
    public function setRecipe(\alkr\effectiveKitchenBundle\Entity\Recipe $recipe = null)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get recipe
     *
     * @return \alkr\effectiveKitchenBundle\Entity\Recipe
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * Add task
     *
     * @param \alkr\effectiveKitchenBundle\Entity\Task $task
     *
     * @return Flow
     */
    public function addTask(\alkr\effectiveKitchenBundle\Entity\Task $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \alkr\effectiveKitchenBundle\Entity\Task $task
     */
    public function removeTask(\alkr\effectiveKitchenBundle\Entity\Task $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}
