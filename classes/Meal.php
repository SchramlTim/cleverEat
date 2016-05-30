<?php

class Meal
{
    private $recipe;
    private $mealtime;
    private $necessaryEnergy;
    private $macros;

    function __construct($_mealtime,$_necessaryEnergy,$_macros)
    {
        $this->mealtime = $_mealtime;
        $this->necessaryEnergy = $_necessaryEnergy;
        $this->macros = $_macros;
        $this->recipe = null;
    }

    /**
     * @param $_recipe
     */
    function setRecipe($_recipe){
        $this->recipe = $_recipe;
    }


    /**
     * @return mixed
     */
    public function getMealtime()
    {
        return $this->mealtime;
    }

    /**
     * @return mixed
     */
    function getNecessaryEnergy()
    {
        return $this->necessaryEnergy;
    }

    /**
     * @return mixed
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * @return mixed
     */
    public function getMacroDistribution()
    {
        return $this->macros;
    }

    
}