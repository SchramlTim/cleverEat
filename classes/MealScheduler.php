<?php

class MealScheduler
{
    private $numberOfMainMeals;
    private $numberOfSnacks;
    private $dayManager;
    private $currentDayNumber;

    function __construct($_numberOfMainMeals,$_numberOfSnacks,$_energy,$_macroDistribution)
    {
        $this->numberOfMainMeals = $_numberOfMainMeals;
        $this->numberOfSnacks = $_numberOfSnacks;
        $this->dayManager = array();
        $this->currentDayNumber = 0;

        for($i = 0; $i < 7; $i++){
            $this->dayManager[] = new Day($_numberOfMainMeals,$_numberOfSnacks,$_energy,$_macroDistribution);
        }
    }

    function getCurrentMealtime(){
        return $this->dayManager[$this->currentDayNumber]->getCurrentMealtime();
    }

    function getCurrentNecessaryEnergy(){
        return $this->dayManager[$this->currentDayNumber]->getCurrentNecessaryEnergy();
    }

    public function getMacroDistribution(){
        return $this->dayManager[$this->currentDayNumber]->getMacroDistribution();
    }


    function selectNextMeal(){
        $hasNext = true;
        //$this->dayManager[$this->currentDayNumber]->updateNutritionValues();
        if(!$this->dayManager[$this->currentDayNumber]->selectNextMeal()){
            if($this->hasNextDay()){
                $this->currentDayNumber++;
            }else{
                $hasNext = false;
            }
        }
        return $hasNext;
    }

    function addRecipeToDay($_repice)
    {
        $this->dayManager[$this->currentDayNumber]->addRecipe($_repice);
    }

    private function hasNextDay(){
        $hasNext = false;
        if($this->currentDayNumber < count($this->dayManager)-1){
            $hasNext = true;
        }
        return $hasNext;
    }

    function getUsedRecipeNames(){
        $usedRecipe = array();
        for($i = 0; $i < count($this->dayManager); $i++){
            $dayUsedRecipe = $this->dayManager[$i]->getUsedRecipeNames();
            for($j = 0; $j < count($dayUsedRecipe); $j++){
                $usedRecipe[] = $dayUsedRecipe[$j];
            }
        }
        return $usedRecipe;
    }

    function getAverageEnergy(){
        $energy = 0;
        $countedDays = 0;
        for($i = 0; $i < count($this->dayManager[$i]); $i++){
            $wholeEnergy = $this->dayManager[$i]->getWholeEnergy();
            if($wholeEnergy > 0){
                $countedDays++;
                $energy += $wholeEnergy;
                $wholeEnergy = 0;
            }
        }
        return $energy / count($this->dayManager);
    }
}