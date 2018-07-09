<?php 
$pagename = "Home | Add Slip";
include ('head.php');
include ('db.php');
if (isset($_SESSION['loggedIn'])) {
    if ($_SESSION['loggedIn'] === 'FALSE' || empty($_SESSION['loggedIn'])) {
        echo "<script type='text/javascript'>alert('Login required.'); window.location.href='index.php';</script>";
        //echo print_r($_SESSION['loggedIn']);
        //header("location: index.php");
    } 
} else {
    echo "<script type='text/javascript'>alert('Login required.'); window.location.href='index.php';</script>";
}
?>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
<body class="animsition">
    <?php include ('navbar.php'); ?>  

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            
            <?php include ('header.php'); ?>
            <!-- MAIN CONTENT-->
            <?php
            if (isset($_POST['userID'])) {
                
                $userOffice = $_SESSION['officeID'];
                $userID = $_SESSION['userID'];

                $docNum = stripcslashes($_REQUEST['docnumber']); // remove backslashes
                $docNum = mysqli_real_escape_string($con, $docNum); // escapes special characters in a string
                $docSub = stripcslashes($_REQUEST['docsubj']);
                $docSub = mysqli_real_escape_string($con, $docSub);
                $docDet = stripcslashes($_REQUEST['docdet']);
                $docDet = mysqli_real_escape_string($con, $docDet);
                $docType = stripslashes($_REQUEST['docType']);
                $docType = mysqli_real_escape_string($con, $docType);
                $priority = stripcslashes($_REQUEST['pLvl']);
                $priority = mysqli_real_escape_string($con, $priority);
                $dateCreated = date("Y-m-d");

                $queryTypeID = "SELECT typeID FROM type WHERE doctype = '{$docType}'";
                $getTypeID = mysqli_query($con, $queryTypeID);
                $queryUserOffice = "SELECT officeID FROM office WHERE officeName = '{$userOffice}'";
                $getUserOffice = mysqli_query($con, $queryUserOffice);

                if(mysqli_num_rows($getTypeID) > 0) {
                  $typeID = mysqli_fetch_assoc($getTypeID);
                }
                if(mysqli_num_rows($getUserOffice) > 0) {
                    $officeID = mysqli_fetch_assoc($getUserOffice);
                }

                /*if (isset($_POST['recOffice'])) {
                    $getRecOff = $_POST['recOffice'];
                    $selected = "";

                    foreach ($getRecOff as $option => $value) {
                        $selected .=$value.',';
                    }
                    //echo $selected;
                }

                if (isset($_POST['appOffice'])) {
                    $getAppOff = $_POST['appOffice'];
                    $selectedOffice = "";

                    foreach ($getAppOff as $option) {
                        $selectedOffice .=$option.',';
                    }
                    //echo $selectedOffice;
                }*/

                //create slip
                $query = "INSERT INTO `slip` (prioritylvl, documentNum, typeID, subject, details, officeID, dateCreated, userID) VALUES ('$priority', '$docNum', '$typeID', '$docSub', '$docDet', '$officeID', '$dateCreated', '$userID')";
                $result = mysqli_query($con, $query);


                    if ($result) {
                        echo "<script type='text/javascript'>alert('Slip Created'); window.location.href='user.php';</script>";
                    } else {
                        echo "<script type='text/javascript'>alert('Error in creating slip'); window.location.href='addslip.php';</script>";
                    }
            }
                
            ?>
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h4 class="title-1">Add Slip</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-12 col-sm form-group">
                                
                            <form id="addSlip" name="addSlip" method="POST" action="addslip.php">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 ml-auto">
                                             <h6 id="label">Document Number: </h6> 
                                            <input id="docnumber" class="form-control" type="text" name="docnumber" placeholder=" Enter Document Number" autocomplete="off" required>   
                                            </div>

                                            <div class="col-md-6 ml-auto">
                                            <h6 id="label">Subject: </h6>
                                            <input id="docsubj" class="form-control" type="text" name="docsubj" placeholder="Enter Subject" autocomplete="off" required>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <h6 id="label">Details: </h6>
                                            <!--input id="docdet" type="text" name="docdet" placeholder="Document Details" autocomplete="off"-->
                                            <textarea class="form-control" id="docdet" aria-label="Details" required></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!--div class="form-group"-->
                                              <!--label for="sel1">Select Document Type:</label-->
                                              <div class="col-md-6 ml-auto">
                                              <h6 for="docType" id="label">Document Type: </h6>
                                              <select class="form-control" id="docType" required>
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
                                                <select class="form-control" id="pLvl"  required>
                                                    <option selected disabled>Select</option>
                                                    <!--option value="rush 1">Rush</option>
                                                    <option value="regular 2">Regular</option-->
                                                        <?php
                                                            $queryPriority = "SELECT * FROM slip";
                                                            $getPriority = mysqli_query($con, $queryPriority);

                                                            if (mysqli_num_rows($getPriority) >0 ) {
                                                                while ($priority = mysqli_fetch_assoc($getPriority)) {
                                                        ?>
                                                        <option><?php echo $priority['prioritylvl']?></option>
                                                  
                                                  <?php
                                                             }
                                                        } 
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="container">
                                                <h5>Receiving Office</h5>
                                                <select class="selectpicker form-control" id="recOff" name="recOffice[]" label="Receiving Offices" data-style="btn-info" multiple data-live-search="true" required>
                                                    <?php
                                                        $ol_officeName  = $_SESSION['officeName'];

                                                        $queryRecOffice = "SELECT * FROM office WHERE officeName != 'CAS' AND officeName != 'Asupt' AND officeName != 'Supt' AND officeName != '{$ol_officeName}'";
                                                        $getRecOff = mysqli_query($con, $queryRecOffice);

                                                        if (mysqli_num_rows($getRecOff) > 0) {
                                                            while ($recOff = mysqli_fetch_assoc($getRecOff)) {
                                                    ?>
                                                    
                                                    <option value="<?php echo $recOff['officeName']?>"><?php echo $recOff['officeName']?></option>
                                                    
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                  </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 ml-auto">
                                                <div class="container">
                                                <h5>Approving Office</h5>
                                                <select class="selectpicker form-control" id="recOff" name="appOffice[]" data-style="btn-info" multiple data-live-search="true">
                                                    <optgroup label="Approving Offices">
                                                        <option value="Supt">Superintendent</option>
                                                        <option value="Asupt">Assistant Superintendent</option>
                                                        <option value="CAS">Chief of Staff</option>
                                                        <option value="otherOffice" disabled>Other Offices</option>
                                                    </optgroup>
                                                    <optgroup label="Other Offices">
                                                        <?php
                                                            $ol_officeName  = $_SESSION['officeName'];

                                                            $queryOtherOff = "SELECT * FROM office WHERE officeName != 'CAS' AND officeName != 'Asupt' AND officeName != 'Supt' AND officeName != '{$ol_officeName}';";
                                                            $getOtherOff = mysqli_query($con, $queryOtherOff);

                                                                if (mysqli_num_rows($getOtherOff) > 0) {
                                                                    while ($o = mysqli_fetch_assoc($getOtherOff)) {

                                                        ?>
                                                        <option value="<?php echo $o['officeName']?>"><?php echo $o['officeName'];?></option>

                                                        <?php
                                                                    }
                                                                }
                                                        ?>
                                                    </optgroup>
                                                  </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>       
                                </div>
                                <div class="col-sm-2 ml-auto">
                                    <div class="container-fluid form-group">
                                        <input type="hidden" name="userID" id="userID">
                                       <button type="submit" class="btn btn btn-primary" id="addSlip" name="submit" value="submits">Save</button>
                                    </div>
                                    <!--<div class="form-group">
                                        <input type="hidden" name="draftID" id="draftID"/>
                                        <div id="autosave"></div>
                                    </div>-->
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

    <!-- AUTOSAVE -->
    <!-- <script>
        $(document).ready(function() {
            function autosave() {
                var pDocNum = $('#docnumber').val(); //post document number
                var pDocSubj = $('#docsubj').val(); //post document subject
                var pDocDet = $('#docdet').val(); //post document details
                var pDocType = $('#docType').val(); //post document type
                var pPlvl = $('#pLvl').val(); //post priority level
                var draftID = $('#draftID').val(); //postID

                if(pDocNum != '' && pDocSubj != '' && pDocDet != '' && pDocType != '' && pPlvl != '') {

                        $.ajax({
                            url:"saveDraft.php",
                            method:"POST",
                            data:{docnumber:pDocNum, docsubj:pDocSubj, docdet:pDocDet, docType:pDocType, plvl:pPlvl, draftID:draftID},
                            datatype:"text",
                            success:function(data) {
                                if(data != '') {
                                    $('#draftID').val(data);
                                }
                                $('#autosave').text('draft');
                                setInterval(function(){
                                    $('#autosave').text('');
                                }, 2000);
                            }
                        });
                }
            }
            setInterval(function() {
                autosave();
            }, 5000);
        });
    </script>-->

    <!-- SAVE Multi select dropdown -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#recOff').multiselect({
                nonSelectedText: 'Select Receiving Office',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth:'400px'
            });

            $('#appOff').multiselect({
                nonSelectedText: 'Select Approving Office',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth:'400px'
            })

            $('#addslip').on('submit', function(event){
                event.preventDefault();
                var form-data = $(this).serialize();
                $.ajax({
                    url:"insertRecApp.php",
                    method:"POST",
                    data:form_data,
                    success:function(data){
                        $('#recOff option:selected').each(function(){
                            $(this).prop('selected', false);
                        });
                        $('#appOff option:selected').each(function(){
                            $(this).prop('selected', false);
                        });

                        $('#recOff').multiselect('refresh');
                        alert(data);
                        $('#appOff').multiselect('refresh');
                        alert(data);
                    }
                });
            });
        });
    </script>

</body>
</html>
<!-- end document-->
