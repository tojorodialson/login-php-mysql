<?php
session_start();
include_once('connection.php');
if(isset($_SESSION['id'])){
	$requser = $pdo->prepare("SELECT * FROM users WHERE id=?");
	$requser->execute(array($_SESSION['id']));
	$user = $requser->fetch();
?>
<body>
<!--begin main-content-->
<div class="container">
<div class="row">
<div class="col-md-9 user-profile-info">
<p><span>Email:</span> <a href="mailto:#"><?php echo $user['mail']; ?></a></p>
</div>
</div>
</div>
<!--end main-content-->

</body>

<?php
}else{
	header("Location: index.php");
	}
?>
