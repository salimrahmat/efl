<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
    <script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="js/jquery-validation.js"></script>
</head>
<body>
	<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-white box-shadow pd-30 border-radius-5">
			<img src="vendors/images/logo_update.png" alt="login" class="login-img">
			<h2 class="text-center mb-30">Forgot Password</h2>
            <?php
            if (isset($_GET['error'])){
                $error=$_GET['error'];
                echo "<div id='result' style=display:yes;'>$error</div>";
            }
            $error="";
            ?>
			<form method="post" id="login" action="fungsi/modul_user/forgotPassword.php">
				<p>Enter your email address to reset your password</p>
				<div class="input-group custom input-group-lg">
					<input type="text" class="form-control" placeholder="Email" name="email" title="Harus diisi">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
                        <button class="btn btn-outline-primary btn-lg btn-block" type="submit">
                            Submit
                        </button>
					</div>
					<div class="col-sm-6">
						<div class="forgot-password"><a href="index.php" class="btn btn-outline-primary btn-lg btn-block">Sign In</a></div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php include('include/script.php'); ?>
</body>
</html>