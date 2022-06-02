
<?php include('pageHeader.php'); ?>

<?php session_start(); ?>

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
        <?php
    } else {
        ?>
        <div class="no-records">Cosul este gol</div>
        <?php
    }
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    {
        $userName = $_SESSION['username'];
        $sql = "SELECT * FROM users WHERE username='$userName'";
        $res = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_assoc($res);
        $phone = $row['phone'];
        $email = $row['email'];
        $address = $row['address'];
    }
    ?>
</div>

<!-- fOOD sEARCH Section Starts Here -->
<section class="order-page">
    <div class="container">

        <h2 class="text-center text-white">Informatii livrare</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Informatii</legend>
                <div class="order-label">Nume</div>
                <input type="text" name="userName" placeholder="Nu sunteti logat" value="<?php if(isset($_SESSION["username"]))echo $_SESSION["username"]; ?>" class="input-responsive" required>

                <div class="info-label">Telefon</div>
                <input type="tel" name="phone" placeholder="Nu a fost salvat numarul de telefon" value="<?php  if(isset($_SESSION["username"])){if(!is_null($phone))echo $phone; else echo "";}else echo ""; ?>" class="input-responsive" required>

                <div class="info-label">Adresa</div>
                <input type="text" name="address" placeholder="Nu a fost salvata adresa" value="<?php if(isset($_SESSION["username"])){if(!is_null($address))echo $address; else echo "";}else echo ""; ?>" class="input-responsive" required>

                <input type="submit" name="order" value="Comanda" class="btn btn-primary">
            </fieldset>

        </form>

        <?php

        //CHeck whether submit button is clicked or not
        if(isset($_POST['order']))
        {

            $order_date = date("Y-m-d H:i:s");
            $name = $_POST['userName'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            $sqlorder = "INSERT INTO orders (OrderDate, ClientName, ClientPhone, ClientAddress) VALUES ('$order_date', '$name', '$phone', '$address')";


            $res = mysqli_query($mysqli, $sqlorder);

            if($res==true)
            {
                ?>
                <div class='success text-center login-input'>Food Ordered Successfully.</div>
                <?php $orderId = mysqli_insert_id($mysqli);
            }
            else
            {
                ?>
                <div class='error text-center login-input'>Failed to Order Food.</div>
            <?php
            }

            foreach ($_SESSION["cart_item"] as $item){
                $itemId = $item["Id"];
                $itemQuantity = $item["Quantity"];
                $sqlfood = "INSERT INTO orderedfood (FoodId, Quantity, OrderId) VALUES ('$itemId', '$itemQuantity', '$orderId')";
                mysqli_query($mysqli, $sqlfood);
            }

            $sqluser = "INSERT INTO ordertouser (IdOrder, IdUser) VALUES ('$orderId', 1)";
           // mysqli_stmt_bind_param($sqlfood, "i", $orderId);

            mysqli_query($mysqli, $sqluser);
            unset($_SESSION["cart_item"]);
        }

        ?>

    </div>
</section>
