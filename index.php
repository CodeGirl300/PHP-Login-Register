<?php
SESSION_START();
require ('connect.php');
//This is the validation for the login
if(isset($_POST['login'])){
	$sql="SELECT * FROM members WHERE email=? AND password=?";
	$ss=mysqli_prepare($connect,$sql);
	$ss->bind_param("ss",$eu,$pe);
	$eu=$_POST['email'];
	$pe=$_POST['password'];
	$ss->execute();
	
	if(!empty($eu) && !empty($pe) && $ss->fetch()>0){
		$_SESSION['email']=$_POST['email'];
		header('Location:welcome.php');
	}
	
	if(empty($eu)){
		$eerr="Did you forget your email?";
	}elseif(empty($pe)){
		$pwerr="Password required";
	}elseif($ss->fetch()!==1){
		$eerr="That account do not exist";
	}
	
}

//This is the validation for registration
if(isset($_POST['register'])){
	$sql="SELECT * FROM members WHERE email=?";
	$sss=mysqli_prepare($connect,$sql);
	$sss->bind_param("s",$e);
	$e=$_POST['remail'];
	$pw=$_POST['rpassword'];
	$sss->execute();
	
	if(!empty($e) && !empty($pw) && $sss->fetch()<1){
		$sql="INSERT INTO members (email,password)VALUES(?,?)";
		$sss=mysqli_prepare($connect,$sql);
		$sss->bind_param("s",$eq);
	    $pq=$_POST['rpassword'];
		$sss->execute();
		echo"You have signed up!";
	}
	
	if(empty($e)){
		$emailerr="Please provide your email adress!";
	}elseif(empty($pw)){
		$passworderr="Choose a password";
	}elseif($sss->fetch()>0){
		$emailerr="That account exist";
	}
	
}


?>
<!DOCTYPE html>
<html>
<head>
<title>Login and Registration</title>
<style>
span{
	color:red;
}
</style>
</head>
<body>
Login
<form action="" method="POST">
<input type="text" name="email" placeholder="Email"/><span><?php echo $eerr;?><span><br>
<input type="password" name="password" placeholder="Password"/><span><?php echo $pwerr;?></span><br>
<input type="submit" name="login" value="Login"/>
</form>
<br><br>
Register
<form action="" method="POST">
<input type="text" name="remail" placeholder="Email"><span>*<?php echo $emailerr;?></span><br>
<input type="password" name="rpassword" placeholder="Password"><span>*<?php echo $passworderr;?><span><br>
<input type="submit" name="register" value="Register"/>
</form>
</body>
</html