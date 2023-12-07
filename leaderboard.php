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

    function get_last_name_from_student_table($connection, $get_last_name_query){
        $student_id = 0;
        $result = mysqli_query($connection, $get_last_name_query);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Retrieve the student_id
                $row = mysqli_fetch_assoc($result);
                $name = $row['last_name'];
                return $name;
            } else {
                echo "No matching record found.";
            }
        }
    }

    function select_all_ids($conn){
        $studentIds = [];
        $query = "SELECT student_id FROM Students;";
        $result = mysqli_query($conn, $query);
        if ($result) {
            // Fetch each row and add student_id to the array
            while ($row = mysqli_fetch_assoc($result)) {
                $studentIds[] = $row['student_id'];
            }
            mysqli_free_result($result);
        } else {
            // Handle any errors here
            echo "Error: " . mysqli_error($conn);
        }
        return $studentIds;
    }

    function get_total_amount_correct($conn, $this_student_id) {
        $query = "SELECT SUM(has_been_correctly_answered) as total FROM Questions WHERE student_id='$this_student_id'";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            
            // Check if the 'total' field exists in the result
            if (isset($row['total'])) {
                $amount_correct = $row['total'];
                return $amount_correct;
            } else {
                echo "No matching record found.";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    function get_score($conn, $this_student_id) {
        $query = "SELECT score FROM Leaderboard WHERE student_id='$this_student_id'";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $score = $row['score'];
                return $score;
            } else {
                echo "No matching record found.";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    function get_grade_level($conn, $the_id){
        $query = "SELECT gradeLevel FROM Leaderboard WHERE student_id='$the_id'";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $gradeLevel = $row['gradeLevel'];
                return $gradeLevel;
            } else {
                echo "No matching record found.";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
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
            <a class="nav-link active" aria-current="page" href="https://turing.plymouth.edu/~lmc1076/leaderboard.php">Leaderboard</a>
            </li>
            <li class="nav-item" style="padding: 0px 10px;">
                <a href="https://turing.plymouth.edu/~lmc1076/user_progress.php" class="nav-link" aria-disabled="true">Go Home <i style="font-size:14px;" class="fa fa-home"></i></a>            
            </li>

            <li class="nav-item" style="padding: 0px 10px;">
                <?php
                    echo "<a href='' class='nav-link' aria-disabled='true'>Logged in as: <span style='color:green !important'>$user <i style='font-size:14px;' class='fas fa-user-check'></i></span></a>";
                ?>
            
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


<!-- Question Scoring System -->
<section>
    <div class="container">
        <div class="mt-2">
            <h5 class="top_heading_for_questions mt-3" style="color: green; font-weight: bold; text-shadow: 0 0 10px green, 0 0 20px green, 0 0 30px green; animation: glow 1s infinite alternate; margin-bottom: 15px;">Scoring System</h5>
            <h5 class="main_body"><span style="font-weight: bold;">>></span> Scores are based on 2 main things: Time taken to solve and amount of attempts required. So, the faster you solve the question, and less attempts you submit, will result in the best possible score for that question.</h5>
        </div>
    </div>
</section>

<!-- Goodluck -->
<section>
    <div class="container">
        <div class="mt-4">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> With that being said, it's like a game of golf, such that the 'lowest' score is the best. However, the amount of questions completed is also factored in. So, someone who successfully completes all 5 questions in <span class="character">n</span> attempts will always be ahead of the person who completes 4 questions in <span class="character">n-1</span> attempts... </h5>
        </div>
    </div>
</section>

<!-- Scoreboard! -->
<section>
    <div class="container">
        <div class="mt-2">
            <h5 class="top_heading_for_questions mt-4" style="color: green; font-weight: bold; text-shadow: 0 0 10px green, 0 0 20px green, 0 0 30px green; animation: glow 1s infinite alternate; margin-bottom: 15px;">Leaderboard</h5>
            <?php
                $user_score = get_score($conn, $id);
                echo "<h5 class='main_body'>Hello <span style='color:yellow'>$user</span>, you are currently have a score of: <span style='color:yellow'>$user_score</span>.</h5>";
                if($user_score == 0){
                    echo "<h5 class='main_body' style='font-size:15px;color:#E74C3C;'>You will appear on the scoreboard once you answer your first question correctly.</h5>";
                }
                $array = select_all_ids($conn);
                $array_of_five_correct = array();
                $array_of_four_correct = array();
                $array_of_three_correct = array();
                $array_of_two_correct = array();
                $array_of_one_correct = array();
                $array_of_zero_correct = array();
                for($x = 0; $x < count($array); $x++) { // put into corresponding hash-map
                    $student_id = $array[$x]; 
                    $amount_correct_for_this_student = get_total_amount_correct($conn, $student_id);
                    if($amount_correct_for_this_student == 5){
                        $array_of_five_correct[$student_id] = get_score($conn,$student_id);
                    }
                    elseif($amount_correct_for_this_student == 4){
                        $array_of_four_correct[$student_id] = get_score($conn,$student_id);
                    }
                    elseif($amount_correct_for_this_student == 3){
                        $array_of_three_correct[$student_id] = get_score($conn,$student_id);
                    }
                    elseif($amount_correct_for_this_student == 2){
                        $array_of_two_correct[$student_id] = get_score($conn,$student_id);
                    }
                    elseif($amount_correct_for_this_student == 1){
                        $array_of_one_correct[$student_id] = get_score($conn,$student_id);
                    }
                    elseif($amount_correct_for_this_student == 0){
                        $array_of_zero_correct[$student_id] = get_score($conn,$student_id);
                    }
                }

                $table_row_count = 0;

                asort($array_of_five_correct);
                asort($array_of_four_correct);
                asort($array_of_three_correct);
                asort($array_of_two_correct);
                asort($array_of_one_correct);
                asort($array_of_zero_correct);
                
                echo '<table class="table table-hover table-dark mt-4"';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">Position</th>';
                echo '<th scope="col">First Name</th>';
                echo '<th scope="col">Last Name</th>';
                echo '<th scope="col">Score</th>';
                echo '<th scope="col">Amount Correct</th>';
                echo '<th scope="col">Grade Level</th>';
                echo '</tr>';
                echo '</thead>';
                if(count(array_values($array_of_five_correct)) > 0){
                    foreach ($array_of_five_correct as $key => $value) {
                        $correct = get_total_amount_correct($conn, $key);
                        $user_grade_level = get_grade_level($conn,$key);
                        $get_first_name_query = "SELECT first_name FROM Students WHERE student_id='$key'";
                        $this_user = get_first_name_from_student_table($conn, $get_first_name_query);
                        $get_last_name_query = "SELECT last_name FROM Students WHERE student_id='$key'";
                        $this_user_last_name = get_last_name_from_student_table($conn, $get_last_name_query);
                        $score = get_score($conn, $key);
                        $table_row_count++;
                        if($table_row_count == 1){
                            $position = "1 " . "<i class='fa fa-trophy' style='color:orange'></i>";
                        }
                        else{
                            $position = $table_row_count;
                        }
                        if($key == $id){
                            echo '<tr>';
                            echo "<td style='color:yellow'>$position</td>";
                            echo "<td style='color:yellow'>$this_user</td>";
                            echo "<td style='color:yellow'>$this_user_last_name</td>";
                            echo "<td style='color:yellow'>$score</td>";
                            echo "<td style='color:yellow'>$correct</td>";
                            echo "<td style='color:yellow'>$user_grade_level</td>";
                            echo '</tr>';
                        }
                        else{
                            echo '<tr>';
                            echo "<td>$position</td>";
                            echo "<td>$this_user</td>";
                            echo "<td>$this_user_last_name</td>";
                            echo "<td>$score</td>";
                            echo "<td>$correct</td>";
                            echo "<td>$user_grade_level</td>";
                            echo '</tr>';
                        }
                    }
                }
                if(count(array_values($array_of_four_correct)) > 0){
                    foreach ($array_of_four_correct as $key => $value) {
                        $correct = get_total_amount_correct($conn, $key);
                        $user_grade_level = get_grade_level($conn,$key);
                        $get_first_name_query = "SELECT first_name FROM Students WHERE student_id='$key'";
                        $this_user = get_first_name_from_student_table($conn, $get_first_name_query);
                        $get_last_name_query = "SELECT last_name FROM Students WHERE student_id='$key'";
                        $this_user_last_name = get_last_name_from_student_table($conn, $get_last_name_query);
                        $score = get_score($conn, $key);
                        $table_row_count++;
                        if($table_row_count == 1){
                            $position = "1 " . "<i class='fa fa-trophy' style='color:orange'></i>";
                        }
                        else{
                            $position = $table_row_count;
                        }
                        if($key == $id){
                            echo '<tr>';
                            echo "<td style='color:yellow'>$position</td>";
                            echo "<td style='color:yellow'>$this_user</td>";
                            echo "<td style='color:yellow'>$this_user_last_name</td>";
                            echo "<td style='color:yellow'>$score</td>";
                            echo "<td style='color:yellow'>$correct</td>";
                            echo "<td style='color:yellow'>$user_grade_level</td>";
                            echo '</tr>';
                        }
                        else{
                            echo '<tr>';
                            echo "<td>$position</td>";
                            echo "<td>$this_user</td>";
                            echo "<td>$this_user_last_name</td>";
                            echo "<td>$score</td>";
                            echo "<td>$correct</td>";
                            echo "<td>$user_grade_level</td>";
                            echo '</tr>';
                        }
                    }
                }
                
                if(count(array_values($array_of_three_correct)) > 0){
                    foreach ($array_of_three_correct as $key => $value) {
                        $correct = get_total_amount_correct($conn, $key);
                        $user_grade_level = get_grade_level($conn,$key);
                        $get_first_name_query = "SELECT first_name FROM Students WHERE student_id='$key'";
                        $this_user = get_first_name_from_student_table($conn, $get_first_name_query);
                        $get_last_name_query = "SELECT last_name FROM Students WHERE student_id='$key'";
                        $this_user_last_name = get_last_name_from_student_table($conn, $get_last_name_query);
                        $score = get_score($conn, $key);
                        $table_row_count++;
                        if($table_row_count == 1){
                            $position = "1 " . "<i class='fa fa-trophy' style='color:orange'></i>";
                        }
                        else{
                            $position = $table_row_count;
                        }
                        if($key == $id){
                            echo '<tr>';
                            echo "<td style='color:yellow'>$position</td>";
                            echo "<td style='color:yellow'>$this_user</td>";
                            echo "<td style='color:yellow'>$this_user_last_name</td>";
                            echo "<td style='color:yellow'>$score</td>";
                            echo "<td style='color:yellow'>$correct</td>";
                            echo "<td style='color:yellow'>$user_grade_level</td>";
                            echo '</tr>';
                        }
                        else{
                            echo '<tr>';
                            echo "<td>$position</td>";
                            echo "<td>$this_user</td>";
                            echo "<td>$this_user_last_name</td>";
                            echo "<td>$score</td>";
                            echo "<td>$correct</td>";
                            echo "<td>$user_grade_level</td>";
                            echo '</tr>';
                        }
                    }
                }
                if(count(array_values($array_of_two_correct)) > 0){
                    foreach ($array_of_two_correct as $key => $value) {
                        $correct = get_total_amount_correct($conn, $key);
                        $user_grade_level = get_grade_level($conn,$key);
                        $get_first_name_query = "SELECT first_name FROM Students WHERE student_id='$key'";
                        $this_user = get_first_name_from_student_table($conn, $get_first_name_query);
                        $get_last_name_query = "SELECT last_name FROM Students WHERE student_id='$key'";
                        $this_user_last_name = get_last_name_from_student_table($conn, $get_last_name_query);
                        $score = get_score($conn, $key);
                        $table_row_count++;
                        if($table_row_count == 1){
                            $position = "1 " . "<i class='fa fa-trophy' style='color:orange'></i>";
                        }
                        else{
                            $position = $table_row_count;
                        }
                        if($key == $id){
                            echo '<tr>';
                            echo "<td style='color:yellow'>$position</td>";
                            echo "<td style='color:yellow'>$this_user</td>";
                            echo "<td style='color:yellow'>$this_user_last_name</td>";
                            echo "<td style='color:yellow'>$score</td>";
                            echo "<td style='color:yellow'>$correct</td>";
                            echo "<td style='color:yellow'>$user_grade_level</td>";
                            echo '</tr>';
                        }
                        else{
                            echo '<tr>';
                            echo "<td>$position</td>";
                            echo "<td>$this_user</td>";
                            echo "<td>$this_user_last_name</td>";
                            echo "<td>$score</td>";
                            echo "<td>$correct</td>";
                            echo "<td>$user_grade_level</td>";
                            echo '</tr>';
                        }
                    }
                }
                if(count(array_values($array_of_one_correct)) > 0){
                    foreach ($array_of_one_correct as $key => $value) {
                        $correct = get_total_amount_correct($conn, $key);
                        $user_grade_level = get_grade_level($conn,$key);
                        $get_first_name_query = "SELECT first_name FROM Students WHERE student_id='$key'";
                        $this_user = get_first_name_from_student_table($conn, $get_first_name_query);
                        $get_last_name_query = "SELECT last_name FROM Students WHERE student_id='$key'";
                        $this_user_last_name = get_last_name_from_student_table($conn, $get_last_name_query);
                        $score = get_score($conn, $key);
                        $table_row_count++;
                        if($table_row_count == 1){
                            $position = "1 " . "<i class='fa fa-trophy' style='color:orange'></i>";
                        }
                        else{
                            $position = $table_row_count;
                        }
                        if($key == $id){
                            echo '<tr>';
                            echo "<td style='color:yellow'>$position</td>";
                            echo "<td style='color:yellow'>$this_user</td>";
                            echo "<td style='color:yellow'>$this_user_last_name</td>";
                            echo "<td style='color:yellow'>$score</td>";
                            echo "<td style='color:yellow'>$correct</td>";
                            echo "<td style='color:yellow'>$user_grade_level</td>";
                            echo '</tr>';
                        }
                        else{
                            echo '<tr>';
                            echo "<td>$position</td>";
                            echo "<td>$this_user</td>";
                            echo "<td>$this_user_last_name</td>";
                            echo "<td>$score</td>";
                            echo "<td>$correct</td>";
                            echo "<td>$user_grade_level</td>";
                            echo '</tr>';
                        }
                    }
                }
                echo '</table>';
                
            ?>
        </div>
    </div>
</section>


<section>
    <div class="mt-5" style="padding-top: 150px;">
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