<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$sex = $_POST['sex'];
$age = $_POST['age'];
$email = $_POST['email'];
$negativfood = $_POST['negativfood'];
$nutritionalform = "dge";//$_POST['nutritionalform'];
$lactoseintolerant = $_POST['lactoseintolerant'];
$goal = $_POST['goal'];
$activity = $_POST['activity'];

include_once('../classes/Planer.php');
$planer = new Planer($email,$firstname,$lastname,$weight,$height,$sex,$age,$nutritionalform,$activity,[]);
$planedRecipes = $planer->startGeneratingPlan();
$jsonString = json_encode($planedRecipes);

echo $jsonString;
?>