<?php
function Item($productname, $productprice, $productimg, $id)
{
    $element = "
    <div class=\"col-6 col-sm-6 col-md-3 col-lg-3 product\">
    <form action=\"\" method=\"POST\">
    <input type='hidden' name = 'id' value='$id';>
                        <div class=\"card\">
                        <a class=\"text-dark\" href=\"product_details.php?id=$id\">
                            <img src=\"$productimg\" class=\"img-fluid w-100 product-img d-block\" alt=\"product-img\">
                            </a>
                            <div class=\"card-section text-center\">
                                <a class=\"text-dark\" href=\"product.php?id=$id\">$productname</a>
                                <p class=\"product-price\">$$productprice</p>
                            </div>
                        </div>
                        </form>
                    </div>
    ";
    echo $element;
}

function Item2($productname, $productprice, $productimg, $id)
{
    $element = "
    <div class=\"col-6 col-sm-6 col-md-4 col-lg-4 product\">
    <form action=\"\" method=\"POST\">
    <input type='hidden' name = 'id' value='$id';>
                        <div class=\"card mb-5\">
                            <a class=\"text-dark\" href=\"product_details.php?id=$id\">
                            <img src=\"$productimg\" class=\"img-fluid w-100 product-img d-block\" alt=\"product-img\">
                            </a>
                            <div class=\"card-section text-center\">
                            <a class=\"text-dark\" href=\"product.php?id=$id\">$productname</a>
                                <p class=\"product-price\">$$productprice</p>
                                </div>
                            </div>
                                 </form>
                        </div>
                        ";
    echo $element;
}