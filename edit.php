<?php
session_start();

if (isset($_POST['submit']) && $_POST['submit'] != '') {
    // destroying sessio first
    if (isset($_SESSION['errorsArray']))
        unset($_SESSION['errorsArray']);

    //require database connection
    require_once 'db.php';

    

    $errors = array(); // empty errors array
    if (isset($_POST['first_name']) && empty(trim($_POST['first_name']))) {
        array_push($errors, 'First Name is required!');
        
    }

    

    if (isset($_POST['last_name']) && empty(trim($_POST['last_name']))) {
        array_push($errors, 'Last Name is required!');
    }

    if (isset($_POST['gender']) && empty(trim($_POST['gender']))) {
        array_push($errors, 'Gender is required!');
    }

    if (isset($_POST['email']) && empty(trim($_POST['email']))) {
        array_push($errors, 'Email is required!');
    }

    if (isset($_POST['branch']) && empty(trim($_POST['branch']))) {
        array_push($errors, 'Branch is required!');
    }

    if (isset($_POST['email']) && !empty(trim($_POST['email']))) {
        $email = trim($_POST['email']);

        // Getting current email
        $userEmailQuery = "SELECT email as userEmail FROM students WHERE id=" . $_POST['student_id'] . " LIMIT 1";
        if($result = $conn->query($userEmailQuery)){
            while($row = $result->fetch_assoc()){

            }
            $result->free();
        }
        

        // Checking if current email is same as entered email (Letting update here))
        if ($email!= $row['userEmail']) {
            $emailQuery = "SELECT COUNT(id) as emailCount FROM students WHERE email='" . $email . "'";
            // " . trim($_POST['email']) . " LIMIT 1'
            $result = $conn->query($emailQuery);
            $row = $result->fetch_assoc();

            if ($row['emailCount'] > 0) {
                array_push($errors, 'Email must be Unique!');
            }
       
       
        }

        

    }
    // print_r($errors);
    // echo count($errors);
    if (count($errors) > 0) {
        $_SESSION['errorsArray'] = $errors; // Creating session variable
        header("Location:add.php?id=" . $_POST['student_id']); // redirecting
    } else {

        $first_name = (!empty($_POST['first_name'])) ? $_POST['first_name'] : "";
        $last_name = (!empty($_POST['last_name'])) ? $_POST['last_name'] : "";
        $upload_image = (!empty($_POST['upload_image'])) ? $_POST['upload_image'] : "";
        $gender = (!empty($_POST['gender'])) ? $_POST['gender'] : "";   
        $email = (!empty($_POST['email'])) ? $_POST['email'] : "";
        $branch = (!empty($_POST['branch'])) ? $_POST['branch'] : "";
        $id = (!empty($_POST['student_id'])) ? $_POST['student_id'] : "";

        if (!empty($id)) {
            //update record
            $stud_query = "UPDATE students SET first_name='" . $first_name . "' , last_name='" . $last_name . "' , upload_image= '".$upload_image."' , gender='" . $gender . "', email='" . $email . "', branch ='" . $branch . "' WHERE id ='" . $id . "'";
            $msg = "Update";
        } else {
            //insert the new record
            $stud_query = "INSERT INTO students (first_name, last_name, upload_image , gender ,email,branch) VALUES ('$first_name', '$last_name', '$upload_image','$gender','$email','$branch')";
            $msg = "add";
        }




        if ($conn->query($stud_query) === TRUE) {
            header('location:index.php?msg=' . $msg);
        } else {
            echo "Error: " . $stud_query . "<br>" . $conn->error;
        }
    }
}