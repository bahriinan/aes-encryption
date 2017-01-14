<?php
ob_start();
include("./AES.class.php");






	
		$pass = $_POST["password"];
		$bit= $_POST["bit"];
		$block=$_POST["block"];
		$type=$_POST["type"];
		

$target_dir = "";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$txtfiletype = pathinfo($target_file,PATHINFO_EXTENSION);




// Check file size
if ($_FILES["fileToUpload"]["size"] > 1500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
	echo '<br><a href="index.php">Back to home page</a>';
	exit(0);

}
// Allow certain file formats
if($txtfiletype != "txt"  ) {

	
	
    echo "Sorry, only txt files are allowed.";
    $uploadOk = 0;
	
	echo '<br><a href="index.php">Back to home page</a>';
	exit(0);

}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
	
	echo '<br><a href="index.php">Back to home page</a>';
	exit(0);

// if everything is ok, try to upload file
} else {
	//before upload validate variables
	include("./security.php");
	//pass,bit,block,type,
	$control = new SECURITY($pass,$bit,$block,$type);
	
		
	//
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       
		$fname=basename( $_FILES["fileToUpload"]["name"]);
		

	
		
		$sizofpass=strlen($pass);
		if($bit==128){
			$pass.="0000000000000000000000000000000000";
			$arr2 = str_split($pass, 16);
			$pass=$arr2[0];
		
		}else if($bit==192)
		{
			$pass.="11111111111111111111111111111111111111111111111111111";
			$arr2 = str_split($pass, 24);
			$pass=$arr2[0];
			
		}else if($bit==256){
			$pass.="22222222222222222222222222222222222222222222222222222";
			$arr2 = str_split($pass, 32);
			$pass=$arr2[0];
		}
		
		
		$z = $pass;
		
		$aes = new AES($z);
		$data = file_get_contents($fname);
		$start = microtime(true);
			//echo "Original data-> ".$data;
			//echo "<br>";
			//echo "<br>";
			$myfile = fopen($fname, "w") or die("Unable to open file!");
			if($type=="encrypt"){
					
				echo "\n\n<u>Bit Parameter:</u><br>\n".$bit."\n<br>";
				echo "\n\n<u>Block Parameter:</u><br>\n".$block."\n";
				
				$txt = $aes->encrypt($data,$block);
			/*	if(!unlink($fname))
					echo "Permission problem"
			*/
			}else{
				
				echo "\n\n<u>Bit Parameter:</u><br>\n".$bit."\n<br>";
				echo "\n\n<u>Block Parameter:</u><br>\n".$block."\n";
				$txt = $aes->decrypt($data,$block);
			/*	if(!unlink($fname))
					echo "Permission problem"
			*/
			}
			echo "<br><br>";
			$end = microtime(true);
			$sure = $end - $start;
		    echo "<br>Process Timing: $sure second.\n";
				fclose($myfile);
			
	$myfile = fopen("result.txt", "w") or die("Unable to open file!");
fwrite($myfile, $txt);

fclose($myfile);

		   echo '<br><a href="result.txt">Download</a><br>';
		   
		
		
		

    } else {
        echo "Sorry, there was an error uploading your file.";
		
	echo '<br><a href="index.php"  >Back to home page</a>';
		exit(0);

    }
}
ob_end_flush();
?>