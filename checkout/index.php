<?php 
var_dump($_SESSION['user_id']);
    if(isset($_SESSION['id'])){
        $id = $_SESSION["user_id"];
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($GLOBALS['con'], $sql);
        $user = mysqli_fetch_assoc($result);
    }
        
?>
<?php session_start();
require('../include/server.php');
require_once('../include/products.php');

$con = connectDB();

$firstname = $lastname = $phone = $email = $address = $city  = $state = $zipcode = $cardname = $cardnumber = $cvv = "";

$errors = array('firstname' => '', 'lastname' => '', 'phone' => '', 'email' => '', 'address' => '', 'city' => '', 'state' => '', 'zipcode' => '', 'cardname' => '', 'cardnumber' => '', 'cvv' => '');

if (isset($_POST['checkout'])) {
    if (empty($_POST['firstname'])) {
        $errors['firstname'] = "A first name is required";
    } else {
        $firstname = $_POST['firstname'];
        if (!preg_match('/^[a-zA-Z\s]*$/', $firstname)) {
            $errors['firstname'] = "First name can contain only letters and whitespace";
        }
    }

    if (empty($_POST['lastname'])) {
        $errors['lastname'] = "A last name is required";
    } else {
        $lastname = $_POST['lastname'];
        if (!preg_match('/^[a-zA-Z\s]*$/', $lastname)) {
            $errors['lastname'] = "Last name can contain only letters and whitespace";
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
    if (empty($_POST['email'])) {
        $errors['email'] = "An email is required";
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email address";
        }
    }

    if (empty($_POST['address'])) {
        $errors['address'] = "An address is required";
    } else {
        $address = $_POST['address'];
        if (!preg_match('/^[#.0-9a-zA-Z\s,-]+$/', $address)) {
            $errors['address'] = "Invalid address";
        }
    }

    if (empty($_POST['city'])) {
        $errors['city'] = "A city is required";
    } else {
        $city = $_POST['city'];
        if (!preg_match('/^[a-zA-Z\s]*$/', $lastname)) {
            $errors['city'] = "Invalid city";
        }
    }

    if (empty($_POST['state'])) {
        $errors['state'] = "A state is required";
    } else {
        $state = $_POST['state'];
        if (!preg_match(
            '/^(?:A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])*$/',
            $state
        )) {
            $errors['state'] = "State can contain only capital letters and must be equal to two chars";
        }
    }

    if (empty($_POST['zipcode'])) {
        $errors['zipcode'] = "A zip code is required";
    } else {
        $zipcode = $_POST['zipcode'];
        if (!preg_match('/^([0-9]{5}(?:-[0-9]{4})?)*$/', $zipcode)) {
            $errors['zip_code'] = "Zip code can only be numbers and must be equal to 5 numbers";
        }
    }

    if (empty($_POST['cardname'])) {
        $errors['cardname'] = "A name is required";
    } else {
        $cardname = $_POST['cardname'];
        if (!preg_match('/^[a-zA-Z\s]*$/', $cardname)) {
            $errors['cardname'] = "Invalid credit card name";
        }
    }

    if (empty($_POST['cardnumber'])) {
        $errors['cardnumber'] = "A number is required";
    } else {
        $cardnumber = $_POST['cardnumber'];
        if (
            !preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $cardnumber) &&
            !preg_match('/^5[1-5][0-9]{14}$/', $cardnumber) &&
            !preg_match('/^3[47][0-9]{13}$/', $cardnumber) &&
            !preg_match('/^6(?:011|5[0-9]{2})[0-9]{12}$/', $cardnumber)
        ) {
            $errors['cardnumber'] = "Invalid credit card number";
        }
    }

    if (empty($_POST['cvv'])) {
        $errors['cvv'] = "A cvv is required";
    } else {
        $cvv = $_POST['cvv'];
        if (!preg_match('/^[0-9]{3,4}$/', $cvv)) {
            $errors['cvv'] = "Invalid cvv";
        }
    }

    if (array_filter($errors)) {
    } else {
        $total = 0;
        $tax = 5.00;
        if(isset($_SESSION['user_id'])){
            $user_id = mysqli_real_escape_string($GLOBALS['con'], $_SESSION['user_id']);
        }else{
            $user_id = rand();
        }
        $sql = "INSERT INTO orders(user_id) VALUES('$user_id')";
        mysqli_query($GLOBALS['con'], $sql);
        $order_id = mysqli_insert_id($GLOBALS['con']);
        foreach ($_SESSION['cart'] as $key => $value) { ?>
<?php
            $productid = mysqli_real_escape_string($GLOBALS['con'], $value['product_id']);
            $productprice = mysqli_real_escape_string($GLOBALS['con'], $value['product_price']);
            $qty = mysqli_real_escape_string($GLOBALS['con'], $value['item_quantity']);
            $productname = mysqli_real_escape_string($GLOBALS['con'], $value['item_name']);

            $total = $total + ($value['item_quantity'] * $value['product_price']);

            $sql = "INSERT INTO order_items(order_id,product_id,product_name, product_price, qty)
                VALUES('$order_id','$productid','$productname','$productprice','$qty')";
            if (mysqli_query($GLOBALS['con'], $sql)) {
            } else {
                echo 'query error: ' . mysqli_error($GLOBALS['con']);
            }
        }
        ?>
<?php
        $total = $total + $tax;
        $sql = "INSERT INTO payment(user_id, total_amount)  
            VALUES('$user_id', '$total')";
        if (mysqli_query($GLOBALS['con'], $sql)) {
            unset($_SESSION['cart']);
            header('location: /Supravi/' . 'place_order');
        } else {
            echo 'query error: ' . mysqli_error($GLOBALS['con']);
        }
    }
    ?>
<?php
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
    <link rel="stylesheet" href="../css/style.css">

    <title>Supravi</title>
</head>

<body>
    <?php
    include("../include/header.php")
    ?>

    <main class="pb-5 pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 ml-5 border form-group border rounded bg-white p-5">
                    <h2 class="text-center my-5">Billing Address</h2>
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-danger"><?php echo $errors['firstname']; ?></div>
                                <label for="fname">First Name</label>
                                <input type="text" id="firstname" class="form-control" name="firstname"
                                    placeholder="First name" value="<?php echo $user['firstname']?>">
                                <br>
                            </div>
                            <div class="col-md-6">
                                <div class="text-danger"><?php echo $errors['lastname']; ?></div>
                                <label for="lname">Last Name</label>
                                <input type="text" id="lastname" class="form-control" name="lastname"
                                    placeholder="Last name" value="<?php echo $user['lastname']?>">
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-danger"><?php echo $errors['phone']; ?></div>
                                <label for="lname">Phone</label>
                                <input type="text" id="phone" class="form-control" name="phone" placeholder="Phone"
                                    value="<?php echo $user['phone']?>">
                            </div>
                            <div class="col-md-6">
                                <div class="text-danger"><?php echo $errors['email']; ?></div>
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="Email"
                                    value="<?php echo $user['email']?>">
                                <br>
                            </div>
                            <br>
                        </div>
                        <div class="text-danger"><?php echo $errors['address']; ?></div>
                        <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                        <input type="text" id="adr" name="address" class="form-control" placeholder="Address"
                            value="<?php echo $user['address']?>">
                        <br>

                        <div class="row">
                            <div class="col-6">
                                <div class="text-danger"><?php echo $errors['city']; ?></div>
                                <label for="city"><i class="fa fa-institution"></i> City</label>
                                <input type="text" id="city" name="city" class="form-control" placeholder="City">
                            </div>
                            <div class="col-3">
                                <div class="text-danger"><?php echo $errors['state']; ?></div>
                                <label for="state">State</label>
                                <input type="text" id="state" name="state" class="form-control" placeholder="State">
                            </div>
                            <div class="col-3">
                                <div class="text-danger"><?php echo $errors['zipcode']; ?></div>
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" id="zip" name="zipcode" placeholder="Zip Code">
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox mt-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" checked
                                data-toggle="collapse" class="category" href="#shippingAddress" aria-expanded="false"
                                aria-controls="shippingCollapse" role="button">
                            <label class="custom-control-label" for="customCheck1">Save to the same address</label>
                            <ul class="sub-menu collapse shippingAddress" id="shippingAddress">
                                <li class="mt-3">
                                    <div class="text-danger"><?php echo $errors['address']; ?></div>
                                    <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                    <input type="text" id="adr" name="address2" class="form-control"
                                        placeholder="Address">
                                </li>
                                <li class="mt-3">
                                    <div class="text-danger"><?php echo $errors['state']; ?></div>
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state2" class="form-control"
                                        placeholder="State">
                                </li>
                                <li class="mt-3">
                                    <div class="text-danger"><?php echo $errors['city']; ?></div>
                                    <label for="city"><i class="fa fa-institution"></i> City</label>
                                    <input type="text" id="city" name="city2" class="form-control" placeholder="City">
                                </li>
                                <li class="mt-3">
                                    <div class="text-danger"><?php echo $errors['zipcode']; ?></div>
                                    <label for="zip">Zip</label>
                                    <input type="text" class="form-control" id="zip" name="zipcode2"
                                        placeholder="Zip Code">
                                </li>
                                <input class="mx-auto d-block w-25 btn btn-dark mt-5" type="submit" value="Submit">
                            </ul>
                        </div>
                </div>
                <div class="col-md-4 ml-4 bg-white p-4 border rounded">
                    <div class="container">
                        <h3 class="mb-5 text-center">Your Order
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $count = count($_SESSION['cart']);
                                echo "<span class=\"price\" style=\"color:black\">
                            <i class=\"fa fa-shopping-cart\"></i>($count items)
                            </span>";
                            } else {
                                echo "<span class=\"price\" style=\"color:black\">
                            <i class=\"fa fa-shopping-cart\"></i> 0
                            </span>";
                            } ?>
                        </h3>

                        <?php
                        $tax = 5.00;
                        if (!empty($_SESSION['cart'])) {
                            $total = 0;
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $name = $value['item_name'];
                                $qty = $value['item_quantity'];
                                $price = $value['product_price'];
                        ?>
                        <?php echo "
                        <div class=\"row\">
                            <div class=\"col-8 mb-2\">
                                <h6>$name</h6>
                                </div>
                                <div class=\"col-4 mb-2\">
                                <span class=\"text-muted mr-2\">$$price</span>
                                <i class=\"fas fa-times fa-xs\"></i> $qty
                            </div>
                        </div>
                       "; ?>

                        <?php
                                $total = $total + ($value['item_quantity'] * $value['product_price']);
                            } ?>

                        <hr>
                        <div class="row price-details">
                            <div class="col-md-6">
                                <h6>SubTotal</h6>
                                <h6>Tax</h6>
                                <h6>Delivery Charges</h6>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h6>$<?php echo number_format($total, 2); ?></h6>
                                <h6>$<?php echo $tax; ?></h6>
                                <h6 class="text-success">$0.00</h6>
                            </div>
                        </div>
                        <hr>
                        <h3 class="text-center font-weight-normal text-center my-4 py-2">$<?php $total = $total + $tax;
                                                                                                echo number_format($total, 2);
                                                                                                ?>
                        </h3>
                        <?php }
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="text-center">Credit Card</h5>
                                <div class="card-body">
                                    <div class="icon-container text-center mb-3">
                                        <i class="fab fa-2x fa-cc-visa" style="color:navy;"></i>
                                        <i class="fab fa-2x fa-cc-amex" style="color:blue;"></i>
                                        <i class="fab fa-2x fa-cc-mastercard" style="color:red;"></i>
                                        <i class="fab fa-2x fa-cc-discover" style="color:orange;"></i>
                                    </div>
                                    <label for="cname">Name on Card</label>
                                    <div class="text-danger"><?php echo $errors['cardname']; ?></div>
                                    <input type="text" id="cname" class="form-control" name="cardname"
                                        placeholder="Name on Card">
                                    <br>
                                    <label for="ccnum">Card number</label>
                                    <div class="text-danger"><?php echo $errors['cardnumber']; ?></div>
                                    <input type="text" id="ccnum" name="cardnumber" class="form-control"
                                        placeholder="Card Number">
                                    <br>
                                    <label for="expmonth">Exp Month</label>
                                    <select class="form-control" name="expmonth">
                                        <option value="Janurary">Janurary</option>
                                        <option value="Feburary">Feburary</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="expyear">Exp Year</label>
                                            <select class="form-control" name="expyear">
                                                <!-- <option value="2020">2020</option> -->
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="cvv">CVV</label>
                                            <div class="text-danger"><?php echo $errors['cvv']; ?></div>
                                            <input type="text" id="cvv" name="cvv" class="form-control"
                                                placeholder="CVV">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="checkout" class="mt-5 btn btn-dark btn-block" value="Place Order">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<?php include 'include/footer.php'; ?>
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
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