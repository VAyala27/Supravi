<?php
include 'include/header.php';
require('server.php');
include 'include/add_to_cart.php';

$con = connectDB();

$firstname = $lastname = $email  = $password = $password2 =  "";

$errors = array('firstname' => '', 'lastname' => '', 'email' => '', 'password' => '', 'password2' => '');

if (isset($_POST['register'])) {
    if (empty($_POST['firstname'])) {
        $errors['firstname'] = "First name is required";
    } else {
        $firstname = $_POST['firstname'];
        if (!preg_match('/^[a-zA-Z]+$/', $firstname)) {
            $errors['firstname'] =  "First Name must be letters only";
        }
    }

    if (empty($_POST['lastname'])) {
        $errors['lastname'] = "Last name is required";
    } else {
        $lastname = $_POST['lastname'];
        if (!preg_match('/^[a-zA-Z]+$/', $lastname)) {
            $errors['lastname'] =  "Last Name must be letters only";
        }
    }


    if (empty($_POST['email'])) {
        $errors['email'] = "An email is required";
        $email = $_POST['email'];
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email must be a valid email";
        }
    }

    $sql_e = "SELECT * FROM users WHERE email = '$email'";
    $res_e = mysqli_query($GLOBALS['con'], $sql_e);

    if (mysqli_num_rows($res_e) > 0) {
        $errors['email'] = "Email already exist";
    }

    if (empty($_POST['password'])) {
        $errors['password'] = "A password is required";
    } else {
        $password = $_POST['password'];
        if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/', $password)) {
            $errors['password'] = "Password must contain at least 8 characters, one lowercase letter, one capital letter, and one number";
        }
    }

    if (empty($_POST['password2'])) {
        $errors['password2'] = "A password is required";
    } else if ($_POST['password'] != $_POST['password2']) {
        $errors['password2'] = "Oops! Password did not match! Try again. ";
    }



    if (array_filter($errors)) {
    } else {
        $firstname = mysqli_real_escape_string($GLOBALS['con'], $_POST['firstname']);
        $lastname = mysqli_real_escape_string($GLOBALS['con'], $_POST['lastname']);
        $email = mysqli_real_escape_string($GLOBALS['con'], $_POST['email']);
        $password = mysqli_real_escape_string($GLOBALS['con'], $_POST['password']);
        $password = md5($password);
        $sql = "INSERT INTO users(firstname,lastname,email,password) VALUES('$firstname','$lastname','$email','$password')";
        if (mysqli_query($GLOBALS['con'], $sql)) {
            echo "<script>alert('User Registration Successful!!')</script>";
            echo "<script>window.location='login.php'</script>";
        } else {
            echo 'query error: ' . mysqli_error($GLOBALS['con']);
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

    <title>Register</title>
</head>

<body>
    <main>
        <div class="container pt-5 pb-5">
            <h1 class="text-center mb-5 display-4 font-weight-bold">Sign Up</h1>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-8">
                    <form action="" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8 mb-3">
                                    <div class="text-danger"><?php echo $errors['firstname']; ?></div>
                                    <label for="firstname" class="firstname">First Name</label>
                                    <input type="text" name="firstname" id="firstname"
                                        value="<?php echo htmlspecialchars($firstname) ?>"
                                        class="form-control d-block mx-auto" placeholder="Enter Firstname...">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8 mb-3">
                                    <div class="text-danger"><?php echo $errors['lastname']; ?></div>
                                    <label for=" lastname" class="lastname">Last Name</label>
                                    <input type="text" name="lastname" id="lastname"
                                        class="form-control d-block mx-auto" placeholder="Enter Lastname..."
                                        value="<?php echo htmlspecialchars($lastname) ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8 mb-3">
                                    <div class="text-danger"><?php echo $errors['email']; ?></div>
                                    <label for="email" class="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control d-block mx-auto"
                                        autocomplete="off" placeholder="Enter Email..."
                                        value="<?php echo htmlspecialchars($email) ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8 mb-3">
                                    <div class="text-danger"><?php echo $errors['password']; ?></div>
                                    <label for="password" class="password">Password</label>
                                    <input type="password" name="password" id="password" value=""
                                        class="form-control d-block mx-auto" placeholder="Enter Password...">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8 mb-3">
                                    <div class="text-danger"><?php echo $errors['password2']; ?></div>
                                    <label for="password" class="password">Confirm Password</label>
                                    <input type="password" name="password2" id="password" value=""
                                        class="form-control d-block mx-auto" placeholder="Enter Password...">
                                </div>
                            </div>

                        </div>
                        <input type="submit" name="register" id="register"
                            class="btn btn-dark mt-5 d-block w-50 mx-auto" value="Sign Up">
                        <input type="reset" class="btn btn-danger mt-5 d-block w-50 mx-auto" value="Clear">
                    </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="app.js"></script>