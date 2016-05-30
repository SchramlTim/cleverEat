<?php 

class Person{    
    private $_planer;
    public $email;
    public $firstName;
    public $lastName;
    public $weight;
    public $height;
    public $sex;
    public $age;
    public $nutritionalForm;
    public $pal;
    public $dailyRequirementEnergy;
    public $macroDistribution;
    public $listOfNegativFood;
    
    function __construct($_planer,$_email,$_firstName,$_lastName,$_weight,$_height,$_sex,$_age,$_nutritionalForm,$_pal,$_listOfNegativFood){
           $this->planer = $_planer;
           $this->email = $_email;
           $this->firstName = $_firstName;  
           $this->lastName = $_lastName;
           $this->weight = $_weight;
           $this->height = $_height;
           $this->sex = $_sex;
           $this->age = $_age;
           $this->nutritionalForm = $_nutritionalForm; 
           $this->pal = $_pal; 
           $this->dailyRequirementEnergy = $this->calculateDailyRequirementEnergy();   
           $this->listOfNegativFood = $_listOfNegativFood;
           $this->macroDistribution = $this->calcMacroDistribution();
    }
    
    private function calculateDailyRequirementEnergy(){
          $calcDailyRequirmentEnergy = 0;
          if($this->sex === 'male'){
              $calcDailyRequirmentEnergy = (66.47 + (13.7 * $this->weight) + (5 * $this->height) - (6.8 * $this->age)) * $this->pal;
          }else{
              $calcDailyRequirmentEnergy = (655.1 + (9.6 * $this->weight) + (1.8 * $this->height) - (4.7 * $this->age)) * $this->pal;
          }
          return $calcDailyRequirmentEnergy;
      }

    function calcMacroDistribution(){
        return $this->planer->getMacroDistribution($this);
    }
    
}



?>