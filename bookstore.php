<html>

<head>
    <title>Project 1- Sneh Upadhyay</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.html">My Book Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="col-md-6">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.html">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bookstore.php">Book Store</a>
                    </li>


                </ul>

            </div>
        </div>
    </nav>
</body>

</html>

<?php
   require('mysqli_connect.php');

    $user = 'select * from BookInventory';

//prepare the statement
$rows=array();
$disp = $mysqli->query($user); 
 
if ($disp->num_rows > 0) {
  
  while($row = $disp->fetch_array()) {
    echo "<br><center><div class='col-md-4' style='float:left;'>&nbsp;</div><div class='col-md-4' style='float:left;'><a href='?bookid=".$row['BookInventory_Id']."' style='color:#28abb9; font-size:20px;'>Book name: " .$row['Book_Name']."</a></div><div class='col-md-3' style='float:right;'>&nbsp;</div>
    <div class='clearfix'></div></center>";
      
  }
} else {
  echo "no results";
}

if(!(empty($_GET['bookid'])))
{
    session_start();
    $_SESSION['bookid']=$_GET['bookid'];
    header("Location: checkout.php");
}


?>
