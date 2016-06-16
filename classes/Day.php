<?php
class Day
{
    private $numberOfMainMeals;
    private $numberOfSnacks;
    private $mealManager;
    private $currentMealNumber;
    private $energy;
    private $macroDistribution;
    const snackRatio = 0.2;

    function __construct($_numberOfMainMeals,$_numberOfSnacks,$_energy,$_macroDistribution){
        $this->numberOfMainMeals = $_numberOfMainMeals;
        $this->numberOfSnacks = $_numberOfSnacks;
        $this->mealManager = array();
        $this->currentMealNumber = 0;
        $this->energy = $_energy;
        $this->macroDistribution = $_macroDistribution;

        $globalSnackEnergy = ($_energy / $_numberOfMainMeals) * Day::snackRatio * $_numberOfSnacks;
        $globalMacroSnackCarb = ($_macroDistribution[Macro::Carbohydrate] / $_numberOfMainMeals) * Day::snackRatio * $_numberOfSnacks;
        $globalMacroSnackFat = ($_macroDistribution[Macro::Fat] / $_numberOfMainMeals) * Day::snackRatio * $_numberOfSnacks;
        $globalMacroSnackProtein = ($_macroDistribution[Macro::Protein] / $_numberOfMainMeals) * Day::snackRatio * $_numberOfSnacks;

        $globalMainMealEnergy = ($_energy - $globalSnackEnergy) / $_numberOfMainMeals;
        $globalMacroMainMealCarb = ($_macroDistribution[Macro::Carbohydrate] - $globalMacroSnackCarb) / $_numberOfMainMeals;
        $globalMacroMainMealFat = ($_macroDistribution[Macro::Fat] - $globalMacroSnackFat) / $_numberOfMainMeals;
        $globalMacroMainMealProtein = ($_macroDistribution[Macro::Protein] - $globalMacroSnackProtein) / $_numberOfMainMeals;

        $macrosMeal = array();
        $macrosMeal[Macro::Carbohydrate] = $globalMacroMainMealCarb;
        $macrosMeal[Macro::Fat] = $globalMacroMainMealFat;
        $macrosMeal[Macro::Protein] = $globalMacroMainMealProtein;

        $macrosSnack = array();
        $macrosSnack[Macro::Carbohydrate] = $globalMacroSnackCarb;
        $macrosSnack[Macro::Fat] = $globalMacroSnackFat;
        $macrosSnack[Macro::Protein] = $globalMacroSnackProtein;


        for($i = 0; $i < $this->numberOfMainMeals; $i++){
            if($i == 0){
                $mealtime = Mealtime::Breakfast;
            }else if($i == $this->numberOfMainMeals-1){
                $mealtime = Mealtime::Dinner;
            }else{
                $mealtime = Mealtime::Lunch;
            }
            $this->mealManager[] = new Meal($mealtime,$globalMainMealEnergy,$macrosMeal);
        }
        for($i = 0; $i < $this->numberOfSnacks; $i++){
            $this->mealManager[] = new Meal(Mealtime::Snack,$globalSnackEnergy/$this->numberOfSnacks,$macrosSnack);
        }
    }

    public function getCurrentMealtime(){
        return $this->mealManager[$this->currentMealNumber]->getMealtime();
    }

    public function getCurrentNecessaryEnergy(){
        return $this->mealManager[$this->currentMealNumber]->getNecessaryEnergy();
    }

    public function selectNextMeal(){
        $hasNext = true;
        $this->hasNextMeal() ? $this->currentMealNumber++ : $hasNext = false;
        return $hasNext;
    }

    public function addRecipe($_recipe){
        $this->mealManager[$this->currentMealNumber]->setRecipe($_recipe);
    }

    private function hasNextMeal(){
        $hasNext = false;
        if($this->currentMealNumber < count($this->mealManager)-1){
            $hasNext = true;
        }
        return $hasNext;
    }

    public function getMacroDistribution(){
        return $this->mealManager[$this->currentMealNumber]->getMacroDistribution();
    }

    function getUsedRecipeNames(){
        $usedRecipe = array();
        for($i = 0; $i < count($this->mealManager); $i++){
            $recipe = $this->mealManager[$i]->getRecipe();
            if($recipe != null){
                $usedRecipe[] = $recipe->name;
            }
        }
        return $usedRecipe;
    }

    function getWholeEnergy(){
        $energy = 0;
        for($i = 0; $i < count($this->mealManager[$i]); $i++){
            $energy += $this->mealManager[$i]->getRecipe()->calories;
        }
        return $energy;
    }

    function getPlanedRecipes(){
        $planedRecipes = array();
        for($i = 0; $i < count($this->mealManager); $i++){
            $planedRecipes[] = $this->mealManager[$i]->getPlanedRecipe();
        }
        return $planedRecipes;
    }

    function updateNutritionValues(){
        $leavingEnergy = $this->energy;
        $leavingCarbs = $this->macroDistribution[Macro::Carbohydrate];
        $leavingFat = $this->macroDistribution[Macro::Fat];
        $leavingProtein = $this->macroDistribution[Macro::Protein];
        $doneSnacks = 0;
        $doneMainMeals = 0;
        $globalSnackEnergy = 0;
        $globalMainMealEnergy = 0;

        for($i = 0; $i <= $this->currentMealNumber; $i++){
            $meal = $this->mealManager[$i];
            $leavingEnergy -= $meal->getRecipe()->calories;
            $leavingCarbs -= $meal->getRecipe()->carbs;
            $leavingFat -= $meal->getRecipe()->fat;
            $leavingProtein -= $meal->getRecipe()->protein;
            if($meal->getMealtime() != Mealtime::Snack){
                $doneMainMeals++;
            }else{
                $doneSnacks++;
            }
        }

        if(($this->numberOfMainMeals - $doneMainMeals) > 0){
            $globalSnackEnergy = ($leavingEnergy / ($this->numberOfMainMeals - $doneMainMeals)) * Day::snackRatio * ($this->numberOfSnacks - $doneSnacks);
            $globalMacroSnackCarb = ($leavingCarbs / ($this->numberOfMainMeals - $doneMainMeals)) * Day::snackRatio * ($this->numberOfSnacks - $doneSnacks);
            $globalMacroSnackFat = ($leavingFat / ($this->numberOfMainMeals - $doneMainMeals)) * Day::snackRatio * ($this->numberOfSnacks - $doneSnacks);
            $globalMacroSnackProtein = ($leavingProtein / ($this->numberOfMainMeals - $doneMainMeals)) * Day::snackRatio * ($this->numberOfSnacks - $doneSnacks);

            $globalMainMealEnergy = ($leavingEnergy - $globalSnackEnergy) / ($this->numberOfMainMeals - $doneMainMeals);
            $globalMacroMainMealCarb = ($leavingCarbs - $globalMacroSnackCarb) / ($this->numberOfMainMeals - $doneMainMeals);
            $globalMacroMainMealFat = ($leavingFat - $globalMacroSnackFat) / ($this->numberOfMainMeals - $doneMainMeals);
            $globalMacroMainMealProtein = ($leavingProtein - $globalMacroSnackProtein) / ($this->numberOfMainMeals - $doneMainMeals);

            $macrosMeal = array();
            $macrosMeal[Macro::Carbohydrate] = $globalMacroMainMealCarb;
            $macrosMeal[Macro::Fat] = $globalMacroMainMealFat;
            $macrosMeal[Macro::Protein] = $globalMacroMainMealProtein;

            $macrosSnack = array();
            $macrosSnack[Macro::Carbohydrate] = $globalMacroSnackCarb;
            $macrosSnack[Macro::Fat] = $globalMacroSnackFat;
            $macrosSnack[Macro::Protein] = $globalMacroSnackProtein;

            for ($i = $this->currentMealNumber + 1; $i < count($this->mealManager); $i++){
                if($this->mealManager[$i]->getMealtime() != Mealtime::Snack){
                    $this->mealManager[$i]->updateEnergy($globalMainMealEnergy);
                    $this->mealManager[$i]->updateMacros($macrosMeal);
                }else{
                    $this->mealManager[$i]->updateEnergy($globalSnackEnergy);
                    $this->mealManager[$i]->updateMacros($macrosSnack);
                }
            }
        }else if(($this->numberOfSnacks - $doneSnacks) > 0){
            $globalSnackEnergy = ($leavingEnergy) * Day::snackRatio * ($this->numberOfSnacks - $doneSnacks);
            $globalMacroSnackCarb = ($leavingCarbs) * Day::snackRatio * ($this->numberOfSnacks - $doneSnacks);
            $globalMacroSnackFat = ($leavingFat) * Day::snackRatio * ($this->numberOfSnacks - $doneSnacks);
            $globalMacroSnackProtein = ($leavingProtein) * Day::snackRatio * ($this->numberOfSnacks - $doneSnacks);

            $macrosSnack = array();
            $macrosSnack[Macro::Carbohydrate] = $globalMacroSnackCarb;
            $macrosSnack[Macro::Fat] = $globalMacroSnackFat;
            $macrosSnack[Macro::Protein] = $globalMacroSnackProtein;

            for ($i = $this->currentMealNumber + 1; $i < count($this->mealManager); $i++){
                if($this->mealManager[$i]->getMealtime() == Mealtime::Snack){
                    $this->mealManager[$i]->updateEnergy($globalSnackEnergy);
                    $this->mealManager[$i]->updateMacros($macrosSnack);
                }
            }
        }



    }

}