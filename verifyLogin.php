<?php

function makeConnection($server, $user, $pass, $db){
    $conn = new mysqli($server, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection to the database has failed.");
    }
    else{
        return $conn;
    }

}

function get_student_id_from_student_table($connection, $get_student_id_query){
    $student_id = 0;
    $result = mysqli_query($connection, $get_student_id_query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Retrieve the student_id
            $row = mysqli_fetch_assoc($result);
            $student_id = $row['student_id'];
            return $student_id;
        } else {
            echo "<h5 style='color:#E74C3C' class='mt-4 mb-4'>There was an error while trying to access your account - did you use the correct credentials?</h5>";
        }
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST["fName"] != "" && $_POST["lName"] != "" && $_POST["password"] != ""){ // make sure that the information is filled out
        
        // get the information
        $error_messgage = 0;
        $firstname = $_POST["fName"];
        $lastname = $_POST["lName"];
        $password = $_POST["password"];
        $hashed_password = hash('sha256', $password);

        // write the query
        $get_student_id_query = "SELECT student_id FROM Students WHERE first_name = '$firstname' AND last_name = '$lastname' AND password = '$hashed_password'";

        // include the file that contains the password [you can probably leave this blank]
        include("/home/lmc1076/PHP-Includes/phpbook-vars.inc");

        // call the function that makes the connection
        $conn = makeConnection("turing","lmc1076", $my_db_password, "Team2");

        // get the primary key from the row
        $id = get_student_id_from_student_table($conn, $get_student_id_query);


        // start the session
        session_start();
        $_SESSION['student_id'] = $id;

        // redirect them to a file location
        header("Location: https://turing.plymouth.edu/~lmc1076/user_progress.php");
        exit;


    }

    else{
        header("Location: https://turing.plymouth.edu/~lmc1076/error.php");
        exit;
    }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Ethical Hacking Club</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>
<body>

<!-- NAV BAR -->
<section>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark" style="background-color: transparent!important;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ethical Hacking Club</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">About</a>
            </li>
            <li class="nav-item">
            <!-- <a class="nav-link" href="#">The contest</a> -->
            <a class="nav-link" aria-disabled="true">The contest</a>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="#">The contest</a> -->
                <a class="nav-link disabled" aria-disabled="true">Events</a>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="#">The contest</a> -->
                <a class="nav-link disabled" aria-disabled="true">Guest Speakers</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Login
            </a>
            <ul class="dropdown-menu">
                <a class="nav-link" aria-disabled="true">Login</a>
                <li><hr class="dropdown-divider"></li>
                <a class="nav-link" aria-disabled="true">Create Account</a>
            </ul>
            </li>
            <!-- <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li> -->
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>
</section>

<div class="container">


</div>
</body>
</html>