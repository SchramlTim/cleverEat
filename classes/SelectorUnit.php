<?php

class SelectorUnit{
    private $planer;
    private $calculator;
    private $range = 0.1;
        
    function __construct($_planerInstance){
       $this->planer = $_planerInstance;   
    }
    
    function getFittestRecipe($_recipeList,$_energy,$_macroDistribution){
        $currentFittestRecipe = null;  
        $recipeFound = false;

        print "<br/>";
        print $_energy;
        print "<br/>";
        print "Carbs:".$_macroDistribution[Macro::Carbohydrate];
        print "<br/>";
        print "Fat:".$_macroDistribution[Macro::Fat];
        print "<br/>";
        print "Protein:".$_macroDistribution[Macro::Protein];
        print "<br/>";
        print "Rezepte:";
        print_r($_recipeList);
        
        for($j = 0; $j < count($_recipeList); $j++){
            $_recipeList[$j]->calculateRecipeFor(1);  
        }

        if(!$recipeFound){
            for($i = 0; $i < count($_recipeList); $i++){
                $testRecipe = $_recipeList[$i];
                if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['carb'],$testRecipe->carbs) && $this->isInRange($_macroDistribution['fat'],$testRecipe->fat) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)){
                    print "<br/>";
                    print "Alles Passt";
                    $currentFittestRecipe = $testRecipe;
                    $recipeFound = true;
                    break;
                }else{
                    $output = $testRecipe->calculateRecipeForEnergy($_energy);
                    if($output <= 2 & $output >= 0.5){
                        if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['carb'],$testRecipe->carbs) && $this->isInRange($_macroDistribution['fat'],$testRecipe->fat) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)) {
                            print "<br/>";
                            print "Alles Passt mit Runterrechnen";
                            $currentFittestRecipe = $testRecipe;
                            $recipeFound = true;
                            break;
                        }
                    }
                }
            }
        }
        
        if(!$recipeFound){
            for($i = 0; $i < count($_recipeList); $i++){
                $testRecipe = $_recipeList[$i];
                if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['fat'],$testRecipe->fat) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)){
                    print "<br/>";
                    print "Kalorien, Fat und Eiweiß passt";
                    $currentFittestRecipe = $testRecipe;
                    $recipeFound = true;
                    break;
                }else{
                    $output = $testRecipe->calculateRecipeForEnergy($_energy);
                    if($output <= 2 & $output >= 0.5){
                        if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['carb'],$testRecipe->carbs) && $this->isInRange($_macroDistribution['fat'],$testRecipe->fat) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)) {
                            print "<br/>";
                            print "Alles Passt mit Runterrechnen";
                            $currentFittestRecipe = $testRecipe;
                            $recipeFound = true;
                            break;
                        }
                    }
                }
            }
        }
        
        if(!$recipeFound){
            for($i = 0; $i < count($_recipeList); $i++){
                $testRecipe = $_recipeList[$i];
                if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)){
                    print "<br/>";
                    print "Kalorien und Eiweiß passt";
                    $currentFittestRecipe = $testRecipe;
                    $recipeFound = true;
                    break;
                }else{
                    $output = $testRecipe->calculateRecipeForEnergy($_energy);
                    if($output <= 2 & $output >= 0.5){
                        if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['carb'],$testRecipe->carbs) && $this->isInRange($_macroDistribution['fat'],$testRecipe->fat) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)) {
                            print "<br/>";
                            print "Alles Passt mit Runterrechnen";
                            $currentFittestRecipe = $testRecipe;
                            $recipeFound = true;
                            break;
                        }
                    }
                }
            }
        }
        
        if(!$recipeFound){
            for($i = 0; $i < count($_recipeList); $i++){
                $testRecipe = $_recipeList[$i];
                if($this->isInRange($_energy,$testRecipe->calories)){
                    print "<br/>";
                    print "Nur Kalorien passt";
                    $currentFittestRecipe = $testRecipe;
                    $recipeFound = true;
                    break;
                }else{
                    $output = $testRecipe->calculateRecipeForEnergy($_energy);
                    if($output <= 2 & $output >= 0.5){
                        if($this->isInRange($_energy,$testRecipe->calories) && $this->isInRange($_macroDistribution['carb'],$testRecipe->carbs) && $this->isInRange($_macroDistribution['fat'],$testRecipe->fat) && $this->isInRange($_macroDistribution['protein'],$testRecipe->protein)) {
                            print "<br/>";
                            print "Alles Passt mit Runterrechnen";
                            $currentFittestRecipe = $testRecipe;
                            $recipeFound = true;
                            break;
                        }
                    }
                }
            }
        }
        print "<br/>";
        print_r($currentFittestRecipe);
        print "<br/>";
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