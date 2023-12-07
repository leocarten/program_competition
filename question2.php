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
    $two = 2;
    $start_at_query = "SELECT question_start_at FROM Questions WHERE student_id='$id' AND question_number='$two'";
    if (see_if_timer_has_been_started($conn, $start_at_query) == 1){ //we need to insert a timer
        $access_q1_at = date('Y-m-d H:i:s', time());
        $update_time_query = "UPDATE Questions SET question_start_at = '$access_q1_at' WHERE student_id='$id' AND question_number='$two'";
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
            <a class="nav-link active" aria-disabled="true">Question 2</a>
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
                    <span style="color: green;" id="constant-text">Question 2: </span>
                    <span style="color: yellow;" id="constant-text"> How many people can come aboard? </span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Question 2 -->
<section>
    <div class="container">
        <div class="mt-2">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> Captain Cypher wanted to bring as many people as possible to help him dig up the treasure. Unfortunately, Captain Cypher had to sail quite far to reach the digging spot. There is a long line of people who want to join the boat to find the treasure, but Captain Cypher knows his boat can only hold 10,000 additional pounds. Luckily, Captain Cypher came prepared as he brought a scale to weigh each person in line as they entered the boat.</h5>
            <h5 class="main_body mt-4"><span style="font-weight: bold;">>></span> For simplicity, each person in line is separated by a comma. So: </h5>
            <div class="question_example">
                <h5 class="question_example">- The series <span class="character">250, 150, 200</span> would represent 3 people with a total weight of 600 pounds.  </h5>
                <h5 class="question_example">- The series <span class="character">175, 150, 225, 300</span> would represent 4 people with a total weight of 850 pounds.  </h5>
            </div>
        </div>
    </div>
</section>


<!-- Example 2 -->
<section>
    <div class="container">
        <div class="mt-4">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> As soon as a person steps on to the scale, if the total weight does not exceed 10,000 pounds, they are immediately accepted on the voyage. In other words, Captain Cypher is not worried about trying to optimize the amount of people - he will start with the first person and either accept or reject. For example:</h5>
            <div class="question_example">
                <h5 class="question_example">- <span class="character">2500, 5000, 1000, 1050, 1300, 400</span> would represent 6 [heavy] people waiting in line, however, Captain Cypher would only accept 5 people on the voyage.</h5>
                <h5 class="question_example">- Reason: The person who weighed <span class="character">1300</span> pounds would be rejected since <span class="character">2500+5000+1000+1050=9550</span>, which leaves only 450 availble pounds. Hence, the person weighing 1300 pounds was denied, but the person weighing 400 pounds was accepted</h5>
            </div>
        </div>
    </div>
</section>



<!-- The actual input -->
<section>
    <div class="container">
        <div class="mt-4">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> Your puzzle input</h5>
            <div class="question_example">
                <!-- <h5 class="question_example"><span class="character">[most likely a download-able txt file]</span></h5> -->
                <?php
                    echo "<h5><a href='https://turing.plymouth.edu/~lmc1076/q2_input.php' target='_blank' style='color:yellow;'>See puzzle input</a></h5>";
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
            <h5 class="main_body"><span style="font-weight: bold;">>></span> Knowing the boat can only hold an additional 10,000 pounds, how many people can Captain Cypher accept on his voyage?</h5>
            <form id="treasureForm" action="q2_grader.php" method="post">
                <h5 class="main_body">Captain Cypher's can afford to bring <input type="text" name="treasureDepth" id="treasureDepth" placeholder="Answer"> additional people.</h5>
                <button type="submit" class="submit_button">Submit</button>
            </form>
        </div>
    </div>
</section>
</section>


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