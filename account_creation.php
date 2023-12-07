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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="https://turing.plymouth.edu/~lmc1076/">About</a>
            </li>
            <li class="nav-item">
            <!-- <a class="nav-link" href="#">The contest</a> -->
            <a href="https://turing.plymouth.edu/~lmc1076/login.html" class="nav-link" aria-disabled="true">The contest</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Login
            </a>
            <ul class="dropdown-menu">
                <a href="https://turing.plymouth.edu/~lmc1076/login.html" class="nav-link" aria-disabled="true">Login</a>
                <li><hr class="dropdown-divider"></li>
                <a href="https://turing.plymouth.edu/~lmc1076/account_creation.php" class="nav-link" aria-disabled="true">Create Account</a>
            </ul>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <div>

            </div>
        </form>
        </div>
    </div>
    </nav>
</section>

<div class="container">

<section>
    
        <div class="mt-5">
            <div class="typing-container">
                <p>
                    <span style="color: green;" id="constant-text">Welcome to </span>
                    <span style="color: yellow;" id="constant-text"> Account Creation</span>
                </p>
            </div>
        </div>
</section>

<style>
    ::placeholder {
        color: rgb(255, 255, 255) !important;
        opacity: .4 !important; 
    }
</style>
<form Method="POST" action="account_verification.php">
    <div class="mb-3">
      <label for="firstName" class="form-label" style="color: white">First Name</label>
      <input name="fName" class="form-control" id="firstName" aria-describedby="emailHelp" style="background-color: black; color:white; border-color:rgba(255,255,255,0.5);" placeholder="First name...">
      <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    </div>
    <div class="mb-3">
        <label for="lastName" class="form-label" style="color: white">Last Name</label>
        <input name="lName" class="form-control" id="lastName" aria-describedby="emailHelp" style="background-color: black;color:white;border-color:rgba(255,255,255,0.5);" placeholder="Last name...">
        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    </div>

    <div class="mb-3">
        <label for="password" class="form-label" style="color: white">I am a:</label>
            <!-- <option value="Freshman">Freshman</option>
            <option value="Sophomore">Sophomore</option>
            <option value="Junior">Junior</option>
            <option value="Senior">Senior</option>
            <option value="Other">Other</option> -->
            <div class='form-check'><input class='form-check-input' type='radio' name='gradeLevel' value='Freshman' aria-label='Freshman'><label class='form-check-label' style="color:#D6DDE4">Freshman</label></div>
            <div class='form-check'><input class='form-check-input' type='radio' name='gradeLevel' value='Sophomore' aria-label='Sophomore'><label class='form-check-label' style="color:#D6DDE4">Sophomore</label></div>
            <div class='form-check'><input class='form-check-input' type='radio' name='gradeLevel' value='Junior' aria-label='Junior'><label class='form-check-label' style="color:#D6DDE4">Junior</label></div>
            <div class='form-check'><input class='form-check-input' type='radio' name='gradeLevel' value='Senior' aria-label='Senior'><label class='form-check-label' style="color:#D6DDE4">Senior</label></div>
            <div class='form-check'><input class='form-check-input' type='radio' name='gradeLevel' value='Professor' aria-label='Professor'><label class='form-check-label' style="color:#D6DDE4">Professor</label></div>
            <div class='form-check'><input class='form-check-input' type='radio' name='gradeLevel' value='Other' aria-label='Other'><label class='form-check-label' style="color:#D6DDE4">Other</label></div>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label" style="color: white">Password</label>
        <input name="password" type="password" class="form-control" id="password" aria-describedby="emailHelp" style="background-color: black;color:white;border-color:rgba(255,255,255,0.5);" placeholder="Password...">
        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
    </div>
    <div class="mb-3">
        <label for="passwordConfirmation" class="form-label" style="color: white">Password Confirmation</label>
        <input name="passwordConfirmation" type="password" class="form-control" id="passwordConfirmation" aria-describedby="emailHelp" style="background-color: black;color:white;border-color:rgba(255,255,255,0.5);" placeholder="Re-type password...">
        <div id="emailHelp" class="form-text" style="color: rgba(255, 255, 255, 0.6);">Passwords must be <span style="color:yellow;">at least</span> 8 characters long <i class="fa fa-exclamation-triangle" style="color:yellow;font-size:18px;"></i></div>
    </div>

    <button class="submit_button">Create Account</button>
</form>


<!-- Footer -->
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

</div>

</body>
</html>
