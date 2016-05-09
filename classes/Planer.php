<?php
include_once('Filter.php');
include_once('DatabaseManager.php');
include_once('Person.php');
include_once('SelectorUnit.php');
include_once('CalculatorUnit.php');

class Planer{
    private $person;
    private $databaseManager;
    private $selector;
    private $calculator;
        
    function __construct($_email,$_firstName,$_lastName,$_weight,$_height,$_sex,$_age,$_nutritionalForm,$_pal){
        $this->databaseManager = new DatabaseManager($this);
        $this->selector = new SelectorUnit($this);
        $this->person = new Person($_email,$_firstName,$_lastName,$_weight,$_height,$_sex,$_age,$_nutritionalForm,$_pal);        
        if($this->databaseManager->registerPerson($this->person)){
             print "User wurde registiert";
        }else{
             print "User ist schon registiert";
        } 
        $this->person->calcMacroDistribution($this->databaseManager);    
    }
    
    function getRecipeList($_mealtime){        
        return $this->databaseManager->getRecipes($_mealtime);
    }
    
    function getPersonalInformation(){
        return $this->person;
    }
    
    function startGeneratingPlan(){
        $data = $this->getRecipeList("breakfast");
        $this->selector->getFittestRecipe($data);
    }
    
    
    
    
    
    
}








?>