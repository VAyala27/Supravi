<?php
if (isset($_POST['search_button'])) {
    if (empty($_POST['search_bar'])) {
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header("location: $url");
    }
}
?>
<nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom">
    <div class="container">
        <a href="<?php echo '/Supravi/'; ?>" class="navbar-brand">Supravi</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="<?php echo '/Supravi/'; ?>" class="nav-link">Home</a>
                </li>
                <li class="nav-item dropdown menu-area">
                    <a href="#" class="nav-link dropdown-toggle" id="mega-one" data-toggle="dropdown">Shop</a>
                    <div class="dropdown-menu mega-area" aria-labelledby="mega-one">
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <h5>Women's Collection</h5>
                                <a href="<?php echo '/Supravi/' . 'products/all_women_clothing.php '; ?>"
                                    class="dropdown-item">All Women's Clothing</a>
                                <a href="<?php echo '/Supravi/' . 'products/women_dresses.php '; ?>"
                                    class="dropdown-item">Dresses</a>
                                <a href="<?php echo '/Supravi/' . 'products/women_tops.php '; ?>"
                                    class="dropdown-item">Tops</a>
                                <a href="<?php echo '/Supravi/' . 'products/women_suits.php '; ?>"
                                    class="dropdown-item">Suits</a>
                                <a href="<?php echo '/Supravi/' . 'products/women_sweaters.php '; ?>"
                                    class="dropdown-item">Sweaters</a>
                                <a href="<?php echo '/Supravi/' . 'products/women_jackets.php '; ?>"
                                    class="dropdown-item">Jackets</a>
                                <a href="<?php echo '/Supravi/' . 'products/women_pants.php '; ?>"
                                    class="dropdown-item">Pants</a>
                                <a href="<?php echo '/Supravi/' . 'products/women_skirts.php '; ?>"
                                    class="dropdown-item">Skirts</a>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <h5>Men's Collection</h5>
                                <a href="<?php echo '/Supravi/' . 'products/all_men_clothing.php '; ?>"
                                    class="dropdown-item">All Men's Clothing</a>
                                <a href="<?php echo '/Supravi/' . 'products/men_shirts.php '; ?>"
                                    class="dropdown-item">T-shirts</a>
                                <a href="<?php echo '/Supravi/' . 'products/men_suits.php '; ?>"
                                    class="dropdown-item">Suits</a>
                                <a href="<?php echo '/Supravi/' . 'products/men_sweaters.php '; ?>"
                                    class="dropdown-item">Hoodies & Sweaters</a>
                                <a href="<?php echo '/Supravi/' . 'products/men_jackets.php '; ?>"
                                    class="dropdown-item">Jackets</a>
                                <a href="<?php echo '/Supravi/' . 'products/men_pants.php '; ?>"
                                    class="dropdown-item">Pants</a>
                                <a href="<?php echo '/Supravi/' . 'products/men_shorts.php '; ?>"
                                    class="dropdown-item">Shorts</a>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <h5>Women Shoes</h5>
                                <a href="<?php echo '/Supravi/' . 'products/women_boots.php '; ?>"
                                    class="dropdown-item">Boots</a>
                                <a href="<?php echo '/Supravi/' . 'products/women_heels.php '; ?>"
                                    class="dropdown-item">Heels</a>
                                <br>
                                <h5>Men's Shoes</h5>
                                <a href="<?php echo '/Supravi/' . 'products/men_sneakers.php '; ?>"
                                    class="dropdown-item">Sneakers</a>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <h5>Women Accessories</h5>
                                <a href="<?php echo '/Supravi/' . 'products/women_watches.php '; ?>"
                                    class="dropdown-item">Watches</a>
                                <a href="<?php echo '/Supravi/' . 'products/women_bags.php '; ?>"
                                    class="dropdown-item">Bags</a>
                                <br>
                                <h5>Men Accessories</h5>
                                <a href="<?php echo '/Supravi/' . 'products/men_watches.php '; ?>"
                                    class="dropdown-item">Watches</a>
                                <a href="p<?php echo '/Supravi/' . 'products/men_bags.php '; ?>"
                                    class="dropdown-item">Bags</a>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <a class="text-center d-block btn btn-outline-dark py-2 mt-3"
                                    href="<?php echo '/Supravi/' . 'products/all_products.php '; ?>"
                                    class="dropdown-item">View All</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

            <ul class="ml-auto mt-3 icons d-flex justify-content-center align-items-center">
                <form action="<?php echo '/Supravi/' . 'search/ '; ?>" method="POST" name="search" class="form-inline">
                    <input class="form-control mr-2" type="search" name="search_bar" placeholder="Search"
                        id="search_item" aria-label="Search">
                    <button class="btn btn-outline-dark my-2 my-sm-0 mr-4" type="submit"
                        name="search_button">Search</button>
                </form>

                <div class="btn-group">
                    <button class="btn btn-sm dropdown-toggle mr-3 bg-white border-none" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="far fa-user"></i>
                    </button>
                    <div class="dropdown-menu">
                        <?php if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) : ?>
                        <h5 class='py-2 text-center border-bottom'>
                            <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?>
                        </h5>
                        <a href="my_account.php?id=<?php echo $_SESSION['user_id']; ?>"
                            class="text-center text-dark d-block">My Account</a> <br>
                        <a href="index.php?logout='1'" class="text-center text-dark d-block">Logout</a>
                        <?php endif ?>
                        <?php if ($_SESSION['firstname'] == '' && $_SESSION['lastname'] == '') : ?>
                        <a href="<?php echo '/Supravi/' . '/register'; ?>" class=" text-center text-dark
                            d-block">Register</a> <br>
                        <a href="<?php echo '/Supravi/' . '/login'; ?>" class=" text-center text-dark
                            d-block">Login</a>
                        <?php endif ?>
                    </div>
                </div>
                <a href="<?php echo '/Supravi/' . 'cart'; ?>" id="shopping-cart" class="mr-3"><i
                        class="fas fa-shopping-cart"></i>
                    <?php
                    if (isset($_SESSION['cart'])) {
                        $count = count($_SESSION['cart']);
                        echo "<span class='counter'>$count</span>";
                    } else {
                        echo "<span class='counter'>0</span>";
                    }
                    ?>
                </a>
            </ul>
        </div>
    </div>
</nav>