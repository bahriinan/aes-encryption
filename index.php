<!DOCTYPE html>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
.bit{position:relative;
top:15px;
left:-200px;
}
.block{position:relative;
top:-20px;
left:200px;
}
</style>



<script>
function validateForm() {
    var x = document.forms["myForm"]["password"].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
	  var value = document.forms["myForm"]["fileToUpload"].value;
        ext = value.split(".").pop();

    if( !value ) {
        alert("You have to select a text file.");
    }
    else if ( ext !== "txt" ) {
        alert("Choose only a .txt file please.");
    }

    return ( ext === "txt" );
}
</script>



<html>
<body>

<form  name="myForm" onsubmit="return validateForm()" action="upload.php" align="center" method="post" enctype="multipart/form-data">
<table border="1" align="center" style="width:50%">
<tr><td><u><h3>AES ENCRYPT & DECRYPT</h3></u></td></tr>

<tr><td> <br>
    Select txt to upload:&nbsp;
    <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
	</td></tr>
	<tr><td><br>
	Enter your password:<br>
	<input type="password" name="password" maxlength=16 ><br><br>
	</td></tr>
	<tr><td>
	<div class="bit">
	Select your bit parameter:<br>
	<select name="bit">
<option value="128" selected>128 bit</option>
<option value="192">192 bit</option>
<option value="256">256 bit</option>
</select>
</div>
<div class="block">
	Select your block parameter:<br>
	<select name="block">
<option value="8" selected>8 bit</option>
<option value="16">16 bit</option>
<option value="32">32 bit</option>
</select>
</div>

</td></tr>
<tr><td>
<input type="radio" name="type" checked="true" value="encrypt">ENCRYPT<br>
  <input type="radio" name="type" value="decrypt">DECRYPT<br>
  
</td></tr>

	<tr><td><br>
    <input type="submit" value="UPLOAD" name="submit"><br><br>
</td></tr>
	</table>
	</form>

</body>
</html>