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
        <?php include('include/head.php'); ?>
        <?php include('utility/function.php')?>
        <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
        <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">
    </head>
    <body>
    <?php include('include/header.php'); ?>
    <?php include('include/sidebar.php'); ?>

    <div class="main-container">
        <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Order</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="beranda.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php
                                        $module = ($_GET['modul']);
                                        if($module=='update'){
                                            echo "Status Order";
                                        }elseif ($module=='approval'){
                                            echo "Approval Order";
                                        }elseif ($module=='validate'){
                                            echo "Validate Order";

                                        }?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <?php
                    if(isset($_GET['act'])){
                        $act="'".$_GET['act']."'";
                    }
                    if($module=='update'){?>
                        <br><br>
                        <div class="row">
                            <table class="data-table stripe hover nowrap">
                                <thead>
                                <tr>
                                    <th>No Order</th>
                                    <th class="table-plus datatable-nosort">Nama Kurir</th>
                                    <th class="table-plus datatable-nosort">Job detail</th>
                                    <th class="table-plus datatable-nosort">Job description</th>
                                    <th class="table-plus datatable-nosort">Approve Date</th>
                                    <th class="table-plus datatable-nosort">User</th>
                                    <th class="table-plus datatable-nosort">Time Go</th>
                                    <th class="table-plus datatable-nosort">End Time</th>
                                    <th class="table-plus datatable-nosort">Status</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql="SELECT a.transaction_id,b.nama_user,a.job_detail,a.job_description,a.input_date,c.status_name,
                                             a.start_time,a.end_time,a.approve_date, a.id_status ,a.user  
                                         FROM mst_transaction  a 
                                              inner join lst_user b
                                                    on a.id_user = b.id_user 
                                              inner join lst_status c 
                                                    on a.id_status = c.id_status
                                        WHERE a.id_user=$_SESSION[id_user] and a.id_status in (2,3)
                                    order by a.transaction_id DESC ";
                                $hasil = $conn->query($sql);
                                while ($r=mysqli_fetch_array($hasil)) {

                                ?>
                                <tr>
                                    <td class="table-plus"><?php echo $r['transaction_id']; ?></td>
                                    <td><?php echo $r['nama_user']; ?></td>
                                    <td><?php echo ucwords($r['job_detail']); ?></td>
                                    <td><?php echo ucwords($r['job_description']); ?></td>
                                    <td><?php if (date('d M Y',strtotime($r['approve_date']))==='01 Jan 1970') {
                                            echo "";
                                        }else{
                                            echo date('d M Y',strtotime($r['approve_date']));
                                        } ?></td>
                                    <td><?php echo ucwords($r['user']); ?></td>
                                    <td><?php echo date('d M Y',strtotime($r['start_time']));?></td>
                                    <td><?php if (date('d M Y',strtotime($r['end_time']))==='01 Jan 1970') {
                                              echo "";
                                        }else{
                                            echo date('d M Y',strtotime($r['end_time']));
                                        } ?></td>
                                    <td><?php echo $r['status_name']; ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </a>
											<?php if ((date('d M Y',strtotime($r['end_time']))==='01 Jan 1970') and ($r['id_status']==2)) { ?>
                                               <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="fungsi/modul_order/updateTimeOrder.php?transid=<?php echo $r['transaction_id']; ?>"><i class="fa fa-pencil"></i> Finish</a>
                                               </div>
											<?php 
											}?>
                                            
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php }elseif ($module=='approval') { ?>
                        <div class="row">
                            <table class="data-table stripe hover nowrap">
                                <thead>
                                <tr>
                                    <th class="table-plus">No Order</th>
                                    <th class="datatable-nosort">Nama Kurir</th>
                                    <th class="datatable-nosort">Job detail</th>
                                    <th class="datatable-nosort">Job description</th>
                                    <th class="datatable-nosort">Proses Date</th>
                                    <th class="datatable-nosort">Status</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql="SELECT a.transaction_id,b.nama_user,a.job_detail,a.job_description,a.input_date,c.status_name,a.id_status
                                                                FROM mst_transaction  a
                                                                        inner join lst_user b
                                                                              on a.id_user = b.id_user
                                                                        inner join lst_status c
                                                                              on a.id_status = c.id_status
																WHERE a.id_status=1			  
                                                                order by a.transaction_id DESC ";
                                $hasil = $conn->query($sql);
                                while ($r=mysqli_fetch_array($hasil)){
                                    ?>
                                    <tr>
                                        <td class="table-plus"><?php echo $r['transaction_id']?></td>
                                        <td><?php echo $r['nama_user']?></td>
                                        <td><?php echo ucwords($r['job_detail'])?></td>
                                        <td><?php echo ucwords($r['job_description'])?></td>
                                        <td><?php echo date('d M Y',strtotime($r['input_date'])) ?></td>
                                        <td><?php echo $r['status_name']?></td>
                                        <td>
                                            <div disabled="" class="dropdown">
                                                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <?php if($r['id_status']==1){ ?>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!--                                                                            <a class="dropdown-item" href="#"><i class="fa fa-eye"></i> View</a>-->
                                                    <a class="dropdown-item" href="?modul=validate&act=<?php echo $r['transaction_id']; ?>"><i class="fa fa-eye"></i> Validate</a>
                                                </div>
                                                <?php }?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    <?php }elseif ($module=='validate'){
                        $sql="SELECT b.nama_user,a.transaction_id,a.input_date,a.job_detail,a.job_description,
                                   a.company_designation,a.start_position,a.start_time,c.status_name
                          FROM mst_transaction  a
                                inner join lst_user b
                                      on a.id_user = b.id_user
                                inner join lst_status c
                                      on a.id_status = c.id_status
                        WHERE a.transaction_id=$act
                        order by a.transaction_id desc";
                        $hasil = $conn->query($sql);
                        $r = mysqli_fetch_array($hasil);?>
                        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                            <form id="login" method="get" action="fungsi/modul_order/approvalOrder.php">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Nama Kurir</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input readonly class="form-control" type="text" value=<?php echo $r['nama_user']; ?> >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Proses Date</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input readonly class="form-control" type="text" name="input_date" value="<?php echo date('d M Y',strtotime($r['input_date'])); ?>"   >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Job Details</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input readonly  class="form-control" type="text" name="job_detail" title="Harus diisi" value="<?php  echo $r['job_detail'];?>" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Job Description</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input readonly  class="form-control" type="text"  name="job_descript" title="Harus diisi"  value="<?php  echo $r['job_description'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Company Designation</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input readonly  class="form-control" type="text" name="comp_destination" title="Harus diisi" value="<?php  echo $r['company_designation'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Start Position</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input readonly  class="form-control" type="text" name="start_position" title="Harus diisi" value="<?php  echo $r['start_position'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Time Go</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input readonly class="form-control " type="text"  name="time_go" title="Harus diisi"  value="<?php  echo $r['start_time'];?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Status</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input readonly class="form-control " type="text"  name="time_go" title="Harus diisi" value="<?php  echo $r['status_name'];?>" >
                                        <input hidden class="form-control" type="text"  name="id_trans" title="Harus diisi" value="<?php  echo $act;?>" >
                                    </div>
                                </div>
                                <div class="btn-list">
                                    <button type="submit" class="btn btn-success">Approve</button>
									<input type="submit" value="Reject" name="reject" class="btn btn-danger">
                                    <button type="button" class="btn btn-danger" onclick="self.history.back()">Cancel</button>
                                </div>
                            </form>
                        </div>
                    <?php }?>
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
    </body>
    </html>
<?php }?>