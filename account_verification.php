<?php

        // In this php script, we populate the DB with all possible question inputs and answers. The actual session won't start until they login.

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
                        echo "No matching record found.";
                    }
                }
            }

            function q1_randomly_generated_puzzle_input(){
                $random_number = rand(125,225);
                $array = array(";",".","%");
                $puzzle_input = "";
                for($x = 0; $x <= $random_number; $x++){
                    $random_array_chosen = rand(0, (count($array)-1));
                    $puzzle_input .= $array[$random_array_chosen];
                }
                return $puzzle_input;
            }

            function q1_answer($input){
                $sum = 0;
                for ($x = 0; $x < strlen($input); $x++) {
                    $letter = $input[$x];
                    switch ($letter) {
                        case ";":
                            $sum += 2;
                            break; 
                        case ".":
                            $sum += 4;
                            break;
                        case "%":
                            $sum += 3;
                            break;
                    }
                }
                return $sum;
            }

            function q2_random_input(){
                $max_number = rand(100, 150);
                //$max_number = 50;
                $array_of_weight = [];
                for($x = 0; $x <= $max_number; $x++){
                    $random_weight = rand(75, 250);
                    $array_of_weight[$x] = $random_weight;
                }
                return $array_of_weight;
            }

            function turn_array_to_string($array) {
                $empty_string = "";
                $count = count($array);
            
                for ($x = 0; $x < $count; $x++) {
                    if (!empty($array[$x])) {
                        $empty_string .= (string)$array[$x];
                        if ($x < $count - 1) {
                            $empty_string .= ', ';
                        }
                    }
                }
                return $empty_string;
            }
            

            function q2_answer($array){
                $max_capacity = 10000;
                $total_amount_of_people = 0;
                $current_weight = 0;
                for($x = 0; $x < count($array); $x++){
                    if( ($current_weight + $array[$x]) <= 10000){
                        $current_weight += $array[$x];
                        $total_amount_of_people += 1;
                    }
                }
                return $total_amount_of_people;
            }

            function q3_random_input(){
                $empty_string = "";
                $characters = ["N", "E", "S", "W"];
                $length = (rand(50,80))*2;
                for($x = 0; $x <= $length; $x++){
                    $distance = rand(1,9);
                    $random_direction = rand(0,3);
                    if($x != $length){
                        $empty_string .= $characters[$random_direction];
                        $empty_string .= (string) $distance;
                        $empty_string .= ",";
                    }
                    else{
                        $empty_string .= $characters[$random_direction];
                        $empty_string .= (string) $distance;
                    }
                }
                return $empty_string;

            }

            function total_distance($x, $y){
                $first = $x - 0;
                $second = $y - 0;
                $first_power = pow($first, 2);
                $second_power = pow($second, 2);
                $sum = $first_power + $second_power;
                $sqr = sqrt($sum);
                return ceil($sqr);
            }

            function q3_answer($string){
                $array = explode(",", $string);
                $x_direction = 0;
                $y_direction = 0;
                for($x = 0; $x < count($array); $x++){
                    if($array[$x][0] == "N"){
                        $y_direction += intval($array[$x][1]);
                    }
                    elseif($array[$x][0] == "E"){
                        $x_direction += intval($array[$x][1]);
                    }
                    elseif($array[$x][0] == "S"){
                        $y_direction -= intval($array[$x][1]);
                    }
                    elseif($array[$x][0] == "W"){
                        $x_direction -= intval($array[$x][1]);
                    }
                }
                return(total_distance($x_direction,$y_direction));
            }

            function q4_generate_array_of_characters(){
                $array = [];
                $array_index = 0;
                for($x = 97; $x <= 122; $x++){
                    $array[$array_index] = chr($x);
                    $array_index++;
                }
                return $array;
            }

            function q4_random_input(){
                $vowels = ["a","e","i","o","u","y"];
                $alphabet = q4_generate_array_of_characters();
                $length_of_string = (rand(25,30))*2;
                $count = 0;
                $empty_string = 0;
                $empty_string .= $alphabet[rand(0,25)];
                while($count <= $length_of_string){
                    $length_of_room = rand(3,15);
                    $room_count = 0;
                    while($room_count < $length_of_room){
                        $will_contain_vowel = rand(0,9);
                        if($will_contain_vowel == 0 || $will_contain_vowel ==1){
                            $empty_string .= $alphabet[rand(0,25)];
                        }
                        elseif($will_contain_vowel == 2 || $will_contain_vowel ==3 || $will_contain_vowel == 4 || $will_contain_vowel ==5 || $will_contain_vowel == 6 || $will_contain_vowel ==7){
                            $empty_string .= $vowels[rand(0,5)];
                        }
                        else{
                            $another_random_test = rand(0,1);
                            if($another_random_test == 1){
                                $empty_string .= strval(rand(0,9));
                            }
                            else{
                                $empty_string .= strval(rand(0,9));
                                $empty_string .= $vowels[rand(0,5)];
                            }
                        }
                        $room_count++;
                    }
                    if($count != $length_of_room){
                        $empty_string .= "*";
                    }
                    $count++;
                }
                return $empty_string;
            }

            function contains($array, $thing_we_are_searching_for) {
                return in_array($thing_we_are_searching_for, $array);
            }
            
            // function q4_answer($string){
            //     // $array = explode("*", $string);
            //     $array = ["aio93","rae91aa"];
            //     $vowels = ["a","e","i","o","u","y"];
            //     $numbers = ["1","2","3","4","5","6","7","8","9"];
            //     $alphabet = q4_generate_array_of_characters();
            //     $total_money = 0;
            //     for($x = 0; $x < count($array); $x++){
            //         $room = $array[$x];
            //         $vowel_counter = 0;
            //         $non_vowel_counter = 0;
            //         $money_in_room = 0;
            //         for($letter = 0; $letter < strlen($room); $letter++){
            //             if(contains($vowels, $letter)){
            //                 $vowel_counter++;
            //             }
            //             elseif(contains($numbers, $letter)){
            //                 $non_vowel_counter++;
            //                 $money_in_room = $money_in_room + intval($letter);
            //             }
            //             else{
            //                 $non_vowel_counter++;
            //             }
            //         }
            //         if($vowel_counter > $non_vowel_counter && $money_in_room != 0){
            //             $total_money = $total_money + $money_in_room;
            //         }
            //         elseif($vowel_counter > $non_vowel_counter){
            //             $total_money = $total_money + 50;
            //         }
            //     }
            //     return $total_money;
            // }

            function q4_answer($string){
                $array = explode("*", $string); // Split the input string using '*' as the delimiter
                $vowels = ["a","e","i","o","u","y"];
                $numbers = ["1","2","3","4","5","6","7","8","9"];
                $total_money = 0;
            
                foreach ($array as $room) {
                    $vowel_counter = 0;
                    $non_vowel_counter = 0;
                    $money_in_room = 0;
            
                    for ($letter = 0; $letter < strlen($room); $letter++) {
                        $char = $room[$letter];
            
                        if (in_array($char, $vowels)) {
                            $vowel_counter++;
                        } elseif (in_array($char, $numbers)) {
                            $non_vowel_counter++;
                            $money_in_room += intval($char);
                        } else {
                            $non_vowel_counter++;
                        }
                    }
            
                    if ($vowel_counter > $non_vowel_counter && $money_in_room != 0) {
                        $total_money += $money_in_room;
                    } elseif ($vowel_counter > $non_vowel_counter) {
                        $total_money += 50;
                    }
                }
            
                return $total_money;
            }

            function q5_random_input(){
                $total_length = (rand(50,75))*2;
                $random_input = "";
                $count = 0;
                while($count <= $total_length){
                    if($count < $total_length){
                        $num_one = rand(1,9);
                        $num_two = rand(1,9);
                        $random_input .= strval($num_one);
                        $random_input .= strval($num_two);
                        $random_input .= ",";
                    }
                    else{
                        $num_one = rand(1,9);
                        $num_two = rand(1,9);
                        $random_input .= strval($num_one);
                        $random_input .= strval($num_two);
                    }
                    $count++;
                }
                return $random_input;
            }

            function generate_table(){
                $table = [
                    ['b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'a'],
                    ['c', 'd', 'e', 'f', 'g', 'h', 'i', 'a', 'b'],
                    ['d', 'e', 'f', 'g', 'h', 'i', 'a', 'b', 'c'],
                    ['e', 'f', 'g', 'h', 'i', 'a', 'b', 'c', 'd'],
                    ['f', 'g', 'h', 'i', 'a', 'b', 'c', 'd', 'e'],
                    ['g', 'h', 'i', 'a', 'b', 'c', 'd', 'e', 'f'],
                    ['h', 'i', 'a', 'b', 'c', 'd', 'e', 'f', 'g'],
                    ['i', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'],
                    ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i']
                ];
                return $table;
            }

            function get_sum($array){
                $sum = 0;
                for($x = 0; $x < count($array); $x++){
                    $sum += ord($array[$x]);
                }
                return $sum;
            }

            function q5_answer($string){
                $map = generate_table();
                // 11 maps to b
                $input_array = explode(",", $string);
                $character_array = [];
                for($x = 0; $x < count($input_array); $x++){
                    $number = $input_array[$x];
                    $first_digit = $number[0];
                    $second_digit = $number[1]; // how far down
                    $first_row = $map[intval($second_digit) - 1];
                    $first_column = $first_row[intval($first_digit) - 1];
                    array_push($character_array, $first_column);
                }
                $sum_of_money = get_sum($character_array);
                return $sum_of_money;
            }
            

            $error_messgage = 1;
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if($_POST["fName"] != "" && $_POST["lName"] != "" && $_POST["password"] != "" && $_POST["passwordConfirmation"] != "" && $_POST["password"] == $_POST["passwordConfirmation"] && strlen($_POST["password"]) >= 8){ //success
                    $firstname = $_POST["fName"];
                    $lastname = $_POST["lName"];
                    $password = $_POST["password"];
                    $timestamp = time();
                    $created_at = date('Y-m-d H:i:s', $timestamp);

                    $hashed_password = hash('sha256', $password);

                    include("/home/lmc1076/PHP-Includes/phpbook-vars.inc");
                    $connection = makeConnection("turing","lmc1076", $my_db_password, "Team2");

                    $query = "INSERT INTO Students (first_name, last_name, password, created_at) VALUES ('$firstname', '$lastname', '$hashed_password', '$created_at')"; // create the account

                    if (mysqli_query($connection, $query)) {  // insert the data into student table
                        echo "";
                    } else {
                        $error_messgage = 0;
                    }

                    // now we need to get the user id
                    $get_student_id_query = "SELECT student_id FROM Students WHERE first_name = '$firstname' AND last_name = '$lastname' AND password = '$hashed_password'";
                    $id = get_student_id_from_student_table($connection, $get_student_id_query);
                    $q1_random_input = q1_randomly_generated_puzzle_input();
                    $q1_answer = q1_answer($q1_random_input);
                    $zero = 0;
                    $q1_question_number = 1;
                    $q1_insert_query = "INSERT INTO Questions (student_id, randomly_generated_input, answer, attempts, has_been_correctly_answered, question_number) VALUES ('$id', '$q1_random_input', '$q1_answer', '$zero', '$zero', '$q1_question_number')"; // add input and answer

                    $do_something = 0;
                    if (mysqli_query($connection, $q1_insert_query)) {  // insert the data for the question input and answer
                        $do_something += 1;
                     } else {
                        $error_messgage = 0;
                    }
                    
                    // question 2 logic
                    $q2_question_number = 2;
                    $q2_array_of_weight = q2_random_input();
                    // $q2_array_of_weight = [250, 250, 250, 250, 250, 250, 250, 250, 500, 700, 1000, 5000, 799, 738, 48, 39, 3949, 3940, 395, 440, 394, 1, 1];
                    $q2_random_input = turn_array_to_string($q2_array_of_weight);
                    $q2_answer = q2_answer($q2_array_of_weight);
                    $q2_insert_query = "INSERT INTO Questions (student_id, randomly_generated_input, answer, attempts, has_been_correctly_answered, question_number) VALUES ('$id', '$q2_random_input', '$q2_answer', '$zero', '$zero', '$q2_question_number')"; // add input and answer
                    if (mysqli_query($connection, $q2_insert_query)) {  // insert the data for the question input and answer
                        $do_something += 1;
                     } else {
                        $error_messgage = 0;
                    }

                    // question 3 stuff
                    $q3_question_number = 3;
                    // $q3_array_of_weight = q3_random_input();
                    $q3_random_input = q3_random_input();
                    $q3_answer = q3_answer($q3_random_input);
                    $q3_insert_query = "INSERT INTO Questions (student_id, randomly_generated_input, answer, attempts, has_been_correctly_answered, question_number) VALUES ('$id', '$q3_random_input', '$q3_answer', '$zero', '$zero', '$q3_question_number')"; // add input and answer
                    if (mysqli_query($connection, $q3_insert_query)) {  // insert the data for the question input and answer
                        $do_something += 1;
                     } else {
                        $error_messgage = 0;
                    }

                    // question 4 stuff
                    $q4_question_number = 4;
                    // $q4_array_of_weight = q4_random_input();
                    $q4_random_input = q4_random_input();
                    $q4_answer = q4_answer($q4_random_input);
                    $q4_insert_query = "INSERT INTO Questions (student_id, randomly_generated_input, answer, attempts, has_been_correctly_answered, question_number) VALUES ('$id', '$q4_random_input', '$q4_answer', '$zero', '$zero', '$q4_question_number')"; // add input and answer
                    if (mysqli_query($connection, $q4_insert_query)) {  // insert the data for the question input and answer
                        $do_something += 1;
                        } 
                    else {
                        $error_messgage = 0;
                    }

                    // question 5 stuff
                    $q5_question_number = 5;
                    // $q5_array_of_weight = q5_random_input();
                    $q5_random_input = q5_random_input();
                    $q5_answer = q5_answer($q5_random_input);
                    $q5_insert_query = "INSERT INTO Questions (student_id, randomly_generated_input, answer, attempts, has_been_correctly_answered, question_number) VALUES ('$id', '$q5_random_input', '$q5_answer', '$zero', '$zero', '$q5_question_number')"; // add input and answer
                    if (mysqli_query($connection, $q5_insert_query)) {  // insert the data for the question input and answer
                        $do_something += 1;
                        } 
                    else {
                        $error_messgage = 0;
                    }

                    // insert grade level into leaderboard table
                    if (isset($_POST["gradeLevel"])) {
                        $grade_level = $_POST["gradeLevel"];
                        $leaderboard_insert_query = "INSERT INTO Leaderboard (student_id, score, gradeLevel) VALUES ('$id', '$zero', '$grade_level')";
                        if (mysqli_query($connection, $leaderboard_insert_query)) {  // insert the data for the question input and answer
                            $do_something += 1;
                            } 
                        else {
                            $error_messgage = 0;
                        }
                    }
                    else{
                        $grade_level = "N/A";
                        $leaderboard_insert_query = "INSERT INTO Leaderboard (student_id, score, gradeLevel) VALUES ('$id', '$zero', '$grade_level')";
                        if (mysqli_query($connection, $leaderboard_insert_query)) {  // insert the data for the question input and answer
                            $do_something += 1;
                            } 
                        else {
                            $error_messgage = 0;
                        }
                    }

                    session_start();
                    $_SESSION['student_id'] = $id;
                    header("Location: https://turing.plymouth.edu/~lmc1076/user_progress.php");
                    exit;


                }
                elseif($error_messgage == 0){ //failure
                    header('Location: https://turing.plymouth.edu/~lmc1076/error.php');
                    exit;
                }
                else{
                    // echo "<h5 style='color:#E74C3C'>There was an error while trying to create your account - please create another account.</h5>";
                    header('Location: https://turing.plymouth.edu/~lmc1076/error.php');
                    exit;
                }
            }
        ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <title>Account Verification</title>
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"aria-expanded="false" aria-label="Toggle navigation">
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

        <div class="container mt-4">

        <!-- PHP -->
        <div style="color:green">
        
        </div>


        </div>

    <!-- Footer -->
    <!-- <section>
        <div class="mt-5">
            <div class="footer-basic">
                <footer>
                    <div class="social">
                        <a href="https://discord.gg/KM7E9SUbU3" target="_blank"><i style="color: white;" class="fa-brands fa-discord"></i></a>
                        <a href="" target="_blank"><i style="color: white;" class="fa-brands fa-twitter"></i></a>
                        <a href="" target="_blank"><i style="color: white;" class="fas fa-envelope"></i></a>

                    </div>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#">About</a></li>
                        <li class="list-inline-item"><a href="#">Ethical Hacking Club Terms</a></li>
                        <li class="list-inline-item"><a href="#">Programming Contest</a></li>
                        <li class="list-inline-item"><a href="#">Club Events</a></li>
                    </ul>
                    <p class="copyright">Made with <i style="color: red;" class="fa-solid fa-heart"></i> by: Leo Carten, David Albert, Matt Wagner, and Abraha
m Abrams</p>

                </footer>
            </div>
        </div>
    </section> -->

    </body>
<html>

