<?php
include_once('connection.php');
if(isset($_POST['signup'])){
		$email=htmlspecialchars($_POST['email']);
		$pass=htmlspecialchars($_POST['pass']);
		$pass=sha1($_POST['pass']);
		$rpassword=sha1($_POST['rpassword']);
	if(!empty($_POST['email']) AND !empty($_POST['pass']) AND !empty($_POST['rpassword'])){
		
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$reqmail=$pdo->prepare("SELECT * FROM users WHERE mail=?");
			$reqmail->execute(array($email));
			$mailexist = $reqmail->rowCount();
			
			if($mailexist == 0){
				
				if($pass==$rpassword){
					$req="INSERT INTO users(mail,pass) VALUES (:mail, :pass)";
					$insertusers = $pdo->prepare($req);
					$insertusers->bindParam(':mail', $_POST['email'], PDO::PARAM_STR);
					$insertusers->bindParam(':pass', $pass, PDO::PARAM_STR);
					$insertusers->execute();
					header("Location: index.php");
				}else{
					$erreur='<div class="alert alert-danger">Enter the same value for the password</div>';
				}
			
			}else{
				$erreur= '<div class="alert alert-danger">Email already exist<br/>Try another</div>';
			}
		}else{
			$erreur='<div class="alert alert-danger">Email invalid</div>';
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
<title>Login</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>

<body>
<div class="container" style="margin-top: 20px; max-width: 100%; width: 50%">
<div class="panel panel-default">
<div class="panel-body">
<form class="form-horizontal" method="POST">
<fieldset>
<?php
if(isset($erreur)){
	echo $erreur;
	}
?>
<h5>Sign up</h5>
<hr/>
<h5>Enter your account details below</h5>
<hr/>
<div class="form-group">
	<label class="col-lg-3 control-label">Email</label>
		<div class="col-lg-6">
        	<input type="text" placeholder="example@yourdomain.com" name="email" value="<?php if(isset($email)){ echo $email; } ?>" class="form-control"/>
      	</div>
</div>
<div class="form-group">
	<label class="col-lg-3 control-label">Password</label>
		<div class="col-lg-6">
        	<input type="password" placeholder="Password" name="pass" class="form-control"/>
      	</div>
</div>
<div class="form-group">
	<label class="col-lg-3 control-label">Confirm Password</label>
		<div class="col-lg-6">
        	<input type="password" placeholder="Confirm Password" class="form-control" name="rpassword" />
      	</div>
</div>

<div class="form-group">
	<div class="col-lg-5 col-lg-offset-4">
		<button type="submit" class="btn btn-primary form-control show-tooltip" data-placement="top" name="signup">Sign up</button>
	</div>
</div>
<hr/>
</fieldset>
</form>
</div>

</body>
</html>
