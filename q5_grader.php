<?php
    session_start(); // Start the session to access session data

    // Check if the session variable is set
    if (isset($_SESSION['student_id'])) {
        $id = $_SESSION['student_id']; // Access the session variable
        include("/home/lmc1076/PHP-Includes/phpbook-vars.inc");
        $conn = makeConnection("turing","lmc1076", $my_db_password, "Team2");
        $five = 5;
        $get_first_name_query = "SELECT first_name FROM Students WHERE student_id='$id'";
        $user = get_first_name_from_student_table($conn, $get_first_name_query);
        $q1_answer_query = "SELECT answer FROM Questions WHERE student_id='$id' AND question_number='$five'";
        $q1_answer = get_answer($conn, $q1_answer_query);
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

    function get_answer($connection, $get_answer_query){
        $student_id = 0;
        $result = mysqli_query($connection, $get_answer_query);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Retrieve the student_id
                $row = mysqli_fetch_assoc($result);
                $answer = $row['answer'];
                return $answer;
            } else {
                echo "No matching record found.";
            }
        }
    }

    function update_attempts($connection, $update_query){
        $result = mysqli_query($connection, $update_query);
    }

    function update_has_been_correctly_answered($connection, $update){
        $result = mysqli_query($connection, $update);
    }

    function see_if_timer_has_been_started($connection, $get_start_at_query1){
        $result = mysqli_query($connection, $get_start_at_query1);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Retrieve the student_id
                $row = mysqli_fetch_assoc($result);
                $name = $row['question_finished_at'];
                if(isZeroTimestamp($name)) {
                    return 1;
                } 
                else {
                    return 0;
                }
            } 
        }

    }

    function isZeroTimestamp($timestamp) {
        return $timestamp === '0000-00-00 00:00:00';
    }

    function calculateTimeDuration($timestamp1, $timestamp2) {
        // Parse the timestamps as strings to ensure they are in the expected format
        $time1 = strtotime($timestamp1);
        $time2 = strtotime($timestamp2);
    
        // Calculate the time duration in seconds
        $duration = abs($time1 - $time2);
    
        return $duration;
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
            <!-- <a class="nav-link" href="#">The contest</a> -->
            <a class="nav-link active" aria-disabled="true">Question 5</a>
            </li>

            <li class="nav-item" style="padding: 0px 10px;">
                <?php
                    echo "<a href='' class='nav-link' aria-disabled='true'>Logged in as: <span style='color:green !important'>$user <i style='font-size:14px;' class='fas fa-user-check'></i></span></a>";
                ?>
            
            </li>

            <li class="nav-item" style="padding: 0px 10px;">
                <a href="https://turing.plymouth.edu/~lmc1076/user_progress.php" class="nav-link" aria-disabled="true">Go Home <i style="font-size:14px;" class="fa fa-home"></i></a>            
            </li>

            <li class="nav-item" style="padding: 0px 10px;">
            <a href="logout.php" class="nav-link" aria-disabled="true">Logout <i style="font-size:14px;" class="fa fa-power-off"></i></a>
            </li>





        </ul>
        <!-- <form class="d-flex" role="search">
        </form> -->
        </div>
    </div>
    </nav>
</section>

<section>
    <div class="container">
        <?php
            if (isset($_POST["treasureDepth_q3"])) {
                $userSubmission = $_POST["treasureDepth_q3"];
                if($q1_answer == $userSubmission){ // question was answered correctly
                    $five = 5;
                    $finished_at_query = "SELECT question_finished_at FROM Questions WHERE student_id='$id' AND question_number='$five'";

                    if (see_if_timer_has_been_started($conn, $finished_at_query) == 1) { 
                        // We need to insert a timer
                        $access_q1_at = date('Y-m-d H:i:s', time());
                    
                        // First, update the finished timestamp
                        $update_time_query = "UPDATE Questions SET question_finished_at = '$access_q1_at' WHERE student_id='$id' AND question_number='$five'";
                        $result_update = mysqli_query($conn, $update_time_query);
                    
                        if ($result_update) {
                            // Fetch the start and finish timestamps
                            $started_at_result = mysqli_query($conn, "SELECT question_start_at FROM Questions WHERE student_id='$id' AND question_number='$five'");
                            $finished_at_result = mysqli_query($conn, "SELECT question_finished_at FROM Questions WHERE student_id='$id' AND question_number='$five'");
                    
                            $start_row = mysqli_fetch_assoc($started_at_result);
                            $finish_row = mysqli_fetch_assoc($finished_at_result);
                    
                            // Make sure to use the appropriate column names from your database
                            $start_val = $start_row['question_start_at'];
                            $finish_val = $finish_row['question_finished_at'];
                    
                            $total_time = calculateTimeDuration($start_val, $finish_val);
                    
                            // Now update the total_time_taken column
                            $update_total_time_query = "UPDATE Questions SET total_time_taken = '$total_time' WHERE student_id='$id' AND question_number='$five'";
                            $result_total_time_update = mysqli_query($conn, $update_total_time_query);

                            // Fetch the current number of attempts from the database
                            $current_amount_of_attempts_query = "SELECT attempts FROM Questions WHERE student_id='$id' and question_number='$five'";
                            $current_amount_of_attempts_result = mysqli_query($conn, $current_amount_of_attempts_query);
                            $current_amount_of_attempts_row = mysqli_fetch_assoc($current_amount_of_attempts_result);
                            $current_amount_of_attempts = (int)$current_amount_of_attempts_row['attempts'] + 1;

                            // Fetch the current score from the database
                            $get_current_score_query = "SELECT score FROM Leaderboard WHERE student_id='$id'";
                            $get_current_score_result = mysqli_query($conn, $get_current_score_query);
                            $get_current_score_row = mysqli_fetch_assoc($get_current_score_result);
                            $current_score = (int)$get_current_score_row['score'];

                            // Perform the arithmetic operations
                            $new_score = $current_score + $total_time + ($current_amount_of_attempts * 60);

                            // Update the score in the database
                            $update_score_query = "UPDATE Leaderboard SET score = '$new_score' WHERE student_id='$id'";
                            $update_score_command = mysqli_query($conn, $update_score_query);

                            // Close the database connections and handle any potential errors.

                    
                            if (!$result_total_time_update) {
                                echo "Total time update failed: " . mysqli_error($conn);
                            }
                        } else {
                            echo "Update finished timestamp failed: " . mysqli_error($conn);
                        }
                    }
                

                    $update_db_query = "UPDATE Questions SET attempts=attempts+1 WHERE student_id='$id' AND question_number='$five'";
                    $update_correctly_answered_query = "UPDATE Questions SET has_been_correctly_answered=1 WHERE student_id='$id' AND question_number='$five'";
                    update_attempts($conn, $update_db_query);
                    update_has_been_correctly_answered($conn, $update_correctly_answered_query);
                    echo "<i class='fa fa-check-circle d-flex justify-content-center' style='font-size:80px; color:green;padding-top:60px;'></i>";
                    echo "<h3 class='main_body mt-3 d-flex justify-content-center'><span style='font-weight: bold;'>You unlocked another key - congrats!</span></h3>";
                    echo "<div><a href='https://turing.plymouth.edu/~lmc1076/user_progress.php' style='color:yellow; text-decoration:none;'><h5 class='main_body mt-3 d-flex justify-content-center'><span style='font-weight: bold;color:yellow;font-size:25px;'><i class='fa fa-arrow-circle-left'></i> <span style='text-decoration:underline'>Go back</span> to questions page.</span></h5></a></div>";
                }
                elseif(isset($_POST["treasureDepth_q3"]) && strlen($_POST["treasureDepth_q3"]) > 20){
                    echo "<h5 class='main_body' style='padding-top:30px;'>Hmmm, your answer was longer than 20 characters, that's fishy. Your account is now being monitored - big brother is watching. Please go back and <a href='https://turing.plymouth.edu/~lmc1076/question5.php' style='color:yellow'>try again</a> with a real input.</h5>";
                    $update_db_query = "UPDATE Questions SET attempts=attempts+1 WHERE student_id='$id' AND question_number='$five'";
                    update_attempts($conn, $update_db_query);
                }
                else{
                    $update_db_query = "UPDATE Questions SET attempts=attempts+1 WHERE student_id='$id' AND question_number='$five'";
                    update_attempts($conn, $update_db_query);
                    echo "<h5 class='main_body' style='padding-top:30px;'>Your answer of $userSubmission was incorrect, please go back and <a href='https://turing.plymouth.edu/~lmc1076/question5.php' style='color:yellow'>try again.</a></h5>";
                }
            } else {
                echo "Did you provide an input?";
            }
            
        ?>
    </div>
</section>


</body>