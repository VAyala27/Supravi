<?php session_start();
require('server.php');
$con = connectDB();

// include 'include/add_to_cart.php';

$firstname = $lastname = $email = $phone = $address = "";

$errors = array('firstname' => '', 'lastname' => '', 'email' => '', 'phone' => '', 'address' => '');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($GLOBALS['con'], $sql);
    $user = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {

    if (empty($_POST['firstname'])) {
        $errors['firstname'] = "A first name is required";
    } else {
        $firstname = $_POST['firstname'];
        if (!preg_match('/^[a-zA-Z]+$/', $firstname)) {
            $errors['firstname'] =  "First Name must be letters only";
        }
    }

    if (empty($_POST['lastname'])) {
        $errors['lastname'] = "A last name is required";
    } else {
        $lastname = $_POST['lastname'];
        if (!preg_match('/^[a-zA-Z]+$/', $lastname)) {
            $errors['lastname'] =  "Last Name must be letters only";
        }
    }

    if (empty($_POST['email'])) {
        $errors['email'] = "An email is required";
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email must be a valid email";
        }
    }

    if (empty($_POST['phone'])) {
        $errors['phone'] = "A phone number is required";
    } else {
        $phone = $_POST['phone'];
        if (!preg_match('/^((([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+)*$/', $phone)) {
            $errors['phone'] = "Invalid phone number";
        }
    }

    if (empty($_POST['address'])) {
        $errors['address'] = "A address is required";
    } else {
        $address = $_POST['address'];
        if (!preg_match('/^[#.0-9a-zA-Z\s,-]+$/', $address)) {
            $errors['address'] = "Invalid address";
        }
    }

    if (array_filter($errors)) {
    } else {
        $firstname = mysqli_real_escape_string($GLOBALS['con'], $_POST['firstname']);
        $lastname = mysqli_real_escape_string($GLOBALS['con'], $_POST['lastname']);
        $email = mysqli_real_escape_string($GLOBALS['con'], $_POST['email']);
        $phone = mysqli_real_escape_string($GLOBALS['con'], $_POST['phone']);
        $address = mysqli_real_escape_string($GLOBALS['con'], $_POST['address']);

        $sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email', phone = '$phone', address = '$address'
        WHERE id = $user_id ";

        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;

        if (mysqli_query($GLOBALS['con'], $sql)) {
            header("location: my_account.php");
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
    <title>Supravi</title>
</head>

<body>
    <?php
    include 'include/header.php';
    ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12 my-5 text-center">
                    <h1>My Account</h1>
                </div>
            </div>

            <div class="row pb-5">
                <div class="col-12 col-md-3">
                    <div class="list-group">
                        <a href="my_account.php?id=<?php echo $_SESSION['user_id']; ?>"
                            class=" list-group-item list-group-item-action active">Personal Info</a>
                        <a href="my_orders.php?id=<?php echo $_SESSION['user_id']; ?>"
                            class="list-group-item list-group-item-action">My Orders</a>
                    </div>
                </div>

                <div class="col-12 col-md-9">
                    <form action="" method="POST">
                        <input type='hidden' name='id' value="<?php echo $_SESSION['user_id']; ?>">
                        <div class=" row mb-3">
                            <div class="col-md-6">
                                <div class="text-danger"><?php echo $errors['firstname']; ?></div>
                                <label for="First Name">First Name</label>
                                <input type="text" name="firstname" class="form-control" placeholder="First Name"
                                    value="<?php echo $user['firstname']; ?>">
                            </div>
                            <div class="col-md-6">
                                <div class="text-danger"><?php echo $errors['lastname']; ?></div>
                                <label for="Last Name">Last Name</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name"
                                    value="<?php echo $user['lastname']; ?>">
                            </div>
                        </div>

                        <div class=" row mb-3">
                            <div class="col-md-6">
                                <div class="text-danger"><?php echo $errors['email']; ?></div>
                                <label for="Email">Email</label>
                                <input type="email" name="email" class="form-control mb-3" placeholder="Email"
                                    value="<?php echo $user['email']; ?>">
                            </div>
                            <div class="col-md-6">
                                <div class="text-danger"><?php echo $errors['phone']; ?></div>
                                <label for="Phone">Phone</label>
                                <input type="text" name="phone" class="form-control mb-3" placeholder="Phone"
                                    value="<?php echo $user['phone']; ?>">
                            </div>
                        </div>

                        <div class=" row mb-3">
                            <div class="col-md-12">
                                <div class="text-danger"><?php echo $errors['address']; ?></div>
                                <label for="Address">Address</label>
                                <input type="text" name="address" class="form-control mb-3" placeholder="Address"
                                    value="<?php echo $user['address']; ?>">
                            </div>
                        </div>

                        <input type="submit" name="update" class="btn btn-dark d-block mx-auto w-25 mt-5"
                            value="Save Changes">
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include 'include/footer.php'; ?>


    <script src=" http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"
        integrity="sha256-Y1rRlwTzT5K5hhCBfAFWABD4cU13QGuRN6P5apfWzVs=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="app.js"></script>