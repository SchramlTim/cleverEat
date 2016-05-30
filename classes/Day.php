<?php
class Day
{
    private $numberOfMainMeals;
    private $numberOfSnacks;
    private $mealManager;
    private $currentMealNumber;
    private $energy;
    const snackRatio = 0.2;

    function __construct($_numberOfMainMeals,$_numberOfSnacks,$_energy,$_macroDistribution){
        $this->numberOfMainMeals = $_numberOfMainMeals;
        $this->numberOfSnacks = $_numberOfSnacks;
        $this->mealManager = array();
        $this->currentMealNumber = 0;
        $this->energy = $_energy;
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

        print "<br/>";
        print "MainMealEnergy:".$globalMainMealEnergy;
        print "<br/>";
        print "SnackEnergy:".$globalSnackEnergy;



        for($i = 0; $i < $this->numberOfMainMeals; $i++){
            if($i == 0){
                $mealtime = Mealtime::Breakfast;
            }else if($i == $this->numberOfMainMeals-1){
                $mealtime = Mealtime::Dinner;
            }else{
                $mealtime = Mealtime::Lunch;
            }
            print $mealtime;
            $this->mealManager[] = new Meal($mealtime,$globalMainMealEnergy,$macrosMeal);
        }
        for($i = 0; $i < $this->numberOfSnacks; $i++){
            $this->mealManager[] = new Meal(Mealtime::Snack,$globalSnackEnergy,$macrosSnack);
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

}