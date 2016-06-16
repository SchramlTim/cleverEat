<?php

class SelectorUnit{
    private $planer;
    private $calculator;
    private $range = 0.3;
        
    function __construct($_planerInstance){
       $this->planer = $_planerInstance;   
    }
    
    function getFittestRecipe($_recipeList,$_energy,$_macroDistribution){
        $currentFittestRecipe = null;  
        $recipeFound = false;
        
        for($j = 0; $j < count($_recipeList); $j++){
            $_recipeList[$j]->calculateRecipeFor(1);  
        }

        if(!$recipeFound){
            for($i = 0; $i < count($_recipeList); $i++){
                $testRecipe = clone $_recipeList[$i];
                if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['carb'],$testRecipe->carbs) && $this->isInRange($_macroDistribution['fat'],$testRecipe->fat) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)){
                    
                    $currentFittestRecipe = $testRecipe;
                    $recipeFound = true;
                    break;
                }else{
                    $output = $testRecipe->calculateRecipeForEnergy($_energy);
                    if($output <= 2 & $output >= 0.5){
                        if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['carb'],$testRecipe->carbs) && $this->isInRange($_macroDistribution['fat'],$testRecipe->fat) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)) {
                           
                            
                            $currentFittestRecipe = $testRecipe;
                            $recipeFound = true;
                            break;
                        }
                    }else{
                        $output = 0;
                    }
                }
            }
        }
        
        if(!$recipeFound){
            for($i = 0; $i < count($_recipeList); $i++){
                $testRecipe = clone $_recipeList[$i];
                if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['fat'],$testRecipe->fat) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)){
                    
                    $currentFittestRecipe = $testRecipe;
                    $recipeFound = true;
                    break;
                }else{
                    $output = $testRecipe->calculateRecipeForEnergy($_energy);
                    if($output <= 2 & $output >= 0.5){
                        if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['fat'],$testRecipe->fat) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)) {
                            
                            
                            $currentFittestRecipe = $testRecipe;
                            $recipeFound = true;
                            break;
                        }
                    }else{
                        $output = 0;
                    }
                }
            }
        }
        
        if(!$recipeFound){
            for($i = 0; $i < count($_recipeList); $i++){
                $testRecipe = clone $_recipeList[$i];
                if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)){
                    
                    $currentFittestRecipe = $testRecipe;
                    $recipeFound = true;
                    break;
                }else{
                    $output = $testRecipe->calculateRecipeForEnergy($_energy);
                    if($output <= 2 & $output >= 0.5){
                        if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)) {
                            
                            
                            $currentFittestRecipe = $testRecipe;
                            $recipeFound = true;
                            break;
                        }
                    }else{
                        $output = 0;
                    }
                }
            }
        }
        
        if(!$recipeFound){
            for($i = 0; $i < count($_recipeList); $i++){
                $testRecipe = clone $_recipeList[$i];
                if($this->isInRange($_energy,$testRecipe->calories)){
                    
                    $currentFittestRecipe = $testRecipe;
                    $recipeFound = true;
                    break;
                }else{
                    $output = $testRecipe->calculateRecipeForEnergy($_energy);
                    if($output <= 2 & $output >= 0.5){
                        if($this->isInRange($_energy,$testRecipe->calories)) {
                            
                            $currentFittestRecipe = $testRecipe;
                            $recipeFound = true;
                            break;
                        }
                    }else{
                        $output = 0;
                    }
                }
            }
        }
        
        return $currentFittestRecipe;
    }
    
    function isInRange($_needValue,$_isValue){
        $inRange = false;
        $needValueTopRanged = $_needValue * (1 + $this->range);
        $needValueBottomRanged = $_needValue * (1 - $this->range);
        
        if($_isValue > $needValueBottomRanged && $_isValue < $needValueTopRanged){
            $inRange = true;
        }
        return $inRange;
    }
}

?>