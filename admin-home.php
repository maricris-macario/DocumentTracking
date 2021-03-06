<?php 
$pagename = 'Home'; 
	//echo $_SERVER['DOCUMENT_ROOT']; 
	//include($_SERVER['DOCUMENT_ROOT'] . '/pma_all/head.php'); 
	//include($_SERVER['DOCUMENT_ROOT'] . '/pma_all/admindbconnect.php');
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

<style type="text/css"> 
textarea {
	overflow: auto;
	resize: vertical;
	border: none;
	padding: .3em;
	border-radius: 30px;
	min-height: 3em;
}
form > .form-group > textarea {
	overflow: auto;
	resize: vertical;
	border: none;
	padding: .3em;
	border-radius: 30px;
	background-color: #f5f5f5;
}
.box {
	overflow-x: auto;
	overflow-y: auto;
	padding: 1.2em;
}
.navbar {
	margin-bottom: 0px; 
}
.btn-outline {
	background-color: transparent;
	color: inherit;
	transition: all .5s;
}
.btn-success.btn-outline {
	color: black;
}
.btn-success.btn-outline:hover {
	color: #fffaf0;
}
th {
	text-align: center;
}
input[type="text"] {
	border: none;
	padding: .3em;
	border-radius: 30px;
}
form > .form-group > input[type="text"], 
form > .form-group > input[type="password"] {
	border: none;
	padding: .3em;
	border-radius: 30px;
	background-color: #f5f5f5;
}
.btn-group-vertical {
	float: right;
	position: -webkit-sticky;
	position: sticky;
	bottom: 0;
	box-shadow: 7px 7px 15px #778899;
	opacity: 0.3;
}
.btn-group-vertical:hover {
	opacity: 1;
}
</style>

<body>
	<!-- navbar -->
	<?php include 'admin-navbar.php' ?>
	<!-- main content -->
	<div class="container">
		<!-- users -->
		<?php
		$queryUsers = "SELECT completeName, username, officeName, status , userLevel, user.userID, user.officeID FROM user LEFT JOIN office ON office.officeID = user.officeID";
		$getUsers = mysqli_query($con, $queryUsers);
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="box" id="users">
					<div class="box-header">
						<div class="row">
							<div class="col-md-10">
								<h4>Users</h4>
							</div>
							<div class="col-md-2">
								<button id="addUserMdlBtn" class="btn btn-md btn-outline-primary btn-block" data-toggle="modal" data-target="#addNewUser" type="button">Add User</button>
							</div>
						</div>
					</div>
					<div class="box-body">

						<table id="usertable" class="display compact">
							<thead>
								<tr>
									<th>Complete Name</th>
									<th>Username</th>
									<th>Office</th>
									<th>Status</th>
									<th>User Level</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (mysqli_num_rows($getUsers) > 0) {
									while ($u = mysqli_fetch_assoc($getUsers)) { ?>
										<tr>
											<form action="admin-queries.php" method="post">
												<td><input type="text" name="cname" value="<?php echo $u['completeName']; ?>" placeholder="<?php echo $u['completeName']; ?>"></td>
												<td><input type="text" name="uname" value="<?php echo $u['username']; ?>" placeholder="<?php echo $u['username']; ?>"></td>
												<td>
													<input type="text" value="<?php echo $u['officeID']; ?>" name="user_office" hidden>
													<select class="form-control" name="user_office">
														<option value="<?php echo $u['officeID']; ?>" selected="selected" disabled><?php echo $u['officeName']; ?></option> 
														<?php
														$queryOffices = "select * from office";
														$getOffices = mysqli_query($con, $queryOffices);
														if (mysqli_num_rows($getOffices) > 0) {
															while ($office = mysqli_fetch_assoc($getOffices)) { ?>
																<option value="<?php echo $office['officeID'] ?>"><?php echo $office['officeName']; ?></option>
															<?php   }
														}
														?>
													</select>
												</td>
												<td>
													<input type="text" name="u_status" value="<?php echo $u['status']; ?>" hidden>
													<select class="form-control" name="u_status">
														<option value="<?php echo $u['status']; ?>" selected="selected" disabled><?php echo $u['status']; ?></option>
														<option>Active</option>
														<option>Inactive</option>
													</select>
												</td>
												<td>
													<input type="text" name="u_lvl" value="<?php echo $u['userLevel'] ?>" hidden>
													<select class="form-control" name="u_lvl">
														<option value="<?php echo $u['userLevel'] ?>" selected="selected" disabled><?php echo $u['userLevel'] ?></option>
														<option>1</option>
														<option>2</option>
													</select>
												</td>
												<td>
													<!--<input type="text" name="update_user" value="<?php //echo $u['userID'] ?>" hidden>-->
													<div class="row">
														<div class="col-md-12">
															<button data-toggle="tooltip" value="<?php echo $u['userID'] ?>" type="submit" title="Update" class="btn btn-sm btn-outline-dark btn-block" name="update_user"><span><i class="glyphicon glyphicon-edit"></i> Edit</span></button>
														</div>
													</div>  
												</td>
											</form>
										</tr>
									<?php }
								}
								?>
							</tbody>
						</table>

					</div>
					<div class="box-footer"></div>
				</div>
			</div>
		</div>

		<!-- office -->
		<?php 
		$queryOffice = "SELECT * FROM office";
		$getOffices = mysqli_query($con, $queryOffice);
		?>
		<div class="row">
			<div class="col-md-9"> 
				<div class="box" id="office">
					<div class="box-header">
						<div class="row">
							<div class="col-md-10">
								<h4>Office</h4>
							</div>
							<div class="col-md-2">
								<button id="addUserMdlBtn" class="btn btn-md btn-outline-primary btn-block" data-toggle="modal" data-target="#addOffice" type="button">Add Office</button>
							</div>
						</div>
					</div>
					<div class="box-body">
						<table id="officestable" class="display compact">
							<thead>
								<tr>
									<th>Name</th>
									<th>Description</th>
									<th>Location</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (mysqli_num_rows($getOffices) > 0) {
									while ($o = mysqli_fetch_assoc($getOffices)) { ?>
										<tr>
											<form action="admin-queries.php" method="post">
												<td>
													<input type="text" name="office_name" value="<?php echo $o['officeName']; ?>" placeholder="<?php echo $o['officeName']; ?>">
												</td>
												<td>
													<textarea name="officeDesc" placeholder="<?php echo $o['description']; ?>"><?php echo $o['description']; ?></textarea>
												</td>
												<td>
													<input type="text" name="officeLoc" value="<?php echo $o['location']; ?>" placeholder="<?php echo $o['location']; ?>">
												</td>
												<td>
													<div class="row">
														<div class="col-md-12">
															<!--<button data-toggle="modal" data-target="#updtOffice" title="Update" class="btn btn-sm btn-default btn-block"><span><i class="glyphicon glyphicon-edit"></i></span></button>-->
															<button data-toggle="tooltip" title="Update" name="update_office" class="btn btn-sm btn-outline-dark btn-block" value="<?php echo $o['officeID'] ?>"><span><i class="glyphicon glyphicon-edit"></i> Edit</span></button>
														</div>
													</div>
												</td>
											</form>
										</tr>
									<?php   }
								}
								?>
							</tbody>
							<tfoot>

							</tfoot>
						</table>
					</div>
					<div class="box-footer"></div>
				</div>
			</div>

			<!-- document type -->
			<?php
			$docTypeQuery = "SELECT * FROM type";
			$getDocType = mysqli_query($con, $docTypeQuery);
			?>
			<div class="col-md-3">
				<div class="box" id="doctype">
					<div class="box-header">
						<div class="row">
							<div class="col-md-6">
								<h4>Document Type</h4>
							</div>
							<div class="col-md-6">
								<button id="addUserMdlBtn" class="btn btn-md btn-outline-primary btn-block" data-toggle="modal" data-target="#addDocType" type="button">Add Type</button>
							</div>
						</div>
					</div>
					<div class="box-body">
						<table id="doctypetable" class="display compact">
							<thead>
								<tr>
									<th>Name</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (mysqli_num_rows($getDocType) > 0) {
									while ($dt = mysqli_fetch_assoc($getDocType)) { ?>
										<tr>
											<td><?php echo $dt['docType'] ?></td>
										</tr>
									<?php   }
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="box-footer"></div>
				</div>
			</div>

		</div>


		<!-- modals -->
		<div class="modal" role="dialog" id="addNewUser">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title"><h4>Add New User</h4></div>
						<button class="close" type="button" data-dismiss="modal" aria-label="close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="admin-queries.php" method="post" autocomplete="off">
							<div class="form-group">
								<label>Complete Name</label>
								<input class="form-control" type="text" name="user_cname" required maxlength="75">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input  class="form-control" type="text" name="user_uname" required maxlength="30">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input  class="form-control" type="password" name="user_pwd" required>
							</div>
							<div class="form-group">
								<label>Office</label>
								<!--<input type="text" name="newUsr_officeID" value="<?php //echo $office['officeID']; ?>" hidden>-->
								<select required class="form-control" name="newUsr_officeID">
									<option selected disabled value="">Select</option> 
									<?php
									$queryOffices = "select * from office";
									$getOffices = mysqli_query($con, $queryOffices);
									if (mysqli_num_rows($getOffices) > 0) {
										while ($office = mysqli_fetch_assoc($getOffices)) { ?>
											<option value="<?php echo $office['officeID']; ?>"><?php echo $office['officeName']; ?></option>
										<?php   }
									} 
									?>
								</select>
							</div>
							<div class="form-group">
								<label>User Level</label>
								<select required class="form-control" name="user_lvl">
									<option selected disabled value="">Select</option>
									<option>1</option>
									<option>2</option>
								</select>
							</div>

							<div class="modal-footer">
								<input type="text" name="submitNewUser" value="submit" hidden>
								<button type=submit" class="btn btn-outline-success" name"submitNewUser" value="submit">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" role="dialog" id="addOffice">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title"><h4>Add New Office</h4></div>
						<button class="close" type="button" data-dismiss="modal" aria-label="close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="admin-queries.php" method="post">
							<div class="form-group">
								<label>Name</label>
								<input class="form-control" type="text" name="office_name" required>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control" rows="4" name="office_desc"></textarea>
							</div>
							<div class="form-group">
								<label>Location</label>
								<input class="form-control" type="text" name="office_loc">
							</div>

							<div class="modal-footer">
								<input type="text" name="submitNewOffice" value="submit" hidden>
								<button class="btn btn-outline-success" type="submit" name="submitNewOffice" value="submit">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" role="dialog" id="addDocType">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<div class="modal-title"><h4>Add New Document Type</h4></div>
						<button class="close" type="button" data-dismiss="modal" aria-label="close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="admin-queries.php" method="post">
							<div class="form-group">
								<label>Name</label>
								<input class="form-control" type="text" name="doc_type">
							</div>
							
							<div class="modal-footer">
								<input type="text" name="submitNewDocType" value="submit" hidden>
								<button class="btn btn-outline-success" type="submit" name="submitNewDocType">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- sticky buttons -->
		<div class="btn-group-vertical">
			<a class="btn btn-outline-info btn-md btn-float" href="#users" data-toggle="tooltip" title="View and Add Users"><i class="fa fa-users"></i></a>
			<a class="btn btn-outline-info btn-md btn-float" href="#office" data-toggle="tooltip" title="View and Add Offices"><i class="fa fa-briefcase"></i></a>
			<a class="btn btn-outline-info btn-md btn-float" href="#doctype" data-toggle="tooltip" title="View and Add Document Types"><i class="fa fa-file-alt"></i></a>
			<a href="#" class="btn btn-outline-info btn-md btn-float" data-toggle="tooltip" title="Back to Top"><i class="fa fa-arrow-circle-up"></i></a>
		</div>
		
	</div>
	<script>
		$(function () {
			$('#usertable').DataTable()
			$('#officestable').DataTable()
			$('#doctypetable').DataTable()
		}); 
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
</body>
<?php 
	//include($_SERVER['DOCUMENT_ROOT'] . '/pma_all/footer.php');
include ('footer.php'); 
?>
</html>