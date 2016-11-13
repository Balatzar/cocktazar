<?php

namespace CocktazarBundle\Entity;

/**
 * Ingredient
 */
class Ingredient
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $measure;


    /**
     * Get id
     *
     * @return int
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
     * @return Ingredient
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
     * Set measure
     *
     * @param string $measure
     *
     * @return Ingredient
     */
    public function setMeasure($measure)
    {
        $this->measure = $measure;

        return $this;
    }

    /**
     * Get measure
     *
     * @return string
     */
    public function getMeasure()
    {
        return $this->measure;
    }
    /**
     * @var \CocktazarBundle\Entity\Recipe
     */
    private $recipe;


    /**
     * Set recipe
     *
     * @param \CocktazarBundle\Entity\Recipe $recipe
     *
     * @return Ingredient
     */
    public function setRecipe(\CocktazarBundle\Entity\Recipe $recipe = null)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Get recipe
     *
     * @return \CocktazarBundle\Entity\Recipe
     */
    public function getRecipe()
    {
        return $this->recipe;
    }
}
