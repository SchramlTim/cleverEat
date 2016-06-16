<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once('classes/Planer.php');
$planer = new Planer("bla@bla.de","Tim","Schraml",90,180,"male",21,"dge",1.4,["Zwiebel","Alkohol"]);
$planedRecipes = $planer->startGeneratingPlan();
$jsonString = json_encode($planedRecipes);

?>