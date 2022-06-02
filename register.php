<?php include('pageHeader.php'); ?>
<?php
 
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Introduceti un nume de utilizator";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Numele de utilizator poate contine doar litere, numere si _";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($mysqli, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Numele de utilizator exista deja";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Eroare";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Introduceti o parola";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Parola trebuie sa contina cel putin 6 caractere";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirmati parola";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Parolele nu se potrivesc";
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($mysqli, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
        <input type="password" name="password" placeholder="Introduceti parola" class="input-responsive" value="<?php echo $password; ?>">
        <span class="error"><?php echo $password_err; ?></span>

        <div class="info-label">Confirmati parola</div>
        <input type="password" name="confirm_password" placeholder="Confirmati parola" class="input-responsive" value="<?php echo $confirm_password; ?>">
        <span class="error"><?php echo $confirm_password_err; ?></span>
        <br>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Inregistrare">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>

        <p>Aveti deja cont? <a href="login.php">Login</a></p>
    </fieldset>
</form>