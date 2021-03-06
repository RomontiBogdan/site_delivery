
<?php include('pageHeader.php'); ?>
<?php
if(isset($_GET['category_id']))
{
    $category_id = $_GET['category_id'];
    $sql = "SELECT title FROM categories WHERE id=$category_id";

    $res = mysqli_query($mysqli, $sql);

    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
}
else
{
    header('location:'.SITEURL);
}
?>


<section class="food-search text-center">
    <div class="container">

        <h2><a href="#" class="text-white text-border">Preparate din categoria "<?php echo $category_title; ?>"</a></h2>

    </div>
</section>



<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

        $sql2 = "SELECT * FROM food WHERE category_id=$category_id";

        $res2 = mysqli_query($mysqli, $sql2);

        $count2 = mysqli_num_rows($res2);

        if($count2>0)
        {
            while($row2=mysqli_fetch_assoc($res2))
            {
                $id = $row2['Id'];
                $title = $row2['Title'];
                $price = $row2['Price'];
                $description = $row2['Description'];
                $image_name = $row2['Image_name'];
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
            echo "<div class='error'>Nu exista preparatul</div>";
        }

        ?>



        <div class="clearfix"></div>



    </div>

</section>
