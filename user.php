<?php
session_start();
include "utility/connection.php";
if (empty($_SESSION['id_user']) or empty($_SESSION['nama_user']) or empty($_SESSION['id_level_user'])) {
    header("location:index.php");
}else{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <?php
        include('include/head.php');
        ?>
        <script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="js/jquery-validation.js"></script>

        <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
        <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">

    </head>
    <body>
    <?php include('include/header.php'); ?>
    <?php include('include/sidebar.php'); ?>
    <?php include('utility/function.php');?>
    <?php include('utility/connection.php');?>
    <div class="main-container">
        <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>User</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="beranda.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data User</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <?php
                        $act="";
                        $id="";
                        if(isset($_GET['modul'])){
                            $act=$_GET['modul'];
                        };
                        if(isset($_GET['id'])){
                            $id=$_GET['id'];
                        };

                        switch($act) {
                            default: ?>
                                <a href="?modul=tambah"><button type="button" class="btn btn-outline-secondary" >Tambah User</button></a>
                                <br><br>
                                <div class="row">
                                    <table class="data-table stripe hover nowrap">
                                        <thead>
                                        <tr>
                                            <th class="table-plus">Nama user</th>
                                            <th class="table-plus">Email</th>
                                            <th class="datatable-nosort">Level user</th>
                                            <th class="datatable-nosort">Status</th>
                                            <th class="datatable-nosort">Last login</th>
                                            <th class="datatable-nosort">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sql="select a.id_user,a.nama_user,b.nama_level, 
                                           case when a.status=1 then 'Active' else 'Non Active' end as status,
                                           last_login,a.status as stts,a.email 
                                      from lst_user a 
                                           inner join lst_user_level b on a.id_level_user = b.id_level_user";
                                        $hasil = $conn->query($sql);
                                        while ($r=mysqli_fetch_array($hasil)){
                                            ?>
                                            <tr>
                                                <td><?php echo $r['nama_user']; ?></td>
                                                <td><?php echo $r['email']; ?></td>
                                                <td><?php echo $r['nama_level']; ?></td>
                                                <td><?php echo $r['status']; ?></td>
                                                <td><?php echo $r['last_login']; ?></td>
                                                <td><div class="dropdown">
                                                        <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <?php
                                                            if($r['stts']==1){
                                                                echo "<a class=\"dropdown-item\" href=\"fungsi/modul_user/statusUser.php?stat=$r[stts]&id=$r[id_user]\"><i class=\"fa fa-pencil\"></i>Disable</a>";
                                                            }else{
                                                                echo "<a class=\"dropdown-item\" href=\"fungsi/modul_user/statusUser.php?stat=$r[stts]&id=$r[id_user]\"><i class=\"fa fa-pencil\"></i>Enable</a>";
                                                            }
                                                            ?>
                                                            <a class="dropdown-item" href="?modul=update&id=<?php echo $r['id_user'] ?>" ><i class="fa fa-pencil"></i>Edit</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                    <?php break;
                        case "tambah";
                         if(isset($_GET['error'])){
                             $error=$_GET['error'];
                             echo "<div id='result' style=display:yes;'>$error</div>";
                         }else{
                             $error="";
                         }
                        ?>
                        <form id="login" method="post" action="fungsi/modul_user/insertUser.php">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control" type="text"  name="nama_lengkap" title="Harus diisi" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                                <div class="col-sm-12 col-md-10">
                                    <input  class="form-control" type="text"  name="email" title="Harus diisi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Password</label>
                                <div class="col-sm-12 col-md-10">
                                    <input  class="form-control" type="password"  name="password" title="Harus diisi">
                                </div>
                            </div>
                            <div class="form-group row" >
                                <label class="col-sm-12 col-md-2 col-form-label">Level User</label>
                                <div class="col-sm-12 col-md-10">
                                    <select name="lvl_user" class="form-control" title="Harus diisi">
                                        <option value="">
                                            <?php
                                            $sql3="select id_level_user,nama_level from lst_user_level";
                                            $tampil1 = $conn->query($sql3);
                                            while ($r=mysqli_fetch_array($tampil1)){
                                                echo"<option value=\"$r[id_level_user]\">$r[nama_level]</option>";
                                            }
                                            ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="btn-list">
                                <button type="submit" class="btn btn-success" >Submit</button>
                                <button type="button" class="btn btn-danger" onclick="self.history.back()">Cancel</button>
                            </div>
                        </form>
                            <?php break;
                             case "update";
                                 $sql="select a.id_user,a.nama_user,a.email,a.password,b.nama_level 		
                                  from lst_user a
                                        inner join lst_user_level b
                                        on a.id_level_user = b.id_level_user
                                where a.id_user=$id ";
                                 $result = $conn->query($sql);
                                 $r=mysqli_fetch_array($result);?>

                                 <form id="login" method="post" action="fungsi/modul_user/updateUser.php">
                                     <div class="form-group row">
                                         <label class="col-sm-12 col-md-2 col-form-label">Nama Lengkap</label>
                                         <div class="col-sm-12 col-md-10">
                                             <input hidden class="form-control" type="text" value="<?php echo $r['id_user'] ?>" name="idUser" title="Harus diisi" >
                                             <input class="form-control" type="text" value="<?php echo $r['nama_user'] ?>" name="nama_lengkap" title="Harus diisi" >
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                                         <div class="col-sm-12 col-md-10">
                                             <input  class="form-control" type="text" value="<?php echo $r['email'] ?>"  name="email" title="Harus diisi">
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-sm-12 col-md-2 col-form-label">Password</label>
                                         <div class="col-sm-12 col-md-10">
                                             <input  class="form-control" type="password" placeholder="*********"  name="password" title="Harus diisi">
                                         </div>
                                     </div>
                                     <div class="form-group row" >
                                         <label class="col-sm-12 col-md-2 col-form-label">Level User</label>
                                         <div class="col-sm-12 col-md-10">
                                             <select name="lvl_user" class="form-control" title="Harus diisi">
                                                 <option value="">
                                                     <?php
                                                     $sql3="select id_level_user,nama_level from lst_user_level";
                                                     $tampil1 = $conn->query($sql3);
                                                     while ($r1=mysqli_fetch_array($tampil1)){
                                                         if ($r['nama_level']==$r1['nama_level']){
                                                             echo"<option value=\"$r1[id_level_user]\" selected>$r1[nama_level]</option>";
                                                         }
                                                         else{
                                                             echo"<option value=\"$r1[id_level_user]\">$r1[nama_level]</option>";
                                                         }
                                                     }
                                                     ?>
                                                 </option>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="btn-list">
                                         <button type="submit" class="btn btn-success" >Submit</button>
                                         <button type="button" class="btn btn-danger" onclick="self.history.back()">Cancel</button>
                                     </div>
                                 </form>

                                 <?php    break;
                                }
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/script.php'); ?>
    <script src="src/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/media/js/dataTables.bootstrap4.js"></script>
    <script src="src/plugins/datatables/media/js/dataTables.responsive.js"></script>
    <script src="src/plugins/datatables/media/js/responsive.bootstrap4.js"></script>
    <!-- buttons for Export datatable -->
    <script src="src/plugins/datatables/media/js/button/dataTables.buttons.js"></script>
    <script src="src/plugins/datatables/media/js/button/buttons.bootstrap4.js"></script>
    <script src="src/plugins/datatables/media/js/button/buttons.print.js"></script>
    <script src="src/plugins/datatables/media/js/button/buttons.html5.js"></script>
    <script src="src/plugins/datatables/media/js/button/buttons.flash.js"></script>
    <script src="src/plugins/datatables/media/js/button/pdfmake.min.js"></script>
    <script src="src/plugins/datatables/media/js/button/vfs_fonts.js"></script>
    <script>
        $('document').ready(function(){
            $('.data-table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "info": "_START_-_END_ of _TOTAL_ entries",
                    searchPlaceholder: "Search"
                },
            });
            $('.data-table-export').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "language": {
                    "info": "_START_-_END_ of _TOTAL_ entries",
                    searchPlaceholder: "Search"
                },
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'pdf', 'print'
                ]
            });
            var table = $('.select-row').DataTable();
            $('.select-row tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
            var multipletable = $('.multiple-select-row').DataTable();
            $('.multiple-select-row tbody').on('click', 'tr', function () {
                $(this).toggleClass('selected');
            });
        });
    </script>
    <script src="src/plugins/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="src/plugins/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="src/plugins/jquery-asColorPicker/dist/jquery-asColorPicker.js"></script>
    <script>
        $(".colorpicker").asColorPicker();
        $(".complex-colorpicker").asColorPicker({
            mode: 'complex'
        });
        $(".gradient-colorpicker").asColorPicker({
            mode: 'gradient'
        });
    </script
    </body>
    </html>
<?php }?>