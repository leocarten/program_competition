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
        // $student_id = 0;
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

    function see_if_timer_has_been_started($connection, $get_start_at_query1){
        $result = mysqli_query($connection, $get_start_at_query1);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Retrieve the student_id
                $row = mysqli_fetch_assoc($result);
                $name = $row['question_start_at'];
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

    // see if we need to start a timer
    $four = 4;
    $start_at_query = "SELECT question_start_at FROM Questions WHERE student_id='$id' AND question_number='$four'";
    if (see_if_timer_has_been_started($conn, $start_at_query) == 1){ //we need to insert a timer
        $access_q1_at = date('Y-m-d H:i:s', time());
        $update_time_query = "UPDATE Questions SET question_start_at = '$access_q1_at' WHERE student_id='$id' AND question_number='$four'";
        mysqli_query($conn, $update_time_query);
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
            <a class="nav-link active" aria-disabled="true">Question 4</a>
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


<!-- Automatic Typing -->
<section>
    <div class="container">
        <div class="mt-3">
            <div class="typing-container">
                <p>
                    <span style="color: green;" id="constant-text">Question 4: </span>
                    <span style="color: yellow;" id="constant-text">How much money is scattered amongst the ship?</span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Question 1 -->
<section>
    <div class="container">
        <div class="mt-2">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> One of Captain Cypher's crewmates has hidden money in various rooms on the ship, each represented by a string of characters. To find out which rooms contain money, Captain Cypher checks if the most common character in each room's string is a vowel. If the most common character in the string is a vowel, i.e. <span class="character">a,e,i,o,u,y</span> then the room is said to contain money. The sum of any of the numbers in that string of characters is how much money that room contained - each room on the sheet of paper is separated by the <span class="character">*</span> character. <span style="color:yellow">Please note</span>, integers in the string still count as non-vowels. For example:</h5>
                <h5 class="question_example">- The string <span class="character">aaart7e</span> would represent 1 room that contains money because there are 4 vowels, and 3 non-vowels. Notice the character <span class="character">7</span> is still counted as a non-vowel. Since 7 is the only integer, we can assume this room contains 7 dollars.</h5>
                <h5 class="question_example">- The string <span class="character">ttt83ea</span> would represent 1 room that does not contain money, since there are 5 non-vowels, and 2 vowels.</h5>
                <h5 class="question_example">- The string <span class="character">aio93*rae91aa</span> would represent 2 rooms which both contain money. The first room contains 12 dollars because <span class="character">9+3=12</span>, and the second room contains 10 dollars, because <span class="character">9+1=10</span>. So, there is a total of 22 dollars scattered amongs the ships rooms because <span class="character">12+10=22</span>.</h5>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="mt-2">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> If a string contains more vowels than non-vowels, but does not contain any integers, we can just assume by default the room contains 50 dollars. For example:</h5>
                <h5 class="question_example">- The string <span class="character">aaarte</span> would represent 1 room that contains 50 dollars.</h5>
                <h5 class="question_example">- The string <span class="character">aaarte*eeyz</span> would represent 2 rooms that contain 100 dollars in total.</h5>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="mt-2">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> HINT: Numbers count as non-vowels!</h5>

            </div>
        </div>
    </div>
</section>


<!-- Example 1 -->
<!-- <section>
    <div class="container">
        <div class="mt-4">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> Given the string of characters from the crewmate, your job is to help Captain Cypher figure out the 
                <a href="https://www.whitman.edu/mathematics/calculus_online/section01.02.html" 
                style="color:rgb(233, 233, 29)" target="_blank">distance traveled</a> from the starting point <span class="character">(0, 0)</span> to the endpoint. Please  note that no distance can be a negative value, and you should always take the <a href="https://www.mathsisfun.com/sets/function-floor-ceiling.html" style="color:yellow" target="_blank">ceiling</a> of the number. For example:</h5>
            <div class="question_example">
                <h5 class="question_example">- The directions of <span class="character">W3,E4,W5,N5</span> would mean the ship's treasure was found at point <span class="character">(-4, 5)</span>, hence had sailed <span class="character">6.403</span> miles from the starting point, but the <span style="color:white">correct</span> answer would be <span class="character">7</span>.</h5>
                <h5 class="question_example">- Reason: the ceiling of <span class="character">6.403</span> is <span class="character">7</span>.</h5>
                <h5 class="question_example">- The directions of <span class="character">S5,N9,E4</span> would mean the ship's treasure was found at point <span class="character">(4, 4)</span>, hence had sailed <span class="character">5.65</span> miles from the starting point, but the <span style="color:white">correct</span> answer would be <span class="character">6</span>.</h5>
                <h5 class="question_example">- Reason: the ceiling of <span class="character">5.65</span> is <span class="character">6</span>.</h5>

            </div>
        </div>
    </div>
</section> -->



<!-- The actual input -->
<section>
    <div class="container">
        <div class="mt-4">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> Your puzzle input</h5>
            <div class="question_example">
                <!-- <h5 class="question_example"><span class="character">[most likely a download-able txt file]</span></h5> -->
                <?php
                    echo "<h5><a href='https://turing.plymouth.edu/~lmc1076/q4_input.php' target='_blank' style='color:yellow;'>See puzzle input</a></h5>";
                ?>
            </div>
        </div>
    </div>
</section>
</section>


<!-- Submit -->
<section>
    <div class="container">
        <div class="mt-4">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> Given the string of characters from the crewmate, how much money is scattered amongst the ship?</h5>
            <!-- <div class="question_example">
                <h5 class="question_example"><span class="character">Random sequence of characters produced by the server [most likely a download-able txt file].</span></h5>
            </div> -->
            <form id="treasureForm" action="q4_grader.php" method="post">
                <h5 class="main_body">There are <input type="text" name="treasureDepth_q3" id="treasureDepth_q3" placeholder="Answer"> dollars scattered amongst the ship.</h5>
                <button class="submit_button">Submit</button>
            </form>
        </div>
    </div>
</section>
</section>

<!-- Go to question 2 -->
<!-- <section>
    <div class="container">
        <div class="mt-4">
            <a href="" style="text-decoration: none;"><h5 class="top_heading_for_questions">cd Question 2 >> </h5></a>
        </div>
    </div>
</section> -->


<!-- Footer -->
<section>
    <div class="mt-5" style="padding-top: 50px;">
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