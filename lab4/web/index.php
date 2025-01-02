<?php

echo "hello !!!";

$name = " Dee";
$age = 25;

$arr = array("name",25);
$asssocr_arr = ["name"=>"Drusawin","age"=>25];

echo $arr[0];
echo $asssocr_arr["age"];
echo $arr;
echo "<br>";
var_dump($asssocr_arr);

echo "Hello $name";
echo 'Hello $name';

$oject = (object)$asssocr_arr;
echo $oject->name;

function plus($a ,$b)
{
    return $a + $b;
}

$add_name = function($name){
    echo "Hello $name";
};

$car = (object)["color"=>"red","name"=>$add_name];
//echo $car->name("test");
?>

<?php
phpinfo()
?>