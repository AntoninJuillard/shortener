<?php 

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
                        
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                } else if($rowsid[3] == 'true'){
                    $sql = "UPDATE urlsystem SET activated='true' WHERE id='$idchange'";
                    if ($conn->query($sql) === TRUE) {

                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            };
        } else {
            //echo "0 results";
        };

        session_start();
        $sessionemail = $_SESSION['email'];

        $sql = "SELECT * FROM urlsystem WHERE email='$sessionemail' ";
        $sessionresult = $conn->query($sql);
    };

function showurls($pagename){

    while($rows = mysqli_fetch_row($sessionresult)) { 

        echo '<div class="account_link-element">'; 
            echo '<div class="account_link-element_title">'; 
                print_r($rows[1]); 
            echo '</div>'; 
            // change the display of the button depending on whether the link is enabled or not
            if($rows[3]==='true') { 
                echo '<div class="account_link-element_state"></div>'; 
                echo '<a href='.$pagename.'.php?change='.$rows[0].'>desactiver</a>'; 
            } else { 
                echo '<div class="account_link-element_stateoff"></div>'; 
                echo '<a href='.$pagename.'.php?change='.$rows[0].'>activer</a>'; 
            }; 
                            
            echo '<div class="account_link-element_views">'; 
                echo '<div class="icon"></div>'; 
                echo '<div class="number"> views ='; 
                    print_r($rows[5]); 
                echo '</div>';
            echo '</div>'; 
        echo '</div>'; 
    } 

}

?>