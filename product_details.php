<?php
session_start();
require('include/server.php');
include ('include/header.php');
require_once('include/products.php');
$con = connectDB();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = mysqli_query($GLOBALS['con'], $sql);
    $product = mysqli_fetch_assoc($result);
}

if (isset($_POST["add"])) {
    if (isset($_SESSION["cart"])) {
        $item_array_id = array_column($_SESSION["cart"], "product_id");
        if (!in_array($_POST['id'], $item_array_id)) {
            $count = count($_SESSION["cart"]);
            $item_array = array(
                'product_id' => $_POST['id'],
                'item_quantity' => $_POST['qty'],
                'item_name' => $_POST['hidden_name'],
                'product_price' => $_POST['hidden_price'],
                'product_img' => $_POST['hidden_img']
            );
            $_SESSION["cart"][$count] = $item_array;
            echo "<script>alert('Product added cart')</script>";
            header('location: /Supravi/' . '/cart');
        } else {
            echo "<script>alert('Product is already in the cart')</script>";
            header('location: /Supravi/' . '/cart');
        }
    } else {
        $item_array = array(
            'product_id' => $_POST['id'],
            'item_quantity' => $_POST['qty'],
            'item_name' => $_POST['hidden_name'],
            'product_price' => $_POST['hidden_price'],
            'product_img' => $_POST['hidden_img']
        );
        $_SESSION["cart"][0] = $item_array;
        echo "<script>alert('Product added cart')</script>";
        header('location: /Supravi/' . '/cart');
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
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $product['product_name']; ?></title>

</head>

<body>
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <form action="" method="POST">
                        <input type="hidden" name="id" value='<?php echo $product['id']; ?>' ;>
                        <input type="hidden" name="hidden_name" value='<?php echo $product['product_name']; ?>' ;>
                        <input type="hidden" name="hidden_price" value='<?php echo $product['product_price']; ?>' ;>
                        <input type="hidden" name="hidden_img" value='<?php echo $product['product_img']; ?>' ;>
                        <img src="<?php echo $product['product_img']; ?>" class="img-fluid product-img"
                            alt="product-img">
                </div>

                <div class="col-12 col-md-6">
                    <h1 class="product-name"><?php echo $product['product_name']; ?></h1>
                    <h5 class="product-price">$<?php echo $product['product_price']; ?></h5>
                    <div class="rate text-warning">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas blanditiis unde
                        dolorem ipsum
                        veritatis, rerum quasi placeat ratione praesentium eos, vero autem magnam veniam rem, mollitia
                        expedita labore aliquid facilis ad culpa nisi aut animi totam sint. Impedit molestiae tempora
                        eius inventore ex, atque saepe voluptatem assumenda consequuntur rerum distinctio incidunt odit
                        obcaecati mollitia quasi. Deserunt corporis doloribus porro nisi laudantium dolorem distinctio
                        in aspernatur? Quis voluptatem sequi deserunt, eaque earum quibusdam ipsam vitae fuga!</p>

                    <span class="qty">Qty</span>
                    <input type="number" name="qty" class="form-control w-25" id="qty" value="1" max="10" min="1"> <br>
                    <input type="submit" name="add" class="btn btn-dark mt-5 d-block w-50 mx-auto" value="Add To Cart">
                </div>
                </form>
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