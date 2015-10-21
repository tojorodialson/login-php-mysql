<?php
session_start();
include_once('connection.php');
if(isset($_POST['btnLogin'])){
	$emailconnect=htmlspecialchars($_POST['emailconnect']);
	$passconnect=sha1($_POST['passconnect']);
	
	if(!empty($emailconnect) AND !empty($passconnect)){
			$requser = $pdo->prepare("SELECT * FROM users WHERE mail=? AND pass=?");
			$requser->execute(array($emailconnect, $passconnect));
			$userexist = $requser->rowCount();
		
			if($userexist == 1){
				$userinfo = $requser->fetch();
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['mail'] = $userinfo['mail'];
				header("Location: dashboard.php?id=".$_SESSION['id']);
				}else{
					$erreur='<div class="alert alert-danger">Email or password invalid</div>';
				}
	}else{
		$erreur='<div class="alert alert-danger">Complete all fields</div>';
	}
}
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Login User</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="panel panel-default">
<div class="panel-body">
<form class="form-horizontal" method="POST">
<fieldset>
<?php
	if(isset($erreur)){
		echo $erreur;
	}
?>
<legend><h5>Login to User</h5></legend>

<legend><h5>Enter your account information:</h5></legend>
<div class="form-group">
	<label for="inputEmail" class="col-lg-2 control-label">Email</label>
		<div class="col-lg-6">
        	<input type="text" placeholder="example@yourdomain.com" name="emailconnect" class="form-control" maxlength="50"/>
      	</div>
</div>
<div class="form-group">
	<label for="inputEmail" class="col-lg-2 control-label">Password</label>
		<div class="col-lg-6">
        	<input type="password" placeholder="Password" name="passconnect" class="form-control"/>
      	</div>
</div>
<div class="form-group">
	<div class="col-lg-3 col-lg-offset-2">
		<button type="submit" class="btn btn-primary form-control" name="btnLogin">Sign In</button>
	</div>
		<a href="signup.php" class="btn btn-primary form-control" style="width: 110px">Sign up</a>
</div>
</fieldset>
</form>
</div>
</body>
</html>
