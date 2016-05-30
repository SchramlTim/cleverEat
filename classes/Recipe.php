<?php 

class Recipe{
    public $name;
    public $servings;
    public $calories;
    public $carbs;
    public $fat;
    public $protein;
    
    function __construct($_name,$_servings,$_calories,$_carbs,$_fat,$_protein){
        $this->name = $_name;
        $this->servings = $_servings;
        $this->calories = $_calories;
        $this->carbs = $_carbs;
        $this->fat = $_fat;
        $this->protein = $_protein;
    }
    
    function calculateRecipeFor($_servings){
        $factor = ($_servings /$this->servings);
        $this->servings = $_servings;
        $this->calories *= $factor;
        $this->carbs *= $factor;
        $this->fat *= $factor;
        $this->protein *= $factor;
    }

    function calculateRecipeForEnergy($_energy){
        $factor = round($_energy / $this->calories,1);
        $this->calories *= $factor;
        $this->carbs *= $factor;
        $this->fat *= $factor;
        $this->protein *= $factor;
        $servings = round($this->servings * $factor,1);
        $this->servings = $servings;
        return $servings;

    }
    
    function getMacro(){
        $macro = array();
        $macro['carb'] = $this->carbs;
        $macro['fat'] = $this->fat;
        $macro['protein'] = $this->protein;
        return $macro;
    }

}





?>