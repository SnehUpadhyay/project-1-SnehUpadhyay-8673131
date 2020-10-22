<?php
   require('mysqli_connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if(empty($_POST['Firstname']) || empty($_POST['Lastname'] || empty($_POST['payment_option'])))
    {
        echo "<h3>Please enter value in all fields.</h3>" ;  
    }
    else
    {
       $santized_firstname = $mysqli->real_escape_string(trim($_POST['Firstname']));
        $santized_lastname = $mysqli->real_escape_string(trim($_POST['Lastname']));
        $santized_payment = $mysqli->real_escape_string(trim($_POST['payment_option']));
        $quantity=1;
        $bookid=$_SESSION['bookid'];
        $sql_insert = "insert into bookinventoryorder(Firstname,Lastname,payment_option,quantity,BookInventory_Id) values(?,?,?,?,?)";
        
        $statement = $mysqli->prepare($sql_insert);
        $statement->bind_param('sssii',$santized_firstname,$santized_lastname,$santized_payment,$quantity,$bookid);
        $statement->execute();
        
        if ($statement->affected_rows ==1){
            echo "<br/>Order successfully placed.";
        }
        else{
            echo "<br>Order Fail.";
        }
        
        $sql_update="update bookinventory set quantity = (quantity -1) where BookInventory_Id=?";
        $statement1 = $mysqli->prepare($sql_update);
        $statement1->bind_param('i',$bookid);
        $statement1->execute();
        if ($statement->affected_rows ==1){
            echo "<br/>Quantity updated.";
        }
        else{
            echo "<br>quantity is not updated.";
        }        
    }
}
    
   
?>
<html>
<head>
    <title>Project 1 - Sneh Upadhyay</title>
    </head>
<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.js"></script>
</head>

<body>
    <div>
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
    </div>
    <div><br></div>
    <center>
        <h3>Check Out</h3>
    </center>
    <br>
    <div class="col-md-4" style="float:left;">&nbsp;</div>
    <div class="col-md-4" style="float:left;">
        <form action="checkout.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="First Name" name="Firstname" required />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Last Name" name="Lastname" required />
            </div>
            <center>
                <div class="form-group form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_option" id="inlineRadio1" value="Credit">
                    <label class="form-check-label" for="inlineRadio1">Credit Card</label>
                </div>
                <div class="form-group form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_option" id="inlineRadio2" value="Debit">
                    <label class="form-check-label" for="inlineRadio2">Debit Card</label>
                </div>
                <div class="form-group form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="payment_option" id="inlineRadio3" value="Cash">
                    <label class="form-check-label" for="inlineRadio3">Cash</label>
                </div>
            </center>
            <div class="form-group">
                <center>
                    <input type="submit" name="submit" class="btn btn-danger" value="Check Out" />
                </center>
            </div>

        </form>
    </div>
    <div class="col-md-4" style="float:left;">&nbsp;</div>
</body>

</html>
