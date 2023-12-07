<?php
    session_start(); // Start the session to access session data

    // Check if the session variable is set
    if (isset($_SESSION['student_id'])) {
        $id = $_SESSION['student_id']; // Access the session variable
        include("/home/lmc1076/PHP-Includes/phpbook-vars.inc");
        $conn = makeConnection("turing","lmc1076", $my_db_password, "Team2");
        $get_first_name_query = "SELECT first_name FROM Students WHERE student_id='$id'";
        $user = get_first_name_from_student_table($conn, $get_first_name_query);
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

    function get_first_name_from_student_table($connection, $get_first_name_query){
        $student_id = 0;
        $result = mysqli_query($connection, $get_first_name_query);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Retrieve the student_id
                $row = mysqli_fetch_assoc($result);
                $name = $row['first_name'];
                return $name;
            } else {
                echo "No matching record found.";
            }
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
            <a class="nav-link" aria-current="page" href="https://turing.plymouth.edu/~lmc1076/leaderboard.php">Leaderboard</a>
            </li>
            <li class="nav-item">
            <!-- <a class="nav-link" href="#">The contest</a> -->
            <a class="nav-link active" aria-disabled="true">Home</a>
            </li>

            <li class="nav-item" style="padding: 0px 15px;">
                <?php
                    echo "<a href='' class='nav-link' aria-disabled='true'>Logged in as: <span style='color:green !important'>$user <i style='font-size:14px;' class='fas fa-user-check'></i></span></a>";
                ?>
            
            </li>

            <li class="nav-item">
            <a href="logout.php" class="nav-link" aria-disabled="true">Logout <i style="font-size:14px;" class="fa fa-power-off"></i></a>
            </li>

        </ul>
        <!-- <form class="d-flex" role="search">
        </form> -->
        </div>
    </div>
    </nav>
</section>

<!-- Automatic Typing -->
<section>
    <div class="container">
        <div class="mt-5">
            <div class="typing-container">
                <p>
                    <span style="color: green;" id="constant-text">Welcome to the Contest - </span>
                    <span style="color: yellow;" id="constant-text"> Click on keys to go to the puzzles!</span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Introduction to the conest -->
<section>
    <div class="container">
        <div class="mt-2">

            <?php
                function get_amount_user_has_correct($connection, $get_amount_correct_query){
                    $result = mysqli_query($connection, $get_amount_correct_query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $amount_correct = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Print the values in each row
                                if($row['has_been_correctly_answered'] != 0){
                                    $amount_correct++;
                                }
                            }
                            return $amount_correct;
                        } else {
                            echo "No matching record found.";
                        }
                    }
                }

                function get_question_if_correct($connection, $get_question_query){
                    $result = mysqli_query($connection, $get_question_query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $question_answer = $row['has_been_correctly_answered'];
                            return $question_answer;
                        } else {
                            echo "No matching record found.";
                        }
                    }
                }

                function q1_amount_of_attempts_query($connection, $q1_attempts_query){
                    $result = mysqli_query($connection, $q1_attempts_query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $question_answer = $row['attempts'];
                            return $question_answer;
                        } else {
                            echo "No matching record found.";
                        }
                    }
                }

                function q1_amount_of_seconds($connection, $q1_seconds_query){
                    $result = mysqli_query($connection, $q1_seconds_query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $time = $row['total_time_taken'];
                            return $time;
                        } else {
                            echo "No matching record found.";
                        }
                    }
                }

                function q2_amount_of_attempts_query($connection, $q1_attempts_query){
                    $result = mysqli_query($connection, $q1_attempts_query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $question_answer = $row['attempts'];
                            return $question_answer;
                        } else {
                            echo "No matching record found.";
                        }
                    }
                }

                function q2_amount_of_seconds($connection, $q1_seconds_query){
                    $result = mysqli_query($connection, $q1_seconds_query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $time = $row['total_time_taken'];
                            return $time;
                        } else {
                            echo "No matching record found.";
                        }
                    }
                }

                function q3_amount_of_attempts_query($connection, $q1_attempts_query){
                    $result = mysqli_query($connection, $q1_attempts_query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $question_answer = $row['attempts'];
                            return $question_answer;
                        } else {
                            echo "No matching record found.";
                        }
                    }
                }

                function q3_amount_of_seconds($connection, $q1_seconds_query){
                    $result = mysqli_query($connection, $q1_seconds_query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $time = $row['total_time_taken'];
                            return $time;
                        } else {
                            echo "No matching record found.";
                        }
                    }
                }

                function q4_amount_of_attempts_query($connection, $q1_attempts_query){
                    $result = mysqli_query($connection, $q1_attempts_query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $question_answer = $row['attempts'];
                            return $question_answer;
                        } else {
                            echo "No matching record found.";
                        }
                    }
                }

                function q4_amount_of_seconds($connection, $q1_seconds_query){
                    $result = mysqli_query($connection, $q1_seconds_query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $time = $row['total_time_taken'];
                            return $time;
                        } else {
                            echo "No matching record found.";
                        }
                    }
                }

                function q5_amount_of_attempts_query($connection, $q1_attempts_query){
                    $result = mysqli_query($connection, $q1_attempts_query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $question_answer = $row['attempts'];
                            return $question_answer;
                        } else {
                            echo "No matching record found.";
                        }
                    }
                }

                function q5_amount_of_seconds($connection, $q1_seconds_query){
                    $result = mysqli_query($connection, $q1_seconds_query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $time = $row['total_time_taken'];
                            return $time;
                        } else {
                            echo "No matching record found.";
                        }
                    }
                }

                $get_amount_correct_query = "SELECT has_been_correctly_answered FROM Questions WHERE student_id='$id'";
                $amount_correct = get_amount_user_has_correct($conn, $get_amount_correct_query);
                $one = 1;
                $two = 2;
                $three = 3;
                $four = 4;
                $five = 5;

                // question 1 stuff
                $q1_query = "SELECT has_been_correctly_answered FROM Questions WHERE student_id='$id' AND question_number='$one'";
                $q1_result = get_question_if_correct($conn, $q1_query);
                $q1_amount_of_attempts_query = "SELECT attempts FROM Questions WHERE student_id='$id' AND question_number='$one'";
                $q1_attempts = q1_amount_of_attempts_query($conn, $q1_amount_of_attempts_query);
                $q1_amount_of_attempts_query = "SELECT total_time_taken FROM Questions WHERE student_id='$id' AND question_number='$one'";
                $q1_seconds = q1_amount_of_seconds($conn, $q1_amount_of_attempts_query);

                // question 2 stuff
                $q2_query = "SELECT has_been_correctly_answered FROM Questions WHERE student_id='$id' AND question_number='$two'";
                $q2_result = get_question_if_correct($conn, $q2_query);
                $q2_amount_of_attempts_query = "SELECT attempts FROM Questions WHERE student_id='$id' AND question_number='$two'";
                $q2_attempts = q2_amount_of_attempts_query($conn, $q2_amount_of_attempts_query);
                $q2_amount_of_attempts_query = "SELECT total_time_taken FROM Questions WHERE student_id='$id' AND question_number='$two'";
                $q2_seconds = q2_amount_of_seconds($conn, $q2_amount_of_attempts_query);

                // quesiton 3 stuff
                $q3_query = "SELECT has_been_correctly_answered FROM Questions WHERE student_id='$id' AND question_number='$three'";
                $q3_result = get_question_if_correct($conn, $q3_query);
                $q3_amount_of_attempts_query = "SELECT attempts FROM Questions WHERE student_id='$id' AND question_number='$three'";
                $q3_attempts = q3_amount_of_attempts_query($conn, $q3_amount_of_attempts_query);
                $q3_amount_of_attempts_query = "SELECT total_time_taken FROM Questions WHERE student_id='$id' AND question_number='$three'";
                $q3_seconds = q3_amount_of_seconds($conn, $q3_amount_of_attempts_query);

                // quesiton 4 stuff
                $q4_query = "SELECT has_been_correctly_answered FROM Questions WHERE student_id='$id' AND question_number='$four'";
                $q4_result = get_question_if_correct($conn, $q4_query);
                $q4_amount_of_attempts_query = "SELECT attempts FROM Questions WHERE student_id='$id' AND question_number='$four'";
                $q4_attempts = q4_amount_of_attempts_query($conn, $q4_amount_of_attempts_query);
                $q4_amount_of_attempts_query = "SELECT total_time_taken FROM Questions WHERE student_id='$id' AND question_number='$four'";
                $q4_seconds = q4_amount_of_seconds($conn, $q4_amount_of_attempts_query);

                // quesiton 5 stuff
                $q5_query = "SELECT has_been_correctly_answered FROM Questions WHERE student_id='$id' AND question_number='$five'";
                $q5_result = get_question_if_correct($conn, $q5_query);
                $q5_amount_of_attempts_query = "SELECT attempts FROM Questions WHERE student_id='$id' AND question_number='$five'";
                $q5_attempts = q5_amount_of_attempts_query($conn, $q5_amount_of_attempts_query);
                $q5_amount_of_attempts_query = "SELECT total_time_taken FROM Questions WHERE student_id='$id' AND question_number='$five'";
                $q5_seconds = q5_amount_of_seconds($conn, $q5_amount_of_attempts_query);

                //echo "<h5 class='top_heading_for_questions' style='color: green; font-weight: bold; text-shadow: 0 0 10px green, 0 0 20px green, 0 0 30px green; animation: glow 1s infinite alternate; margin-bottom: 15px;'>$user has unlocked $amount_correct out of 5 keys - click on the keys to go to the puzzles!</h5>";
                echo "<h6 style='color: green; margin-bottom: 15px;'>Be <span style='text-decoration:underline !important; font-weight:bold;'>warned</span> - upon clicking the question, the timer will start.</h6>";

                echo "<div class='row' style='color: aliceblue;'>";
                if($q1_result == 0){ // wrong
                    echo "<div class='col text-center'><a href='https://turing.plymouth.edu/~lmc1076/question1.php' style='text-decoration:none;'><div class='key_background mt-4 mb-4 rounded-3'><h4 style='color:yellow'>Key 1</h4><i class='fa fa-key' style='font-size:48px;'></i><h4>Locked</h4></div></a></div>";
                }
                elseif($q1_result == 1){ // correct
                    echo "<div class='col text-center'><div class='mt-4 mb-4 rounded-3' style='background-color: #051036'><h4 style='color:yellow'>Key 1</h4><i class='fa fa-key' style='font-size:48px;color:#D4D40E;'></i><h5 style='color:green;'>Unlocked with $q1_attempts attempt(s) in $q1_seconds seconds.</h5></div></div>";
                }
                if($q2_result == 0){
                    echo "<div class='col text-center'><a href='https://turing.plymouth.edu/~lmc1076/question2.php' style='text-decoration:none;'><div class='key_background mt-4 mb-4 rounded-3'><h4 style='color:yellow'>Key 2</h4><i class='fa fa-key' style='font-size:48px;'></i><h4>Locked</h4></div></a></div>";
                }
                elseif($q2_result == 1){
                    echo "<div class='col text-center'><div class='mt-4 mb-4 rounded-3' style='background-color: #051036'><h4 style='color:yellow'>Key 2</h4><i class='fa fa-key' style='font-size:48px;color:#D4D40E;'></i><h5 style='color:green;'>Unlocked with $q2_attempts attempt(s) in $q2_seconds seconds.</h5></div></div>";
                }
                if($q3_result == 0){
                    echo "<div class='col text-center'><a href='https://turing.plymouth.edu/~lmc1076/question3.php' style='text-decoration:none;'><div class='key_background mt-4 mb-4 rounded-3'><h4 style='color:yellow'>Key 3</h4><i class='fa fa-key' style='font-size:48px;'></i><h4>Locked</h4></div></a></div>";
                }
                elseif($q3_result == 1){
                    echo "<div class='col text-center'><div class='mt-4 mb-4 rounded-3' style='background-color: #051036'><h4 style='color:yellow'>Key 3</h4><i class='fa fa-key' style='font-size:48px;color:#D4D40E;'></i><h5 style='color:green;'>Unlocked with $q3_attempts attempt(s) in $q3_seconds seconds.</h5></div></div>";
                }
                if($q4_result == 0){
                    echo "<div class='col text-center'><a href='https://turing.plymouth.edu/~lmc1076/question4.php' style='text-decoration:none;'><div class='key_background mt-4 mb-4 rounded-3'><h4 style='color:yellow'>Key 4</h4><i class='fa fa-key' style='font-size:48px;'></i><h4>Locked</h4></div></a></div>";
                }
                elseif($q4_result == 1){
                    echo "<div class='col text-center'><div class='mt-4 mb-4 rounded-3' style='background-color: #051036'><h4 style='color:yellow'>Key 4</h4><i class='fa fa-key' style='font-size:48px;color:#D4D40E;'></i><h5 style='color:green;'>Unlocked with $q4_attempts attempt(s) in $q4_seconds seconds.</h5></div></div>";
                }

                if($q5_result == 0){
                    echo "<div class='col text-center'><a href='https://turing.plymouth.edu/~lmc1076/question5.php' style='text-decoration:none;'><div class='key_background mt-4 mb-4 rounded-3'><h4 style='color:yellow'>Key 5</h4><i class='fa fa-key' style='font-size:48px;'></i><h4>Locked</h4></div></a></div>";
                }
                elseif($q5_result == 1){
                    echo "<div class='col text-center'><div class='mt-4 mb-4 rounded-3' style='background-color: #051036'><h4 style='color:yellow'>Key 5</h4><i class='fa fa-key' style='font-size:48px;color:#D4D40E;'></i><h5 style='color:green;'>Unlocked with $q5_attempts attempt(s) in $q5_seconds seconds.</h5></div></div>";
                }
                
                // echo "<div class='col text-center'><div class='key_background mt-4 mb-4 rounded-3'><h4 style='color:yellow'>Key 3</h4><i class='fa fa-key' style='font-size:48px;'></i><h4>Locked</h4></div></div>";
                //echo "<div class='col text-center'><a href='https://turing.plymouth.edu/~lmc1076/question4.php' style='text-decoration:none;'><div class='key_background mt-4 mb-4 rounded-3'><h4 style='color:yellow'>Key 4</h4><i class='fa fa-key' style='font-size:48px;'></i><h4>Locked</h4></div></a></div>";
                // echo "<div class='col text-center'><a href='https://turing.plymouth.edu/~lmc1076/question5.php' style='text-decoration:none;'><div class='key_background mt-4 mb-4 rounded-3'><h4 style='color:yellow'>Key 5</h4><i class='fa fa-key' style='font-size:48px;'></i><h4>Locked</h4></div></a></div>";

                echo "</div>";

                if($q1_result == 1 && $q2_result == 1 && $q3_result == 1 && $q4_result == 1 && $q5_result == 1){ // all done
                    echo "<div class='alert alert-success mt-5' role='alert' style='background-color:black !important; color:green !important; border-color:green !important;'><h4 class='alert-heading' style='font-weight:bold !important'>Well done, $user!</h4><p>Wow, you successfully answered all 5 questions. Captain Cypher is very happy with your performance! </p><hr><p class='mb-0'>Go to the <a href='https://turing.plymouth.edu/~lmc1076/leaderboard.php' style='color:yellow'>Leaderboard</a> to see how you placed against other participants.</p></div>";
                }
                else{ // still has more to do
                    echo "<h5 class='main_body mt-5'><span style='font-weight: bold;'>>></span> Captain Cypher needs all 5 keys, get going!</h5>";
                }

            ?>

        </div>
    </div>
</section>



<!-- Footer -->
<section>
    <div class="mt-5" style="padding-top: 200px;">
        <div class="footer-basic">
            <footer>
                <div class="social">
                    <a href="https://discord.gg/KM7E9SUbU3" target="_blank"><i style="color: white;" class="fa-brands fa-discord"></i></a>     
                    <a href="mailto:jmtrue@plymouth.edu" target="_blank"><i style="color: white;" class="fas fa-envelope"></i></a>     
                </div>
                <p class="copyright">Made with <i style="color: red;" class="fa-solid fa-heart"></i> by: Leo Carten, David Albert, Matt Wagner, and Abraham Abrams</p>
                
            </footer>
        </div>
    </div>
</section>

</body>
</html>
