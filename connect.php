<?php

// check if the form has been sent 
if(isset($_POST['submit']))
{
    // retrieve data from the form
    $email = $_POST['email'];
    $password = $_POST['password'];


    $servername = 'localhost';
    $username = 'root';
    $userpassword = 'root';

    // source help to manage the database: https://www.w3schools.com/php/php_mysql_intro.asp
    // access the server from Php
    $connect = new mysqli($servername, $username, $userpassword);

    // connect to the database
    $conn = new mysqli($servername, $username, $userpassword, 'logindb');

    // Check the connection / source help: https://www.w3schools.com/php/php_mysql_insert.asp
    // request
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // select the rows of the table where the email and the password appear
    // help source: https://www.w3schools.com/sql/sql_select.asp

    $sql = "SELECT * FROM users WHERE email='$email' AND pass='$password'";
    // source help : https://stackoverflow.com/questions/42050614/mysqli-queryconn-sql-or-conn-querysql
    // result of the query = 
    $result = $conn->query($sql);

    // check if there are results to the query (= if the identifiers are in the database)

    if ($result->num_rows > 0) { 
        session_start(); 
        $_SESSION['email'] = $email;
        include 'createlink.php'; 
    } else { 
        include 'connection.php'; 
    }; 

}
?>

