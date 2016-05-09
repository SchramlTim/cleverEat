<?php

class SelectorUnit{
    private $planer;
    private $calculator;
    private $range = 0.3;
        
    function __construct($_planerInstance){
       $this->planer = $_planerInstance;   
    }
    
    function getFittestRecipe($_recipeList,$_energy,$_macroDistribution){
        $currentFittestRecipe;
        
        
        for($j = 0; $j < count($_recipeList); $j++){
            $_recipeList[$j]->calculateRecipeFor(1);  
        }
        
        for($i = 0; $i < count($_recipeList); $i++){
            if(isInRange($_energy,$_recipeList[$i]->calories) && isInRange($_macroDistribution['carb'],$_recipeList[$i]->carbs) && isInRange($_macroDistribution['fat'],$_recipeList[$i]->fat) && isInRange($_macroDistribution['protein'],$_recipeList[$i]->protein)){
                $currentFittestRecipe = $_recipeList[$i];
            }
        }
        return $currentFittestRecipe;
    }
    
    function isInRange($_needValue,$_isValue){
        
    }
}

?>