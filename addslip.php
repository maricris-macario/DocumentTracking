<?php $pagename = "Home | Add Slip" ?>
<?php include ('head.php')?>
<script type="text/javascript" src="js/timeDate.js"></script>
<?php include ('db.php')?>

<body class="animsition">
    <?php include ('navbar.php'); ?>  

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            
            <?php include ('header.php'); ?>
            <!-- MAIN CONTENT-->
            
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h4 class="title-1">Add Slip</h4>
                                    <!--<button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#addSlip">
                                        <i class="zmdi zmdi-plus"></i>add slip</button>-->
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-12 col-sm">
                                
                            <form id="addSlip" name="addSlip" method="POST">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 ml-auto">
                                             <h6 id="label">Document Number: </h6> 
                                            <input id="docnumber" class="form-control" type="text" name="docnumber" placeholder=" Enter Document Number" autocomplete="off">   
                                            </div>

                                            <div class="col-md-6 ml-auto">
                                            <h6 id="label">Subject: </h6>
                                            <input id="docsubj" class="form-control" type="text" name="docsubj" placeholder="Enter Subject" autocomplete="off">
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <h6 id="label">Details: </h6>
                                            <!--input id="docdet" type="text" name="docdet" placeholder="Document Details" autocomplete="off"-->
                                            <textarea class="form-control" id="docdet" aria-label="Details"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!--div class="form-group"-->
                                              <!--label for="sel1">Select Document Type:</label-->
                                              <div class="col-md-6 ml-auto">
                                              <h6 for="docType" id="label">Document Type: </h6>
                                              <select class="form-control" id="docType">
                                                <option selected disabled>Select</option>
                                                <?php 
                                                $queryType = "SELECT * FROM type";
                                                $getDocType = mysqli_query($con, $queryType);

                                                if (mysqli_num_rows($getDocType) > 0) {
                                                    while ($type = mysqli_fetch_assoc($getDocType)) {
                                                ?>
                                                <option><?php echo $type['docType']; ?></option>

                                            
                                            <?php 
                                                }
                                            }
                                            ?>
                                            </select>
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <h6 for="pLvl" id="label">Priority Level: </h6>
                                                <select class="form-control" id="pLvl">
                                                    <option selected disabled>Select</option>
                                                    <!--option value="rush">Rush</option>
                                                    <option value="regular">Regular</option-->
                                                        <?php
                                                            $queryPriority = "SELECT * FROM priority";
                                                            $getPriority = mysqli_query($con, $queryPriority);

                                                            if (mysqli_num_rows($getPriority) >0 ) {
                                                                while ($priority = mysqli_fetch_assoc($getPriority)) {
                                                        ?>
                                                        <option><?php echo $priority['priorityLvl']?></option>
                                                  
                                                  <?php
                                                             }
                                                        } 
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <h6 id="label">Receiving Offices: </h6>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" placeholder=" Enter Receiving Office" aria-label="recOffice" aria-describedby="basic-addon2"  autocomplete="on">
                                              <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" id="addRecOffice" type="button">Add</button>
                                              </div>
                                            </div>
                                            </div>

                                            <div class="col-md-6 ml-auto">
                                            <h6 id="label">Approving Offices: </h6>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" placeholder=" Enter Approving Office" aria-label="approvingOffice" aria-describedby="basic-addon2"  autocomplete="on">
                                              <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" id="addAprOffice" type="button">Add</button>
                                              </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>       
                                </div>
                                <div class="col-sm-2 ml-auto">
                                    <div class="container-fluid">
                                       <button type="submit" class="btn btn btn-primary" id="addSlip" name="addSlip">Save</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->

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
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#slip').DataTable( {
                "pagingType": "full_numbers"
            } );
        } );
    </script>-->

    
</body>

</html>
<!-- end document-->
