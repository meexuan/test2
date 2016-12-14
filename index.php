<html>
<title>
Billing System
</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">

<?php

require_once("template.php");
require_once("function.php");

//to get system template, interface
$back = new background;
echo $back->general();
echo $back->content();	

//if data is submitted
if (isset($_POST['additem'])){
$item1=$_POST['itemname'];
$price1=$_POST['itemprice'];

if ($item1){
	if (strpos($item1, ' ')){
		exit("<p class='warn'>Invalid item name.<br>Please name the item with single word.");
	}
}

if (is_numeric($price1)==false){
	exit("<p class='warn'>Invalid price.");
}

//calculate gst price
$func= new funct($item1,$price1);
$gstp =$func->calGst();


$write1= new writeFile();
//call the function for checking the file
$write1->checking();  //inheritance
//call the function to write data into txt
echo $write1->writeIntoFile($item1,$price1,$gstp);
}

//total price requested
if (isset($_POST['extractrec'])){
	$extract1= new extractFile();
	$extract1->checking();//inheritance
	$extract1->extractFromFile();
}

//new bill requested
if (isset($_POST['startb'])){
	$reset1= new deleteFile();
	 $reset1->checking();//inheritance 
}


?>

</html>
