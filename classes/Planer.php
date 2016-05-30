<?php
//include_once('DatabaseManager.php');
//include_once('Person.php');
//include_once('SelectorUnit.php');
//include_once('CalculatorUnit.php');

class Planer{
    private $person;
    private $databaseManager;
    private $selector;
    private $mealScheduler;
        
    function __construct($_email,$_firstName,$_lastName,$_weight,$_height,$_sex,$_age,$_nutritionalForm,$_pal,$_listOfNegativFood){
        $this->databaseManager = new DatabaseManager($this);
        $this->selector = new SelectorUnit($this);
        $this->person = new Person($this,$_email,$_firstName,$_lastName,$_weight,$_height,$_sex,$_age,$_nutritionalForm,$_pal,$_listOfNegativFood);
        $this->mealScheduler = new MealScheduler(3, 1, $this->person->dailyRequirementEnergy,$this->person->macroDistribution);
//        $this->databaseManager->registerPerson($this->person)
    }
    
    function getPersonalInformation(){
        return $this->person;
    }
    
    function getMacroDistribution($_person){
        return $this->databaseManager->getMacroDistribution($_person);
    }
    
    function startGeneratingPlan(){
        do {
            print "<br/>";
            print $this->mealScheduler->getCurrentMealtime();
            $mealtimeRecipeList = $this->databaseManager->getRecipes($this->mealScheduler->getCurrentMealtime(),$this->mealScheduler->getUsedRecipeNames());
            $fitRecipe = $this->selector->getFittestRecipe($mealtimeRecipeList,$this->mealScheduler->getCurrentNecessaryEnergy(),$this->mealScheduler->getMacroDistribution());
            $this->mealScheduler->addRecipeToDay($fitRecipe);
        }while($this->mealScheduler->selectNextMeal());
        print "<br/>";
        print_r($this->mealScheduler);
    }
    
    
}

spl_autoload_register(function( $className ){

    $filepath = $_SERVER['DOCUMENT_ROOT'] . '/cleverEat/classes/' . $className. '.php';

    if ( !file_exists( $filepath ) )
    {
        $message  = "Cannot load class: $className. ";
        $message .= "File '$filepath' not found!";
        throw new Exception( $message );
    }

    require $filepath;

});








?>