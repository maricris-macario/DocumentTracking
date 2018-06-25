<?php $pagename = "Home" ?>
<?php include ('head.php')?>
<script type="text/javascript" src="js/timeDate.js"></script>
<?php include ('db.php')?>

<body class="animsition">
    <?php include ('navbar.php'); ?>  

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            
            <?php include ('header.php'); ?>
            <!-- MAIN CONTENT-->
            <?php 
                $querySlip = "SELECT * FROM slip LEFT JOIN priority on slip.priorityID = priority.priorityID LEFT JOIN type on slip.typeID = type.typeID LEFT JOIN office on slip.officeID = office.officeID";
                $getSlip = mysqli_query($con, $querySlip);

            ?>
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Slips</h2>
                                    <a href="addSlip.php"><button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>add slip</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-12 col-lg">
                                <div class="row">
                                    <div class="table table-responsive table-data2">
                                        <table class="table table-bordered table-condensed  text-center" id="slip">
                                        <!--table class="table table-striped table-bordered table-hover" id="slip"-->
                                            <thead>
                                                <th>Date</th>
                                                <th>Originating Office</th>
                                                <th>Document Number</th>
                                                <th>Subject</th>
                                                <th>Doctype</th>
                                                <th>Priority</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if(mysqli_num_rows($getSlip) > 0){
                                                    while ($s = mysqli_fetch_assoc($getSlip)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $s['date']; ?></td>
                                                    <td><?php echo $s['officeName']; ?></td>
                                                    <td><?php echo $s['documentNum']; ?></td>
                                                    <td><?php echo $s['subject']; ?></td>
                                                    <td><?php echo $s['docType']; ?></td>
                                                    <td><?php echo $s['priorityLvl']; ?></td>
                                                    <td>
                                                    <div class="table-data-feature"-->
                                                        <button class="item" data-toggle="modal" data-target="#editDet">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                        <button class="item" data-toggle="modal" data-target="#moreDet">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php }
                                        }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->

            <!--MODAL SLIP-->
            <div id="addSlip" class="modal fade" role="dialog">
                <?php include('addslipModal.php'); ?>
            </div>
            <!--END OF MODAL-->

            <!--MODAL moreDet -->
            <div id="moreDet" class="modal fade" role="dialog">
                <?php include('moredetails.php'); ?>
            </div>
            <!-- END OF MODAL -->

            <!-- MODAL editDet -->
            <div id="editDet" class="modal fade" role="dialog">
                <?php include('editDetails.php'); ?>                
            </div>

                <!--<?php include ('footer.php'); ?>-->

            <!-- END PAGE CONTAINER-->
        </div>
    </div>
</div>
    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <!-- DATA TABLE -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#slip').DataTable( {
                "pagingType": "full_numbers"
            } );
        } );
    </script>

    
</body>

</html>
<!-- end document-->
