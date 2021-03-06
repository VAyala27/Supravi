<?php
require('server.php');
$con = connectDB();
include 'include/add_to_cart.php';
session_start();

$email = $password = '';
$errors = array('email' => '', 'password' => '');

if (isset($_POST['sign'])) {
    $email = mysqli_real_escape_string($GLOBALS['con'], $_POST['email']);
    $password = mysqli_real_escape_string($GLOBALS['con'], $_POST['password']);
    if (empty($email)) {
        $errors['email'] = "Email is required";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    }
    $password = md5($password);

    if (array_filter($errors)) {
    } else {
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

        $result = mysqli_query($GLOBALS['con'], $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["firstname"] = $row['firstname'];
            $_SESSION["lastname"] = $row['lastname'];
            $_SESSION["password"] = $row['password'];
            $_SESSION["user_id"] = $row['id'];
            $_SESSION["usertype"] = $row['usertype'];

            $fname =  $_SESSION["firstname"];
            $lname =  $_SESSION["lastname"];

            $user = $fname . " " . $lname;

            if ($row['usertype'] == 1) {
                echo "<script>window.location.href='checkout.php'</script>";
            }
        } else {
            $errors['incorrect'] = "Incorrect username/login";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
        integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"
        integrity="sha256-HAaDW5o2+LelybUhfuk0Zh2Vdk8Y2W2UeKmbaXhalfA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">

    <title>Sign In Checkout</title>
</head>

<body>
    <?php
    include("include/header.php");
    ?>
    <main>
        <div class="container pt-5 pb-5">
            <h1 class="text-center mb-5 display-4 font-weight-bold">Login</h1>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-8">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="text-danger text-center"><?php echo $errors['incorrect'] ?></div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="text-danger"><?php echo $errors['email']; ?></div>
                                    <label for="email" class="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control d-block mx-auto"
                                        placeholder="Enter Email...">
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="text-danger"><?php echo $errors['password']; ?></div>
                                    <label for="password" class="password">Password</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control d-block mx-auto" placeholder="Enter Password...">
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-danger mt-5 d-block w-50 mx-auto" value="Sign In"
                            name="sign">
                    </form>
                    <a href="checkout.php" class="btn btn-outline-dark mt-5 d-block w-50 mx-auto">Checkout As
                        Guest</a>
                </div>
            </div>
        </div>
    </main>
    <?php include 'include/footer.php'; ?>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"
        integrity="sha256-Y1rRlwTzT5K5hhCBfAFWABD4cU13QGuRN6P5apfWzVs=" crossorigin="anonymous"></script>
    <script src="app.js"></script>