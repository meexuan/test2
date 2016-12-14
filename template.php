<html>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<?php



interface template1{
	
	public function general();
}

interface template2{
	
	public function content();
	
}
class background implements template1,template2{
	
//to show app title	
	public function general(){
	
	$a="<h2>Welcome to billing calculator</h2>";	
	return $a;
	}

//to show textbox and button	
	public function content(){
		
		$b= "
		<form method='POST' action='index.php'><input type='submit' name='startb' value='Start a new bill'></form>";
		
		$b.='<form method="POST" action="index.php">
		<br><table class="tablesize"><td>Item Name:<input class="tbsize1" type="text" name="itemname" placeholder="single word naming"> ';         
		 $b.=  'RM<input  class="tbsize2"type="text" name="itemprice"></td>
		
		<td><input type="submit" name="additem" value="ADD"></td></table></form>';
		
		$b.='<br/><form method="post" action="index.php"><input type="submit" name="extractrec" value="TOTAL ALL"></form>';
		return $b;
		
		
		}
		
	public function getvalue(){
		//to get item name and price
		if(isset($_POST['itemname'])){
			$itemname=$_POST['itemname'];
			$itemprice=$_POST['itemname'];
		
		}


	
	}

	
}



?>

</html>