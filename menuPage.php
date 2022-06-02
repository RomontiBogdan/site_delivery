
<?php include('pageHeader.php'); ?>

<?php
session_start();


if(isset($_GET['action']))
{
    $action = $_GET['action'];
    switch ($action){
        case "add":
            if(!empty($_POST["quantity"])) {
                $sql = "SELECT * FROM food WHERE id='" . $_GET["Id"] . "'";

                $res=mysqli_query($mysqli, $sql);
                $productById = $res->fetch_assoc();

                $itemArray = array($productById["Id"]=>array('Title'=>$productById["Title"], 'Id'=>$productById["Id"], 'Quantity'=>$_POST["quantity"], 'Price'=>$productById["Price"], 'Image_name'=>$productById["Image_name"]));

                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($productById["Id"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($productById["Id"] == $k) {
                                if(empty($_SESSION["cart_item"][$k]["Quantity"])) {
                                    $_SESSION["cart_item"][$k]["Quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["Quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                    }
                }else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}

if(isset($_POST['sort']))
{
    $sort = $_POST['sort'];
    switch ($sort){
        case "0":
            $sql = "SELECT * FROM food";
            break;
        case "1":
            $sql = "SELECT * FROM food ORDER BY PRICE ASC";
            break;
        case "2":
            $sql = "SELECT * FROM food ORDER BY PRICE DESC";
            break;
    }
} else {
    $sql = "SELECT * FROM food";
}
?>



<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>searchPage.php" method="POST">
            <input type="search" name="search" placeholder="Cauta preparatul" required>
            <input type="submit" name="submit" value="Cauta" class="btn btn-primary">
        </form>

    </div>
</section>

<div id="shopping-cart">
    <div class="txt-heading">Cos</div>

    <a id="btnEmpty" href="menuPage.php?action=empty">Goleste cosul</a>
    <?php
    if(isset($_SESSION["cart_item"])){
        $total_quantity = 0;
        $total_price = 0;
        ?>
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
            <tr>
                <th style="text-align:left;">Nume produs</th>
                <th style="text-align:left;">Id</th>
                <th style="text-align:right;" width="5%">Cantitate</th>
                <th style="text-align:right;" width="10%">Pret/portie</th>
                <th style="text-align:right;" width="10%">Pret</th>
                <th style="text-align:center;" width="5%">Sterge</th>
            </tr>
            <?php
            foreach ($_SESSION["cart_item"] as $item){
                $item_price = $item["Quantity"]*$item["Price"];
                ?>
                <tr>
                    <td><img src="<?php echo SITEURL; ?>images/food/<?php echo $item["Image_name"]; ?>" class="img-cart-item"><?php echo $item["Title"]; ?></td>
                    <td><?php echo $item["Id"]; ?></td>
                    <td style="text-align:right;"><?php echo $item["Quantity"]; ?></td>
                    <td style="text-align:right;"><?php echo $item["Price"]." lei"; ?></td>
                    <td style="text-align:right;"><?php echo number_format($item_price,2)." lei"; ?></td>
                    <td style="text-align:center;"><a href="menuPage.php?action=remove&code=<?php echo $item["Id"]; ?>" class="btnRemoveAction"><img src="<?php echo SITEURL; ?>images/icon-delete.png" alt="Sterge produs" /></a></td>
                </tr>
                <?php
                $total_quantity += $item["Quantity"];
                $total_price += ($item["Price"]*$item["Quantity"]);
            }
            ?>

            <tr>
                <td colspan="2" align="right">Total:</td>
                <td align="right"><?php echo $total_quantity; ?></td>
                <td align="right" colspan="2"><strong><?php echo number_format($total_price, 2)." lei"; ?></strong></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <a id="btnOrder" href="order.php">Comanda</a>
        <?php
    } else {
        ?>
        <div class="no-records">Cosul este gol</div>
        <?php
    }
    ?>
</div>

<section class="food-menu">
    <div class="container">

        <h2 class="text-center">Meniu</h2>

        <?php
        $sql = "SELECT * FROM food";
        $res=mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($res);

        if($count>0)
        {
            while($row=mysqli_fetch_assoc($res))
            {
                $id = $row['Id'];
                $title = $row['Title'];
                $description = $row['Description'];
                $price = $row['Price'];
                $image_name = $row['Image_name'];
                ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if($image_name=="")
                        {
                            echo "<div class='error'>Nu exista imagine</div>";
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                            <?php
                        }
                        ?>

                    </div>

                    <form class="food-menu-desc" method="post" action="menuPage.php?action=add&Id=<?php echo $id; ?>">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?> lei</p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Adauga in cos" class="btn-cart btn-primary" /></div>
                    </form>
                </div>

                <?php
            }
        }
        else
        {
            echo "<div class='error'>Nu s-au adaugat preparate</div>";
        }
        ?>


        <div class="clearfix"></div>
    </div>

</section>
