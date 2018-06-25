<?php
// Initialize the session
//session_start();

// If session variable is not set it will redirect to login page
//if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  //header("location: ../login.php");
  //exit;
//}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">



    <title>Car Go</title>
  </head>
    <style>
    body {
        background: url(vintagecar.jpg);
        background-repeat: no-repeat;
        background-position:center;
        background-size: cover;
        color:sandybrown;
        font-family: sans-serif;
        }
    table {
        background: ;
        border-collapse: separate;
        box-shadow: inset 0 1px 0 #fff;
        line-height: 24px;
        margin: 30px auto;
        text-align: left;
        width: 900px;
    }	

     table {
        background: #f5f5f5;
        border-collapse: separate;
        box-shadow: inset 0 1px 0 #fff;
        line-height: 24px;
        margin: 30px auto;
        text-align: left;
        width: 800px;
    }	

    th {
        background: black;
        border-left: 1px solid #555;
        border-right: 1px solid #777;
        border-top: 1px solid #555;
        border-bottom: 1px solid #333;
        box-shadow: inset 0 1px 0 #999;
        color: #fff;
      font-weight: bold;
        padding: 10px 15px;
        position: relative;
        text-shadow: 0 1px 0 #000;	
    }

    th:after {
        background: linear-gradient(rgba(255,255,255,0), rgba(255,255,255,.08));
        content: '';
        display: block;
        height: 25%;
        left: 0;
        margin: 1px 0 0 0;
        position: absolute;
        top: 25%;
        width: 100%;
    }

    th:first-child {
        border-left: 1px solid #777;	
        box-shadow: inset 1px 1px 0 #999;
    }

    th:last-child {
        box-shadow: inset -1px 1px 0 #999;
    }

    td {
        border-right: 1px solid #fff;
        border-left: 1px solid #e8e8e8;
        border-top: 1px solid #fff;
        border-bottom: 1px solid #e8e8e8;
        padding: 10px 15px;
        position: relative;
        transition: all 300ms;
    }

    td:first-child {
        box-shadow: inset 1px 0 0 #fff;
    }	

    td:last-child {
        border-right: 1px solid #e8e8e8;
        box-shadow: inset -1px 0 0 #fff;
    }	

    tr {
        background: url(https://jackrugile.com/images/misc/noise-diagonal.png);	
    }

    tr:nth-child(odd) td {
        background: #f1f1f1 url(https://jackrugile.com/images/misc/noise-diagonal.png);	
    }

    tr:last-of-type td {
        box-shadow: inset 0 -1px 0 #fff; 
    }

    tr:last-of-type td:first-child {
        box-shadow: inset 1px -1px 0 #fff;
    }	

    tr:last-of-type td:last-child {
        box-shadow: inset -1px -1px 0 #fff;
    }	

    tbody:hover td {
        color: transparent;
        text-shadow: 0 0 3px #aaa;
    }

    tbody:hover tr:hover td {
        color: #444;
        text-shadow: 0 1px 0 #fff;
    }
    </style>
  <body>
    <!--php code goes here-->
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $DB = "cargo_database";

    //to create a connection
    $conn = new mysqli($servername, $username, $password, $DB );
      if (!$conn){
          die("Couldn't connect to SQL Server on $server");
      }


    //to check the connection
   // if($cargo_db->connection_error){
      //die("Connection failed: " . $cargo_db->connect_error);
  //  }

      $sql = 'SELECT * FROM CUSTOMER';
      $query = mysqli_query($conn, $sql);



      if (!$query){
          die ('SQL Error: ' .mysqli_error($conn));
      }
    ?>

<!--div class="text-center">
<img src="bannerCarGoLogo.jpg" class="img-fluid" alt="Responsive image">
</div-->
      


    <h2>Welcome Back <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
    <?php
    echo "<h3> Today is: " . date("F d, Y l") . "<br>";
    ?>

      
      
<br>
<br>
  <!--navigation area-->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="maintenance.php">User Management</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="request.php">Registration Request</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="transactions.php">Transactions</a>
  </li>
  <li class="nav-item">
    <a href="logout.php active" class="btn btn-danger">Logout</a>
  </li>
</ul>

<br>
<br>



      <h1>List of Customers</h1>
	<table >
		<thead>
			<tr>
                <th>no</th>
				<th>custID</th>
				<th>firstName</th>
				<th>lastName</th>
				<th>address</th>
				<th>email</th>
                <th>contactNo</th>
                <th>license</th>
                <th>birthDate</th>
			</tr>
		</thead>
		<tbody>
        <?php
		$no 	= 1;
		while ($row = mysqli_fetch_array($query))
		{

			echo '<tr>
                    <td>'.$no.'</td>
					<td>'.$row['custID'].'</td>
                    <td>'.$row['firstName'].'</td>
					<td>'.$row['lastName'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['contactNo'].'</td>
                    <td>'.$row['license'].'</td>
                    <td>'.$row['birthDate'].'</td>
				</tr>';
			$no++;
		}?>
		</tbody>
	</table>

      <?php
      $sql = 'SELECT * FROM SERVICE_PROVIDER';
      $query = mysqli_query($conn, $sql);
      ?>

     <h1>List of Service Providers</h1>
	<table >
		<thead >
			<tr>
                <th>no</th>
				<th>spID</th>
				<th>firstName</th>
				<th>lastName</th>
				<th>email</th>
                <th>contactNo</th>
                <th>birthDate</th>
			</tr>
		</thead>
		<tbody>
        <?php
		$no 	= 1;
		while ($row = mysqli_fetch_array($query))
		{

			echo '<tr>
                    <td>'.$no.'</td>
					<td>'.$row['spID'].'</td>
                    <td>'.$row['firstName'].'</td>
					<td>'.$row['lastName'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['contactNo'].'</td>
                    <td>'.$row['birthDate'].'</td>
				</tr>';
			$no++;
		}?>
		</tbody>
	</table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
