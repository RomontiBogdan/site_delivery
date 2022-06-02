<?php
require_once "config.php";
if(isset($_SESSION['order']))
{
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>
<?php include('pageHeader.php'); ?>


<section class="categories">
    <div class="container">
        <h2 class="text-center">Descopera categoriile noastre</h2>

        <?php
        $sql = "SELECT * FROM categories ORDER BY Id DESC LIMIT 3";
        $res = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($res);

        if($count>0)
        {
            while($row=mysqli_fetch_assoc($res))
            {
                $id = $row['Id'];
                $title = $row['Title'];
                $image_name = $row['Image_name'];

                ?>

                <a href="<?php echo SITEURL; ?>categoryContainer.php?category_id=<?php echo $id; ?>">
                <div class="box-3 float-container">
                    <?php
                    if($image_name=="")
                    {
                        echo $count;
                    }
                    else
                    {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"class="img-responsive img-curve">
                        <?php
                    }
                    ?>


                    <h3 class="float-text text-white" ><mark style="background-color:white;"><?php echo $title; ?></mark></h3>
                </div>

                <?php
            }
        }
        else
        {
            echo "<div class='error'>Categoria nu a fost adaugata</div>";
        }
        ?>


        <div class="clearfix"></div>
    </div>
</section>



<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Meniu</h2>

        <?php

        $sql2 = "SELECT * FROM food LIMIT 6";

        $res2 = mysqli_query($mysqli, $sql2);

        $count2 = mysqli_num_rows($res2);

        if($count2>0)
        {
            while($row=mysqli_fetch_assoc($res2))
            {
                $id = $row['Id'];
                $title = $row['Title'];
                $price = $row['Price'];
                $description = $row['Description'];
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

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?> Lei</p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>
                    </div>
                </div>

                <?php
            }
        }
        else
        {
            echo "<div class='error'>Preparat indisponibil</div>";
        }

        ?>





        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="<?php echo SITEURL; ?>menuPage.php">Vezi tot meniul</a>
    </p>
</section>



