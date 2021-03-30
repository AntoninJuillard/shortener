<?php


$servername = 'localhost';
$username = 'root';
$userpassword = 'root';



// source help to manage the database: https://www.w3schools.com/php/php_mysql_intro.asp
// access the server from Php
$connect = new mysqli($servername, $username, $userpassword);

// source for the "IF NOT EXISTS" : https://forums.mysql.com/read.php?101,213455,213496

// create a new database if it is not already created 
$sql = "CREATE DATABASE IF NOT EXISTS urldb";

// check if there are no errors & send the request
if ($connect->query($sql) === TRUE) {
    
} else {
    echo "Error: " . $connect->error;
};

// connect to the database
$conn = new mysqli($servername, $username, $userpassword, 'urldb');

// Check the connection / source : https://www.w3schools.com/php/php_mysql_insert.asp & https://www.w3schools.com/Php/func_mysqli_connect_error.asp
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    
};

// create a table in the database if it is not already created
$sql = "CREATE TABLE IF NOT EXISTS urlsystem (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
urlbase VARCHAR(100) NOT NULL,
urlshort VARCHAR(100) NOT NULL,
activated VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
views INT
)";
// make the request 
$conn->query($sql);

session_start();
$sessionemail = $_SESSION['email'];

$sql = "SELECT * FROM urlsystem WHERE email='$sessionemail' ";
$sessionresult = $conn->query($sql);
    
// help to loop on the result of the request https://phppot.com/mysql/mysql-fetch-using-php/ 

// code to change the activation / deactivation value of the links 
if(isset($_GET['change']))
{
    $servername = 'localhost';
    $username = 'root';
    $userpassword = 'root';

    // source help to manage the database: https://www.w3schools.com/php/php_mysql_intro.asp
    // access the server from Php
    $connect = new mysqli($servername, $username, $userpassword);

    // source for the "IF NOT EXISTS" : https://forums.mysql.com/read.php?101,213455,213496

    // create a new database if it is not already created 
    $sql = "CREATE DATABASE IF NOT EXISTS urldb";

    // check if there are no errors & send the request
    if ($connect->query($sql) === TRUE) {
        //echo "Database created successfully";
    } else {
        echo "Error: " . $connect->error;
    };

    // connect to the database
    $conn = new mysqli($servername, $username, $userpassword, 'urldb');

    // Check the connexion / source : https://www.w3schools.com/php/php_mysql_insert.asp & https://www.w3schools.com/Php/func_mysqli_connect_error.asp
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        //echo 'connected';
    };



    // get the id of the clicked link (in the url)
    $idchange = $_GET['change'];
    // select the link in the database 
    $sql = "SELECT * FROM urlsystem WHERE id='$idchange'";
    $idresult = $conn->query($sql);
    // help to loop on the result of the request https://phppot.com/mysql/mysql-fetch-using-php/ 
    if ($idresult->num_rows > 0) {
        // output data of each row
        if($rowsid = mysqli_fetch_row($idresult))
        {
            // if the activated column of the link row in the database is true 
            // it is now false (UPDATE) and vice versa
            if($rowsid[3] == 'true')
            {
                // source UPDATE : https://www.w3schools.com/php/php_mysql_update.asp
                $sql = "UPDATE urlsystem SET activated='false' WHERE id='$idchange'";
                if ($conn->query($sql) === TRUE) {
                    //echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else if($rowsid[3] == 'true'){
                $sql = "UPDATE urlsystem SET activated='true' WHERE id='$idchange'";
                if ($conn->query($sql) === TRUE) {
                    //echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        };
    } else {
        //echo "0 results";
    };
};


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shortener</title>
    <link rel="stylesheet" href="css/connection.css">
</head>
<body>
    <div class="home_container">
        <div class="account-button">mon compte</div>
        <form method="POST" action="addlink.php" class="home_form">
            <h1 class="form_label">Rentrez votre lien</h1>
            <input type="text" name="lien" id="lien" placeholder="put link here">
            <input type="submit" name="submitlink" value="GO" class="home_form_submit-button home_form_submit-register-button"/>
        </form>
    </div>
    <div class="account_zone">
        <div class="account_container">
            <div class="account_link-title">Mes liens</div>
            <div class="account_link-container">
                <?php while($rows = mysqli_fetch_row($sessionresult)) { ?>
                        <?php echo '<div class="account_link-element">'; ?>
                            <?php echo '<div class="account_link-element_title">'; ?>
                                <?php print_r($rows[1]); ?>
                            <?php echo '</div>'; ?>
                            <!-- changer l'affichage du bouton en fonction de l'activation ou non du lien -->
                            <?php if($rows[3]==='true') { ?>
                                <?php echo '<div class="account_link-element_state"></div>'; ?>
                                <?php echo '<a href=createlink.php?change='.$rows[0].'>desactiver</a>'; ?>
                            <?php } else { ?>
                                <?php echo '<div class="account_link-element_stateoff"></div>'; ?>
                                <?php echo '<a href=createlink.php?change='.$rows[0].'>activer</a>'; ?>
                            <?php }; ?>
                            
                            <?php echo '<div class="account_link-element_views">'; ?>
                                <?php echo '<div class="icon"></div>'; ?>
                                <?php echo '<div class="number"> views ='; ?>
                                    <?php print_r($rows[5]); ?>
                                <?php echo '</div>'; ?>
                            <?php echo '</div>'; ?>
                        <?php echo '</div>'; ?>
                    <?php } ?>
            </div>
        </div>
    </div>
    <script src="linkszone.js"></script>
</body>
</html>