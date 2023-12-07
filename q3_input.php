<?php
    session_start(); // Start the session to access session data

    // Check if the session variable is set
    if (isset($_SESSION['student_id'])) {
        $id = $_SESSION['student_id']; // Access the session variable
        $conn = makeConnection("turing", "lmc1076", "viewnine", "Team2");
        $three = 3;
        $get_q1_puzzle_input = "SELECT randomly_generated_input FROM Questions WHERE student_id='$id' AND question_number='$three'";
        $q1_string = get_puzzle_input($conn, $get_q1_puzzle_input);
        echo "<title>Question 3 input</title>";

        echo $q1_string;
    } else {
        header("Location: https://turing.plymouth.edu/~lmc1076/error.php");
        session_destroy();
        exit;
        // The session variable is not set; handle the case when the user didn't go through the proper flow.
    }
    function makeConnection($server, $user, $pass, $db){
        $conn = new mysqli($server, $user, $pass, $db);
        if ($conn->connect_error) {
            die("Connection to the database has failed.");
        }
        else{
            return $conn;
        }

    }

    function get_puzzle_input($connection, $get_input_query){
        $student_id = 0;
        $result = mysqli_query($connection, $get_input_query);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Retrieve the student_id
                $row = mysqli_fetch_assoc($result);
                $input = $row['randomly_generated_input'];
                return $input;
            } else {
                echo "No matching record found.";
            }
        }
    }
?>

