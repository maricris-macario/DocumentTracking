                    <div class="modal-dialog modal-lg" style="height:700px; max-height:700px; width:1000px; max-width:1000px;">
                    <!--MODAL CONTENT-->
                    <div class="modal-content">

                        <!--HEADER-->
                        <div class="modal-header">
                            <h4 class="modal-title">New Slip</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>                         
                        </div>
                        <!--END OF HEADER-->

                        <!--BODY-->
                        <div class="modal-body" >
                            <!--p>yung buong form dito ng slip</p-->
                            <form method="POST">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6 ml-auto">
                                         <h5 id="label">Document Number: </h5> 
                                        <input id="docnumber" class="form-control" type="text" name="docnumber" placeholder=" Enter Document Number" autocomplete="off">   
                                        </div>

                                        <div class="col-md-6 ml-auto">
                                        <h5 id="label">Subject: </h5>
                                        <input id="docsubj" class="form-control" type="text" name="docsubj" placeholder="Enter Subject" autocomplete="off">
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <h5 id="label">Details: </h5>
                                        <!--input id="docdet" type="text" name="docdet" placeholder="Document Details" autocomplete="off"-->
                                        <textarea class="form-control" id="docdet" aria-label="Details"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--div class="form-group"-->
                                          <!--label for="sel1">Select Document Type:</label-->
                                          <div class="col-md-6 ml-auto">
                                          <h5 for="docType" id="label">Document Type: </h5>
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
                                            <h5 for="pLvl" id="label">Priority Level: </h5>
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
                                        <h5 id="label">Receiving Offices: </h5>
                                        <div class="input-group mb-3">
                                          <input type="text" class="form-control" placeholder=" Enter Receiving Office" aria-label="recOffice" aria-describedby="basic-addon2"  autocomplete="on">
                                          <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" id="addRecOffice" type="button">Add</button>
                                          </div>
                                        </div>
                                        </div>

                                        <div class="col-md-6 ml-auto">
                                        <h5 id="label">Approving Offices: </h5>
                                        <div class="input-group mb-3">
                                          <input type="text" class="form-control" placeholder=" Enter Approving Office" aria-label="approvingOffice" aria-describedby="basic-addon2"  autocomplete="on">
                                          <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" id="addAprOffice" type="button">Add</button>
                                          </div>
                                        </div>
                                    </div>
                                </div>       
                            </div>
                            </form>
                        </div> 

                                        
                                  
                        <!--END OF BODY-->

                        <!--FOOTER-->
                        <div class="col-sm-2 ml-auto">
                        <div class="modal-footer">
                            <div class="container-fluid">
                               <button type="submit" class="btn btn btn-primary" id="addSlip" name="addSlip">Save</button>
                            </div>
                        </div>
                        </div>
                        <!--END OF FOOTER-->
                    </div>
                </div>
