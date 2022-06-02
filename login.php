<?php include('pageHeader.php'); ?>
<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

$username = $password = "";
$username_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Va rugam sa va introduceti numele de utilizator";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Va rugam sa va introduceti parola";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($mysqli, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            

                            header("location: userPage.php");
                        } else{
                            $login_err = "Nume utilizator sau parola invalide";
                        }
                    }
                } else{
                    $login_err = "Nume utilizator sau parola invalide";
                }
            } else{
                echo "Eroare";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($mysqli);
}
?>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="order">
    <fieldset class="login-input">
        <legend>Informatii</legend>
        <?php
        if(!empty($login_err)){
            echo '<div class="error">' . $login_err . '</div>';
        }
        ?>
        <div class="info-label">Nume utilizator</div>
        <input type="text" name="username" placeholder="Introduceti numele de utilizator" class="input-responsive" value="<?php echo $username; ?>">
        <span class="error"><?php echo $username_err; ?></span>

        <div class="info-label">Parola</div>
        <input type="password" name="password" placeholder="Introduceti parola" class="input-responsive">
        <span class="error"><?php echo $password_err; ?></span>
        <br>

        <input type="submit" class="btn btn-primary" value="Login">
        <p>Nu ai cont? <a href="register.php">Inregistreaza-te</a>.</p>
    </fieldset>
</form>