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

    public function updateEnergy($_energy){
        $this->necessaryEnergy = $_energy;
    }

    public function updateMacros($_macros){
        $this->macros = $_macros;
    }

    /**
     * @return mixed
     */
    public function getMacroDistribution()
    {
        return $this->macros;
    }

    function getPlanedRecipe(){
        $recipeInformations = array();
        if($this->recipe != null){
            $recipeInformations['name'] = $this->recipe->name;
            $recipeInformations['mealtime'] = $this->mealtime;
            $recipeInformations['calories'] = $this->recipe->calories;
            $recipeInformations['carbs'] = $this->recipe->carbs;
            $recipeInformations['fat'] = $this->recipe->fat;
            $recipeInformations['protein'] = $this->recipe->protein;
        }
        return $recipeInformations;
    }

    
}