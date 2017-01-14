<?php
class SECURITY{
	 public function __construct($pass,$bit,$block,$type){
		 if(strlen($pass)>16 || ($bit!=128 && $bit!=256 && $bit!=192) || ($block!=8 && $block!=16 && $block!=32 )  || ($type!="encrypt" && $type!="decrypt") )
		 {
			
			  echo "Sorry, unexpected inputs.";
		
			echo '<br><a href="index.php">Back to home page</a>';
	exit(0);
			 
		 }
	 }
	
	
}


?>