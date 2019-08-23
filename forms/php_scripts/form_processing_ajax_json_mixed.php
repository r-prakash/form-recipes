<?php

//var_dump($_POST);

if (isset($_POST['register'])) {
    $errors = array(); //To store errors
    $form_data = array(); //Pass back the data

    //file_put_contents('php://stderr', print_r("Reached Here!!\n", TRUE));

/*
    // Takes raw data from the request
    $json = file_get_contents('php://input');

    file_put_contents('php://stderr', print_r($json, TRUE)); 

    $data = json_decode($json);

    file_put_contents('php://stderr', print_r($data, TRUE)); 

    // Fetching variables of the form which travels in URL
    $f_name = $data->first_name;
    $l_name = $data->last_name;
    $sex = $data->sex;
    $email = $data->email;
    $phone = $data->phone;

    // var_dump($phone);
*/

    $user_details = $_POST['user_details'];

    $data = json_decode($user_details);

    file_put_contents('php://stderr', print_r($data, TRUE));

    $f_name = $data->first_name;
    $l_name = $data->last_name;
    $sex = $data->sex;
    $email = $data->email;
    $phone = $data->phone; 

    if ($f_name == '') {
        array_push($errors, "First Name Can not be blank.");
    }

    if ($email == '') {
        array_push($errors, "Email Can not be blank.");
    }

    //file_put_contents('php://stderr', print_r($errors, TRUE));

    if (!empty($errors)) { //If errors in validation
        $form_data['success'] = false;
        $form_data['errors']  = $errors;

        //file_put_contents('php://stderr', print_r($form_data, TRUE));

        //Return the data back
        $output = json_encode($form_data);

        //file_put_contents('php://stderr', print_r($output, TRUE));

        echo $output;
        exit;
    }
    else {
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
        // header("Location:http://demowebsite.com:8888/forms/thank-you.html");

        $form_data['success'] = true;
        $form_data['message'] = 'Data Was Posted Successfully'; 
    }
    else {
        // ?><span><?php echo "Please fill all fields.....!!!!!!!!!!!!";?></span> <?php
     //   redirect('/forms/error.html');
        //header("Location:http://demowebsite.com:8888/forms/error.html");
    }

    //file_put_contents('php://stderr', print_r($form_data, TRUE)); 

    //Return the data back
    echo json_encode($form_data);
    exit;
    }
}
?>
