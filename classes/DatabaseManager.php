<?php
include_once('Database.php');
include_once('Recipe.php');

class DatabaseManager{
    private $planer;
    private $database;
    
    
    function __construct($_planer){
        static $username = "root";
        static $password = "";
        static $hostname = "localhost";
        static $datatable = "clevereat";
        
        $this->planer = $_planer;
        $this->database = new Database($hostname,$username,$password,$datatable);
        $this->database->connectToDatabase();
    }
    
    function registerPerson($_person){
        if (is_a($_person, 'Person')) {
            $queryString = "INSERT INTO `person`(`email`, `firstName`, `lastName`, `weight`, `height`, `sex`, `age`, `nutritionalForm`) VALUES ('".$_person->email."','".$_person->firstName."','".$_person->lastName."',".$_person->weight.",".$_person->height.",'".$_person->sex."',".$_person->age.",'".$_person->nutritionalForm."')";
            return $this->database->query($queryString);
        }
    }    
      
    function getRecipes($_mealtime){ 
        $data = array();      
        $query = $this->database->query($this->getRecipesQuery($_mealtime));
        while($row = mysqli_fetch_assoc($query)){            
            $data[] = new Recipe($row['RecipeName'],$row['Servings'],$row['Calories'],$row['Carbohydrate'],$row['Fat'],$row['Protein']);
        }
        return $data;
    }
    
    function getRecipesQuery($_mealtime){
        return "SELECT r.name as 'RecipeName', r.servings as 'Servings', ROUND(SUM((f.kcal*i.weight)/100),1) as 'Calories', ROUND(SUM((f.carbohydrate*i.weight)/100),1) as 'Carbohydrate', ROUND(SUM((f.fat*i.weight)/100),1) as 'Fat', ROUND(SUM((f.protein*i.weight)/100),1) as 'Protein' 
        FROM recipe r, food f, ingredients i, person p 
        WHERE r.id = i.recipeid 
        and f.foodid = i.foodid 
        and p.email = '".$this->planer->getPersonalInformation()->email."'
        and r.mealtime = '".$_mealtime."'
        and (r.id,p.email) NOT IN(
            SELECT iIn.recipeid, pIn.email
            FROM food fIn, ingredients iIn, person pIn
            WHERE fIn.foodid = iIn.foodid
            AND pIn.email = p.email
            AND iIn.foodid IN (
                SELECT nfl.food
                FROM negativfoodlist nfl
		        WHERE pIn.email = nfl.personid
            )
            GROUP BY(iIn.recipeid)
        )
        GROUP BY r.name ORDER BY `Calories`  DESC";
    }
    
    function getMacroDistribution($_person){         
        $macroDistribution = array();          
        $queryNutrition = $this->database->query($this->getNutritionDistributionQuery($_person));
        $queryMacroValue = $this->database->query($this->getMacroValueQuery());
                
        while($row = mysqli_fetch_assoc($queryNutrition)){            
           $macroDistribution['carb'] = $_person->dailyRequirementEnergy * ($row['carbohydrates']/100);
           $macroDistribution['fat'] = $_person->dailyRequirementEnergy * ($row['fat']/100);
           $macroDistribution['protein'] = $_person->dailyRequirementEnergy * ($row['protein']/100);
        }
        
        while($row = mysqli_fetch_assoc($queryMacroValue)){  
            $macroDistribution[$row['per']] = $macroDistribution[$row['per']]/$row['kcal'];
        }
        return $macroDistribution;        
    }
    
    function getNutritionDistributionQuery($_person){
        return "SELECT nf.carbohydrates, nf.fat, nf.protein FROM person p, nutritionalform nf WHERE p.nutritionalForm = nf.name AND p.email = '".$_person->email."' ";
    }
    
    function getMacroValueQuery(){
        return "SELECT * FROM macrovalues WHERE per != 'alc'";
    }
    
    
}

?>