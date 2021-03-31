<?php
// EVERYTHING TO REGISTER A NEW USER : 
// check that the form is sent
// source for the isset: https://www.php.net/manual/fr/function.isset.php
if(isset($_POST['submit']))
{
    // retrieve data from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
  

    $servername = 'localhost';
    $username = 'root';
    $userpassword = 'root';

    // source to manage the database: https://www.w3schools.com/php/php_mysql_intro.asp
    
    // access the server from Php
    $connect = new mysqli($servername, $username, $userpassword);
  

    // source for the "IF NOT EXISTS" : https://forums.mysql.com/read.php?101,213455,213496

    // create a new database if it is not already created 
    $sql = "CREATE DATABASE IF NOT EXISTS logindb";
    $connect->query($sql);

    // connect to the database
    $conn = new mysqli($servername, $username, $userpassword, 'logindb');
    
    // Check the connection / source : https://www.w3schools.com/php/php_mysql_insert.asp & https://www.w3schools.com/Php/func_mysqli_connect_error.asp
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  

    // create a table in the database if it is not already created
    $sql = "CREATE TABLE IF NOT EXISTS  users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    pass VARCHAR(100) NOT NULL
    )";
    
    $conn->query($sql);

    // select the rows of the table where the email and the password appear
    // help source: https://www.w3schools.com/sql/sql_select.asp

    $sql = "SELECT * FROM users WHERE email='$email' AND pass='$password'";
    // source help: https://stackoverflow.com/questions/42050614/mysqli-queryconn-sql-or-conn-querysql
    
    $result = $conn->query($sql);

    // check if there are results to the query (= if the identifiers are in the database)
    if ($result->num_rows > 0) {
        include 'registration.php';
    } else {
        session_start();
        $_SESSION['email'] = $email;
        // insert the new identifiers in the database
        // source to help insertion: https://forums.commentcamarche.net/forum/affich-1602964-variable-php-dans-requete-mysql
        $sql = "INSERT INTO users (email, pass)
        VALUES ('$email', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        };

        // include the url creation page
        include 'createlink.php';

    }

};

?>