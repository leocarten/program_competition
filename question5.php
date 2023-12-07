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
    $five = 5;
    $start_at_query = "SELECT question_start_at FROM Questions WHERE student_id='$id' AND question_number='$five'";
    if (see_if_timer_has_been_started($conn, $start_at_query) == 1){ //we need to insert a timer
        $access_q1_at = date('Y-m-d H:i:s', time());
        $update_time_query = "UPDATE Questions SET question_start_at = '$access_q1_at' WHERE student_id='$id' AND question_number='$five'";
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
    <!-- <script src="script.js"></script> -->
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
            <a class="nav-link active" aria-disabled="true">Question 5</a>
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
        <div class="mt-5">
            <div class="typing-container">
                <p>
                    <span style="color: green;" id="constant-text">Question 5: </span>
                    <span style="color: yellow;" id="constant-text"> Can you help Captain Cypher help encrypt a message? </span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Question 1 -->
<section>
    <div class="container">
        <div class="mt-2">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> Encryption is a tactic used to help keep messages private. Captain Cypher wants to send a message back home, letting his friends know how much money he found, but he doesn't want his enemies discovering out how much treasure he found.</h5>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="mt-2">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> Captain Cyphers friends know the exact way that he encrypts his messages. Captain Cypher sends numbers in pairs, and uses such table to decode:</h5>
            <table class="table table-hover table-dark">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col" style="color: yellow;">1</th>
                    <th scope="col">2</th>
                    <th scope="col">3</th>
                    <th scope="col">4</th>
                    <th scope="col" style="color:red;">5</th>
                    <th scope="col">6</th>
                    <th scope="col">7</th>
                    <th scope="col" style="color:orange;">8</th>
                    <th scope="col">9</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row" style="color: yellow;">1</th>
                    <td style="color: yellow;">b</td>
                    <td>c</td>
                    <td>d</td>
                    <td>e</td>
                    <td>f</td>
                    <td>g</td>
                    <td>h</td>
                    <td>i</td>
                    <td>a</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>c</td>
                    <td>d</td>
                    <td>e</td>
                    <td>f</td>
                    <td>g</td>
                    <td>h</td>
                    <td>i</td>
                    <td>a</td>
                    <td>b</td>
                  </tr>
                  <tr>
                    <th scope="row" style="color:red;">3</th>
                    <td>d</td>
                    <td>e</td>
                    <td>f</td>
                    <td>g</td>
                    <td style="color:red;">h</td>
                    <td>i</td>
                    <td>a</td>
                    <td>b</td>
                    <td>c</td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>e</td>
                    <td>f</td>
                    <td>g</td>
                    <td>h</td>
                    <td>i</td>
                    <td>a</td>
                    <td>b</td>
                    <td>c</td>
                    <td>d</td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>f</td>
                    <td>g</td>
                    <td>h</td>
                    <td>i</td>
                    <td>a</td>
                    <td>b</td>
                    <td>c</td>
                    <td>d</td>
                    <td>e</td>
                  </tr>
                  <tr>
                    <th scope="row">6</th>
                    <td>g</td>
                    <td>h</td>
                    <td>i</td>
                    <td>a</td>
                    <td>b</td>
                    <td>c</td>
                    <td>d</td>
                    <td>e</td>
                    <td>f</td>
                  </tr>
                  <tr>
                    <th scope="row" style="color:orange;">7</th>
                    <td>h</td>
                    <td>i</td>
                    <td>a</td>
                    <td>b</td>
                    <td>c</td>
                    <td>d</td>
                    <td>e</td>
                    <td style="color:orange;">f</td>
                    <td>g</td>
                  </tr>
                  <tr>
                    <th scope="row">8</th>
                    <td>i</td>
                    <td>a</td>
                    <td>b</td>
                    <td>c</td>
                    <td>d</td>
                    <td>e</td>
                    <td>f</td>
                    <td>g</td>
                    <td>h</td>
                  </tr>
                  <tr>
                    <th scope="row">9</th>
                    <td>a</td>
                    <td>b</td>
                    <td>c</td>
                    <td>d</td>
                    <td>e</td>
                    <td>f</td>
                    <td>g</td>
                    <td>h</td>
                    <td>i</td>
                  </tr>
                </tbody>
              </table>

        </div>
    </div>
</section>


<!-- Example 1 -->
<section>
    <div class="container">
        <div class="mt-4">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> For example:</h5>
            <div class="question_example">
                <h5 class="question_example">- The number <span class="character">11</span> would represent the letter <span class="character">b</span> [shown in <span style="color: yellow;">yellow</span>]. </h5>
                <h5 class="question_example">- The number <span class="character">53</span> would represent the letter <span class="character">h</span> [shown in <span style="color: red;">red</span>]. </h5>
                <h5 class="question_example">- The number <span class="character">87</span> would represent the letter <span class="character">f</span> [shown in <span style="color: orange;">orange</span>]. </h5>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="mt-4">
            <h5 class="main_body"><span style="font-weight: bold;">>></span> The numbers will be separated by commas. For example:</h5>
            <div class="question_example">
                <h5 class="question_example">- The string <span class="character">11,53,87</span> would represent the string <span class="character">bhf</span>.</h5>
            </div>
            <h5 class="main_body mt-4"><span style="font-weight: bold;">>></span> However, there is one last step - we need to represent the numerical value using <a href="https://www.rapidtables.com/code/text/ascii-table.html" target="_blank" style="color:yellow;"> ASCII</a> values. For example:</h5>
            <div class="question_example">
                <h5 class="question_example">- The letter <span class="character">b</span> would represent the ASCII number <span class="character">98</span>.</h5>
                <h5 class="question_example">- The letter <span class="character">h</span> would represent the ASCII number <span class="character">104</span>.</h5>
                <h5 class="question_example">- The letter <span class="character">f</span> would represent the ASCII number <span class="character">102</span>.</h5>
            </div>
            <h5 class="main_body mt-4"><span style="font-weight: bold;">>></span> The sum of the ASCII values represent exactly how much money the treasure was worth. So, the puzzle input of <span class="character">11,53,87</span> would represent a total sum of <span class="character">304</span> dollars being found because <span class="character">98+104+102=304</span>.</h5>
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
                    echo "<h5><a href='https://turing.plymouth.edu/~lmc1076/q5_input.php' target='_blank' style='color:yellow;'>See puzzle input</a></h5>";
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
            <h5 class="main_body"><span style="font-weight: bold;">>></span> How much money was Captain Cyphers treasure worth?</h5>
            <!-- <div class="question_example">
                <h5 class="question_example"><span class="character">Random sequence of characters produced by the server [most likely a download-able txt file].</span></h5>
            </div> -->
            <form id="treasureForm" action="q5_grader.php" method="post">
                <h5 class="main_body">Captain Cypher's treasure worth <input type="text" name="treasureDepth_q3" id="treasureDepth" placeholder="Answer"> dollars.</h5>
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
