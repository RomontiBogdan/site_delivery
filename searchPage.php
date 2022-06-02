
<?php include('pageHeader.php'); ?>

<section class="food-search text-center">
    <div class="container">
        <?php
        $search = $_POST['search'];
        ?>
        <h2><a href="#" class="text-white">Rezultate pentru "<?php echo $search; ?>"</a></h2>
    </div>
</section>


<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        $sql = "SELECT * FROM food WHERE Title LIKE '%$search%' OR Description LIKE '%$search%'";
        $res = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($res);
        if($count>0)
        {
            while($row=mysqli_fetch_assoc($res))
            {
                //Get the details
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
                        <p class="food-price">$<?php echo $price; ?></p>
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
            echo "<div class='error'>Nu s-au adaugat preparate</div>";
        }

        ?>

        <div class="clearfix"></div>

    </div>

</section>
