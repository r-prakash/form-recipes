<?php

var_dump($_POST);

if (isset($_POST['register'])) {
    // Fetching variables of the form which travels in URL
    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    var_dump($phone);

    if ($f_name != '' && $l_name != '' && $sex != '' && $email != '' && $phone != '') {
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dbname = "USERDB";

        // Create connection
        $mysqli = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        /* Prepare an insert statement */ 
        $insert_query = "INSERT INTO Users (firstname, lastname, gender, email, phone) VALUES ( ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($insert_query);
        
        /* Bind the parameters */
        $stmt->bind_param("sssss", $f_name, $l_name, $sex, $email, $phone);

        /* Execute the statement */
        $stmt->execute();

        /* close statement */
        $stmt->close();

        /* close connection */
        $mysqli->close();

        // To redirect form on a particular page
        // redirect('/forms/thank-you.html');

        //  To redirect form on a particular page
        header("Location:/forms/thank-you.html");
    }
    else {
        ?><span><?php echo "Please fill all fields.....!!!!!!!!!!!!";?></span> <?php
     //   redirect('/forms/error.html');
        header("Location:http://demowebsite.com:8888/forms/error.html");
    }
}
?>
