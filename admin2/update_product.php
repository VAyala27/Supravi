<?php
require('../include/server.php');
$con = connectDB();

$product_name = $product_price = $product_img = $product_img = $category_id = '';
$errors = array('product_name' => '', 'product_price' => '', 'product_img' => '', 'category_id' => '');


if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = mysqli_query($GLOBALS['con'], $sql);
    $product = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id = $_GET["id"];
    if (empty($_POST['product_name'])) {
        $errors['product_name'] = "A name is required";
    }
    if (empty($_POST['product_price'])) {
        $errors['product_price'] = "A price is required";
    } else {
        $product_price = $_POST['product_price'];
        if (!preg_match('/^\d+(?:\.\d{0,2})?$/', $product_price)) {
            $errors['product_price'] = "Price format";
        }
    }

    if (empty($_POST['category_id'])) {
        $errors['product_price'] = "A price is required";
    }

    if (array_filter($errors)) {
    } else {
        $product_name = mysqli_real_escape_string($GLOBALS['con'], $_POST['product_name']);
        $product_price = mysqli_real_escape_string($GLOBALS['con'], $_POST['product_price']);
        $category_id = mysqli_real_escape_string($GLOBALS['con'], $_POST['category_id']);
        $product_img  = 'img/' . basename($_FILES['product_img']['name']);

        $sql = "UPDATE products SET product_img = '$product_img',product_name = '$product_name',product_price = '$product_price',category_id = '$category_id' WHERE id = $id";


        if (mysqli_query($GLOBALS['con'], $sql)) {
            header("location: item_management.php");
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

    <title>Supravi</title>
</head>

<body>
    <?php include 'include/admin_nav.php'; ?>

    <main>
        <div class="row justify-content-center align-items-center height-100">
            <div class="col-md-6 offset-md-3 px-0">
                <h1 class="text-center mt-5">Update Items</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group mx-auto">
                        <div class="text-danger"><?php echo $errors['product_name']; ?></div>
                        <label for="product_name">Name of item:</label>
                        <input type=" text" name="product_name" class="form-control" id="product_name"
                            placeholder="Name of item"
                            value="<?php echo htmlspecialchars($product['product_name']); ?>"><br>

                        <div class="text-danger"><?php echo $errors['product_price']; ?></div>
                        <label for="Price">Price: </label>
                        <input type="text" name="product_price" class="form-control" id="product_price"
                            placeholder="Price" value="<?php echo htmlspecialchars($product['product_price']); ?>"><br>

                        <div class="text-danger"><?php echo $errors['product_img']; ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Example file input</label>
                            <input type="file" name="product_img" class="form-control-file"
                                id="exampleFormControlFile1">
                        </div>

                        <div class="text-danger"><?php echo $errors['category_id']; ?></div>
                        <label for="category_id">Category Id:</label>
                        <select class="form-control" name="category_id">
                            <option value="1">1. Women Dress</option>
                            <option value="2">2. Women Tops</option>
                            <option value="3">3. Women Suits</option>
                            <option value="4">4. Women Sweaters</option>
                            <option value="5">5. Women Jackets</option>
                            <option value="6">6. Women Pants</option>
                            <option value="7">7. Women Skirts</option>
                            <option value="8">8. Men T-shirts</option>
                            <option value="9">9. Men Suits</option>
                            <option value="10">10. Men Sweaters</option>
                            <option value="11">11. Men Jackets</option>
                            <option value="12">12. Men Pants</option>
                            <option value="13">13. Men Shorts</option>
                            <option value="14">14. Women Boots</option>
                            <option value="15">15. Women Heels</option>
                            <option value="16">16. Men Sneakers</option>
                            <option value="17">17. Women Watches</option>
                            <option value="18">18. Women Bags</option>
                            <option value="19">19. Men Watches</option>
                            <option value="20">20. Men Bags</option>
                        </select>
                        <br>
                        <input type="submit" value="Update" class="btn btn-dark mx-auto w-25 d-block mb-5"
                            name="update">
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

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