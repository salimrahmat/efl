<?php
include "utility/connection.php";
if (empty($_SESSION['id_user']) or empty($_SESSION['nama_user']) or empty($_SESSION['id_level_user'])) {
    header("location:../index.php");
}else{
$iduser=$_SESSION['id_level_user'];
?>

	<div class="left-side-bar">
		<div class="brand-logo">
            <img src="vendors/images/header.jpeg" alt="">
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
                    <?php
                        $query = "select distinct nama_menu,idparent,link_menu
                                    from lst_menu
                                  where id_user=$iduser and idparent > 0 and status=1";
                        $hasil = $conn->query($query);
                        if ($hasil === false) {
                            echo $error = trigger_error("query salah" . $conn->error, E_USER_ERROR);
                        }else{
                            while ($r=mysqli_fetch_array($hasil)){
                                   $id_parent = $r['idparent'];
                                ?>
                                <li class="dropdown">
                                      <a href="javascript:;" class="dropdown-toggle">
                                          <span class="fa "></span><span class="mtext"><?php echo $r['nama_menu'];?></span>
                                      </a>
                                        <?php
                                        $sql = "SELECT nama_menu,link_menu
                                                     FROM `lst_menu`
                                                  WHERE id_user=$iduser and idChild=$id_parent and status=1";
                                        $result = $conn->query($sql);
                                        if ($result === false) {
                                            echo $error = trigger_error("query salah" . $conn->error, E_USER_ERROR);
                                        }else{
                                            while ($r=mysqli_fetch_array($result)){?>
                                                <ul class="submenu">
                                                    <li><a href="<?php echo $r['link_menu']; ?>" ><?php echo $r['nama_menu']; ?></a></li>
                                                </ul>
                                               <?php
                                            }
                                        }
                                        ?>
                                </li>
                        <?php
                                }
                        }
                   ?>
				</ul>
			</div>
		</div>
	</div>
<?php }?>