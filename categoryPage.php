
<?php include('pageHeader.php'); ?>

<section class="categories">
    <div class="container">
        <h2 class="text-center">Descopera categoriile</h2>

        <?php
        $sql = "SELECT * FROM categories";

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
                    <div class="box-4 float-container">
                        <?php
                        if($image_name=="")
                        {
                            echo "<div class='error'>Nu exista imagine</div>";
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                            <?php
                        }
                        ?>


                        <h3 class="text-border float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>

                <?php
            }
        }
        else
        {
            echo "<div class='error'>Nu s-au gasit categoriile</div>";
        }

        ?>


        <div class="clearfix"></div>
    </div>
</section>
