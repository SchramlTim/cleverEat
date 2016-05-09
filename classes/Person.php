<?php 

class Person{    
    public $email;
    public $firstName;
    public $lastName;
    public $weight;
    public $height;
    public $sex;
    public $age;
    public $nutritionalForm;
    public $pal;
    public $dailyRequirmentEnergy;
    public $macroDistribution;
    
    function __construct($_email,$_firstName,$_lastName,$_weight,$_height,$_sex,$_age,$_nutritionalForm,$_pal){
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

    function calcMacroDistribution($_dbm){
        $this->macroDistribution = $_dbm->getMacroDistribution($this);
        print_r($this->macroDistribution);
    }
    
}



?>