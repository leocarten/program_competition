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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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
            <a class="nav-link" aria-current="page" href="https://turing.plymouth.edu/~lmc1076/">About</a>
            </li>
            <li class="nav-item">
            <!-- <a class="nav-link" href="#">The contest</a> -->
            <a href="https://turing.plymouth.edu/~lmc1076/login.html" class="nav-link" aria-disabled="true">The contest</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

<div class="container mt-3">
    <?php
        echo "<h5 style='color:#E74C3C'>There was an error while trying to access your account - did you use the correct credentials?</h5>";
    ?>
</div>


</body>

</html>