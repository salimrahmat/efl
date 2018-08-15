<?php
include "utility/connection.php";
if (empty($_SESSION['id_user']) or empty($_SESSION['nama_user']) or empty($_SESSION['id_level_user'])) {
     header("location:../index.php");
}else{

?>


	<div class="header clearfix">
		<div class="header-right">
			<div class="brand-logo">
					<img src="vendors/images/header.jpeg" alt="" class="mobile-logo">

			</div>
			<div class="menu-icon">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon"><i class="fa fa-user-o"></i></span>
						<span class="user-name"><?php echo $_SESSION['nama_user']; ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="profile.php?modul=update"><i class="fa fa-user-md" aria-hidden="true"></i> Profile</a>
						<a class="dropdown-item" href="./fungsi/modul_login/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }?>



