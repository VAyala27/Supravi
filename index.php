<?php session_start();
require('include/server.php');
require_once('include/products.php');
// include 'include/add_to_cart.php';
$con = connectDB();
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
    <title>Supravi</title>
    <!-- <script>
    setTimeout(wakeUpUser, 5000);

    function wakeUpUser() {
        alert("Are you going to stare at this boring page forever?");
    }
    </script> -->
</head>

<body>
    <?php
    include 'include/header.php';
    ?>
    <main>
        <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/banner5.jpg" class="img-fluid" alt="banner_img">
                </div>
                <div class="carousel-item">
                    <a href="men_suits.php">
                        <img src="img/banner6.jpg" class="img-fluid" alt="banner_img">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="women_bags.php">
                        <img src="img/banner3.jpg" class="img-fluid" alt="banner_img">
                        <div class="carousel-caption">
                    </a>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
        </div>

        <div class="container mt-5">
            <div class="box-container">
                <div class="box box-1">
                    <img src="img/spring-event.jpg" class="img-fluid" alt="">
                </div>
                <div class="box box-2">
                    <div class="img-container">
                        <a href="<?php echo '/Supravi/' . 'products/women_suits.php '; ?>">
                            <img src="img/suit-separates.jpg" class="img-fluid" alt="women_suits_img">
                        </a>
                        <a href="<?php echo '/Supravi/' . 'products/women_suits.php '; ?>"
                            class="text-center d-block text-dark">Suit Separates</a>
                    </div>
                </div>
                <div class="box box-3">
                    <a href="<?php echo '/Supravi/' . 'products/women_tops.php '; ?>">
                        <img src="img/tops.jpg" class="img-fluid" alt="women_tops_imgs">
                    </a>
                    <a href="<?php echo '/Supravi/' . 'products/women_tops.php '; ?>"
                        class="text-center d-block text-dark">Tops</a>
                </div>
                <div class="box box-4">
                    <a href="<?php echo '/Supravi/' . 'products/women_heels.php '; ?>">
                        <img src="img/dress-shoes.jpg" class="img-fluid" alt="Dresses">
                    </a>
                    <a href="<?php echo '/Supravi/' . 'products/women_heels.php '; ?>"
                        class="text-center d-block text-dark">Heels & Pumps</a>
                </div>
                <div class="box box-5">
                    <a href="<?php echo '/Supravi/' . 'products/women_bags.php '; ?>">
                        <img src="img/handbags-wallets.jpg" class="img-fluid" alt="women_bags_img">
                    </a>
                    <a href="<?php echo '/Supravi/' . 'products/women_bags.php '; ?>"
                        class="text-center d-block text-dark">Handbags</a>
                </div>
            </div>
        </div>

        <a href="men_sneakers.php">
            <img src="https://boombah.scene7.com/is/image/boombah/footwear-mens-banner-2?$fullsize$" class="img-fluid"
                alt="men_sneakers_img">
        </a>

        <div class="container mt-5">
            <div class="box-container">
                <div class="box box-1">
                    <img src="img/banner-discount.jpg" class="img-fluid" alt="discount_banner_img">
                </div>
                <div class="box box-2">
                    <a href="<?php echo '/Supravi/' . 'products/men_suits.php '; ?>">
                        <img src="img/sport-coat.jpg" class="img-fluid" alt="men_suits_img">
                    </a>
                    <a href="<?php echo '/Supravi/' . 'products/men_suits.php '; ?>"
                        class="text-center d-block text-dark">Suits</a>
                </div>
                <div class="box box-3">
                    <a href="<?php echo '/Supravi/' . 'products/men_shirts.php '; ?>">
                        <img src="img/dress-shirts.jpg" class="img-fluid" alt="men_shirts_img">
                    </a>
                    <a href="<?php echo '/Supravi/' . 'products/men_shirts.php '; ?>"
                        class="text-center d-block text-dark">Shirts</a>
                </div>
                <div class="box box-4">
                    <a href="<?php echo '/Supravi/' . 'products/men_accessories.php '; ?>">
                        <img src="img/accessories.jpg" class="img-fluid" alt="men_accesssories_img">
                    </a>
                    <a href="<?php echo '/Supravi/' . 'products/men_accessories.php '; ?>"
                        class="text-center d-block text-dark">Accessories</a>
                </div>
            </div>
        </div>

        <a href="women_dresses.php">
            <img src="img/dress-code.jpg" class="img-fluid" alt="">
        </a>

        <div class="container">
            <h1 class="text-center mt-5">Top Products</h1>
            <div class="row py-5">
                <?php
                $result = getDataID(2);
                while ($row = mysqli_fetch_assoc($result)) {
                    Item($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                }
                ?>

                <?php
                $result = getDataID(52);
                while ($row = mysqli_fetch_assoc($result)) {
                    Item($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                }
                ?>

                <?php
                $result = getDataID(22);
                while ($row = mysqli_fetch_assoc($result)) {
                    Item($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                }
                ?>

                <?php
                $result = getDataID(67);
                while ($row = mysqli_fetch_assoc($result)) {
                    Item($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                }
                ?>

            </div>
            <h1 class="text-center mt-5">Popular Products</h1>
            <div class="row py-5">
                <?php
                $result = getDataID(88);
                while ($row = mysqli_fetch_assoc($result)) {
                    Item($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                }
                ?>
                <?php
                $result = getDataID(4);
                while ($row = mysqli_fetch_assoc($result)) {
                    Item($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                }
                ?>
                <?php
                $result = getDataID(106);
                while ($row = mysqli_fetch_assoc($result)) {
                    Item($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                }
                ?>
                <?php
                $result = getDataID(24);
                while ($row = mysqli_fetch_assoc($result)) {
                    Item($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                }
                ?>
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