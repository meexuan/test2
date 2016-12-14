<link rel="stylesheet" type="text/css" href="mystyle.css">
<?php

//class funct
class funct {


public $price;
public $name;
public $oriprice;
public $gstprice;
public $totalprice=0;
public $totalgst=0;


public function __construct($itemname,$price){
	//to pass the item name and peice	
	$this->name=$itemname;
	$this->price=$price;	
	}
	
	public function calGst(){
	//calculate how much from the price is GST	
		$oriprice=$this->price *100/106;
		$this->gstprice=round ($this->price - $oriprice,2);
		
		return $this->gstprice;
	}
	
	

	//calculate total bill 
	public function calTotalPrice($topassprice){
		$this->totalprice+=$topassprice;
		return $this->totalprice;
		
	}
	
	//calculate total gst
	public function calTotalGst($topassgst){
		$this->totalgst+=$topassgst;
		return $this->totalgst;
	}
	

}

//class checkfile for inheritance
abstract class checkfile{
	
	public function checking(){
	if (!file_exists("receipt")) {
    mkdir("receipt",0777, true);
	}
	}
}

//class writeFile 
 class writeFile extends checkfile{
	
	//store the data into txt
	function writeIntoFile($item1,$price1,$gstp){
		$this->name=$item1;
		$this->price=$price1;
		$this->gstprice=$gstp;
		
	$data = $this->name." ".$this->price." ".$this->gstprice."\r\n";

 $ret = file_put_contents('receipt.txt',$data, FILE_APPEND );
    if($ret === false) {
        die('There was an error writing this file');
    }
	}
 
   
}

//class extractFile
class extractFile extends checkfile{
	public $totalprice=0;
	public $totalgst=0;
	
	//get the data from txt
	function extractFromFile(){
	$file = fopen("receipt.txt", "r") or exit("No receipt stored! <br/>Key in item and price to get new receipt!");
	//Output a line of the file until the end is reached

	echo "<table><tr><th>Item Name</th><th>Price(RM)</th><th>@6% GST(RM)</th></tr>";



	while(!feof($file)) //read every single lline
	{
	$sen=fgets($file);
	$sent=explode(' ',$sen); //change phrase into array
	if (isset($sent[1])){ 
	//sent0=item name, sent1=item price,sent2=gst price
	echo "<tr><td>".$sent[0]."</td><td>".$sent[1]."</td><td>".$sent[2]."</td></tr>"; 
  
  $this->totalprice+=$sent[1]."<br/>";
  $this->totalgst+=$sent[2]."<br/><br/>";
  }
 
  
  
  }
  echo "</table>";
fclose($file);
   echo "<br/>Total Price: RM". number_format($this->totalprice,2)."<br/>";
   echo "Total GST : RM".$this->totalgst;
   //echo $this->totalprice;
   //echo $this->totalgst;
		}		
	
 
}



	//class deleteFile to delete existing file 
class deleteFile extends checkfile{
	public function checking(){
		 
    if (file_exists("receipt.txt")) {
        unlink("receipt.txt");
    } 
	}
	}
	







?>