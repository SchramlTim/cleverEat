<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$sex = $_POST['sex'];
$age = $_POST['age'];
$email = $_POST['email'];
$negativfood = $_POST['negativfood'];
$nutritionalform = $_POST['nutritionalform'];
$lactoseintolerant = $_POST['lactoseintolerant'];
$goal = $_POST['goal'];
$activity = $_POST['activity'];

echo '&Uuml;berpr&uuml;fe deine Werte: <br/> Name: '.$firstname.' '.$lastname;
echo '<br/>Gewicht: '.$weight;
echo '<br/>Gr&ouml;&szlig;e: '.$height;
echo '<br/>Geschlecht: '.$sex;
echo '<br/>Alter: '.$age;
echo '<br/>EMail: '.$email;
echo '<br/>Lebensmittel, die du nicht magst: '.$negativfood;
echo '<br/>Ern&auml;hrungsform: '.$nutritionalform;
echo '<br/>Laktose-intolerant: '.$lactoseintolerant;
echo '<br/>Ziel: '.$goal;
echo '<br/>Aktivit&auml;t: '.$activity;

include_once('classes/Planer.php');
$planer = new Planer($email,$firstname,$lastname,$weight,height,$sex,$age,$nutritionalform,$activity);
$planer->startGeneratingPlan();
?>