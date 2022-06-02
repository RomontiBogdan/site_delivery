
<?php include('pageHeader.php'); ?>

<?php
session_start();

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
else
{
    header("location: login.php");
}
?>

<section class="user-page">
    <div class="container">

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Informatii</legend>
                <div class="info-label">Nume utilizator</div>
                <input type="text" name="userName" placeholder="Nu sunteti logat" value="<?php if(isset($_SESSION["username"]))echo $_SESSION["username"]; ?>" class="input-responsive" readonly>

                <div class="info-label">Telefon</div>
                <input type="tel" name="phone" placeholder="Nu a fost salvat numarul de telefon" value="<?php if(!is_null($phone))echo $phone; else echo ""; ?>" class="input-responsive" required>

                <div class="info-label">Email</div>
                <input type="email" name="email" placeholder="Nu a fost salvata adresa de email" value="<?php if(!is_null($email))echo $email; else echo ""; ?>" class="input-responsive" required>

                <div class="info-label">Adresa</div>
                <input type="text" name="address" placeholder="Nu a fost salvata adresa" value="<?php if(!is_null($address))echo $address; else echo ""; ?>" class="input-responsive" required>

                <input type="submit" name="submit" value="Salveaza" class="btn btn-primary">
                <a href="logout.php" class="btn btn-logout">Iesi din cont</a>
            </fieldset>

        </form>

        <?php

        if(isset($_POST['submit']))
        {

            $phoneP = $_POST['phone'];
            $emailP = $_POST['email'];
            $addressP = $_POST['address'];

            $sql2 = "UPDATE users SET address = '$addressP', phone = '$phoneP', email = '$emailP' WHERE username = '$userName'";

            mysqli_query($mysqli, $sql2);

            header("location: userPage.php");

        }

        ?>

    </div>
</section>
