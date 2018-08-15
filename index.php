<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
    <?php include('utility/function.php'); ?>
    <script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="js/jquery-validation.js"></script>
    <script>
        //            angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
        $(document).ready(function(){setTimeout(function(){$("#result").fadeIn('slow');}, 500);});
        //            angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
        setTimeout(function(){$("#result").fadeOut('slow');}, 3000);
        $(document).ready(function(){
            $("#kotakdialog").dialog({
                autoOpen: false
            });

            $("#buka").click(function() {
                    $("#kotakdialog").dialog('open');
                }
            );
        });
    </script
</head>
<body>
	<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-white box-shadow pd-30 border-radius-5">
			<img src="vendors/images/logo_update.png" alt="login" class="login-img">
			<h2 class="text-center mb-30">Login</h2>
            <?php
            if (isset($_GET['id'])){
                $error=get_Error($_GET['id']);
                echo "<div id='result' style=display:yes;'>$error</div>";
            }
            $error="";
            ?>
			<form method="post" action="fungsi/modul_login/check_login.php" id="login">
				<div class="input-group custom input-group-lg">
					<input type="text" class="form-control" placeholder="Email" name="email"  title="Email harus di isi">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="input-group custom input-group-lg">
					<input type="password" class="form-control" placeholder="**********" name="password"
                           id="password" class="field required" title="Password harus di isi"
                    >
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group">
                            <button class="btn btn-outline-primary btn-lg btn-block" type="submit">
                                Sign In
                            </button>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="forgot-password padding-top-10"><a href="forgot-password.php">Forgot Password</a></div>
					</div>
				</div>
			</form>
		</div>
	</div>

</body>
</html>