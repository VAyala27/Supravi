<?php session_start();
require_once('server.php');
include 'include/add_to_cart.php';

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
    <link rel="stylesheet" href="style.css">
    <title>Supravi</title>
</head>

<body>

    <?php include 'include/header.php'; ?>
    <div class="container my-5">
        <div class="row">
            <?php
            if (isset($_POST['search_button'])) {
                $search = htmlspecialchars($_POST['search_bar']);
                $result = getDataSearch($search);
                $queryResult = mysqli_num_rows($result);
                if ($queryResult == 0) {
                    echo "<div class='col-12 height-100'>
                    <h2 class='text-center mb-5'> There are " . 0 . " results! </h2>
                    </div>";
                } else {
                    echo "<div class='col-12'>
                    <h2 class='text-center mb-5'> There are " . $queryResult . " results! </h2>
                    </div>";
                }
                while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-6 col-sm-6 col-md-3 col-lg-3 product">
                <form action="index.php" method="POST">
                    <input type='hidden' name='id' value='<?php echo $row['id']; ?>' ;>
                    <div class="card mb-5">
                        <a href="product_details.php?id=<?php echo $row['id']; ?>">
                            <img src="<?php echo $row['product_img']; ?>" class="img-fluid w-100 product-img d-block"
                                alt="product-img">
                        </a>
                        <div class="card-section text-center">
                            <a class="text-dark"
                                href="product.php?id=<?php echo $row['id']; ?>"><?php echo $row['product_name']; ?> </a>
                            <p class="product-price">$<?php echo $row['product_price']; ?></p>
                        </div>
                    </div>
                </form>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
    <?php include 'include/footer.php'; ?>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous">
    </script>
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