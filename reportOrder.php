<?php
session_start();
include "utility/connection.php";
include "utility/function.php";
if (empty($_SESSION['id_user']) or empty($_SESSION['nama_user']) or empty($_SESSION['id_level_user'])) {
    header("location:index.php");
}else{
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('include/head.php'); ?>
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
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="beranda.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Report Order</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Export Datatable start -->
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <div class="clearfix mb-20">

                </div>
                <div class="row">
                    <table class="stripe hover multiple-select-row data-table-export nowrap">
                        <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">Nama kurir</th>
                            <th class="table-plus datatable-nosort">Job detail</th>
                            <th class="table-plus datatable-nosort">Job description</th>
                            <th class="table-plus datatable-nosort">Start Position</th>
                            <th class="table-plus datatable-nosort">Company designer</th>
                            <th class="table-plus datatable-nosort">Proses date</th>
                            <th class="table-plus datatable-nosort">Approve date</th>
                            <th class="table-plus datatable-nosort">Start time</th>
                            <th class="table-plus datatable-nosort">End time</th>
                            <th class="table-plus datatable-nosort">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                          $sql="select b.nama_user,a.job_detail,a.job_description,a.start_position,
                                       a.company_designation,a.input_date,a.approve_date,
                                       a.start_time,a.end_time,c.status_name
                                  from mst_transaction a 
                                       inner join lst_user b
                                             on a.id_user = b.id_user
                                       inner join lst_status c 
                                             on a.id_status = c.id_status";
                          $hasil = $conn->query($sql);
                          while ($r=mysqli_fetch_array($hasil)) {
                        ?>
                        <tr>
                            <td class="table-plus"><?php echo $r['nama_user']; ?></td>
                            <td><?php echo $r['job_detail']; ?></td>
                            <td><?php echo $r['job_description']; ?></td>
                            <td><?php echo $r['start_position']; ?></td>
                            <td><?php echo $r['company_designation']; ?></td>
                            <td><?php echo $r['input_date']; ?></td>
                            <td><?php echo $r['approve_date']; ?></td>
                            <td><?php echo $r['start_time']; ?></td>
                            <td><?php echo $r['end_time']; ?></td>
                            <td><?php echo $r['status_name']; ?></td>
                        </tr>
                          <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Export Datatable End -->
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
                 'csv', 'print'
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