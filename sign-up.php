<?php

$pdo = new PDO('mysql:host=localhost; port=3306; dbname=movie-site', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




function email_validation($email) {
    return (!preg_match(
"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email))
        ? FALSE : TRUE;
}
$username = '';
$email = '';
$password = '';
$password2 = '';

$usernameErrors[] = '';
$emailErrors[] = '';
$passwordErrors[] = '';

$usernameERROR = '';
$usernameSUCCES = '';


$emailERROR = '';
$emailSUCCES = '';

$passwordERROR = '';
$passwordSUCCES = '';

$password2ERROR = '';
$password2SUCCES = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if(!$username){
        $usernameERROR = 'error';
        $usernameErrors[] = 'Username can not be empty';
    }else{
        if(!preg_match('/^\w{5,}$/', $username)) {
            $usernameErrors[] = 'Username bust be alphanumeric & longer than 5 chars';
        }else{
            $usernameSUCCES = 'succes'; 
        }
    }
   
    if(!$email){
       $emailERROR = 'error';
       $emailErrors[] = 'E-Mail can not be empty';
    }else{
        if(!email_validation($email)){
            $emailErrors[] = 'Invalid email address';
        }else{
            $emailSUCCES = 'succes';
        }
    }

    if(!$password){
       $passwordERROR = 'error';
       $passwordErrors[] = 'Password can not be empty';
    }else{
        if(strlen($password) < '6'){
            $passwordERROR = 'error';
            $passwordErrors[] = 'Password must be more than 6 chars';
        }
        else{
            if($password != $password2){
                $password2ERROR = 'error';
                $password2Errors[] = 'Password does not matches';
            }
            else{
                $password2SUCCES = 'succes';
                $passwordSUCCES = 'succes';
            }
        }
    }

    if($emailSUCCES && $usernameSUCCES && $password2SUCCES && $passwordSUCCES = 'succes'){
        $statement = $pdo->prepare("INSERT INTO `users` (email, name, password)
                                                  VALUES(:email, :name, :password)");
        $statement->bindValue(':email', $email);
        $statement->bindValue(':name', $username);
        $statement->bindValue(':password', $password);
        
        $statement->execute();

        header('Location:./index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies And Series, WATCH ON IMAGIX</title>
    <!--GOOGLE FONT-->
    <link rel="stylesheet" href="./assets/font.css">
    <!--STYLE.CSS-->
    <link rel="stylesheet" href="./style.css">
    <!--FONTAWESOME-->
    <script src="https://kit.fontawesome.com/920b1aaee6.js" crossorigin="anonymous"></script>

</head>
<body>
    <!--HEADER STARTS-->
    <div class="sign-in-bg"></div>
    <div class="header">
        <!--HEADER TOP STARTS-->
        <div class="header-top">
            <div class="header-top-title">
                <a href="index.php" class="h-t-f">IMAGIX</a>
            </div>
            <div class="header-top-navigation">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Schedule</a></li>
                <li><a href="#">Movies</a></li>
                <li><a href="#">News</a></li>
            </div>
            <div class="header-top-search">
                <i class="fas fa-search"></i>
            </div>
            <div class="header-top-sign-in">
                <a href="sign-in.php">sign in</a>
            </div>
        </div>
        <!--HEADER TOP ENDS-->
    </div>
    <div class="sign-in-form">
        <form action="#" method="POST" class="form">
            <h3 class="title">sign up</h3>
            <div class="form-control">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" value="<?php echo $username ?>">
                <div class="error-accept">
                    <i class="fas fa-exclamation-circle <?php echo $usernameERROR ?> "  ></i>
                    <i class="fas fa-check-circle <?php echo $usernameSUCCES ?> "></i>
                </div>

                <div class="error-message">
                    <?php if(!empty($usernameErrors)){ ?>
                       
                        <?php foreach($usernameErrors as $error){ ?>
                            <p><?php echo $error ?></p>
                        <?php } ?> 
                   
                    <?php } ?>  
                </div>   
            </div>
            <div class="form-control">
                <i class="fas fa-envelope"></i> 
                <input type="text" name="email" maxlength="30" placeholder="E-Mail"  value="<?php echo $email ?>">
                <div class="error-accept">
                    <i class="fas fa-exclamation-circle <?php echo $emailERROR?> " ></i>
                    <i class="fas fa-check-circle <?php echo $emailSUCCES ?> "></i>
                </div>
                <div class="error-message">
                    <?php if(!empty($emailErrors)){ ?>
                       
                        <?php foreach($emailErrors as $error){ ?>
                            <p><?php echo $error ?></p>
                        <?php } ?> 
                   
                    <?php } ?>  
                </div> 
            </div>
            <div class="form-control">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password"  value="<?php echo $password ?>">
                <div class="error-accept">
                    <i class="fas fa-exclamation-circle <?php echo $passwordERROR ?> " ></i>
                    <i class="fas fa-check-circle <?php echo $passwordSUCCES ?> "></i>
                </div>
                <div class="error-message">
                    <?php if(!empty($passwordErrors)){ ?>
                       
                        <?php foreach($passwordErrors as $error){ ?>
                            <p><?php echo $error ?></p>
                        <?php } ?> 
                   
                    <?php } ?>  
                </div>   
            </div>
            <div class="form-control">
                <i class="fas fa-lock"></i>
                <input type="password" name="password2" placeholder="Repeat Password"  value="<?php echo $password2 ?>">
                <div class="error-accept">
                    <i class="fas fa-exclamation-circle <?php echo $password2ERROR ?> " ></i>
                    <i class="fas fa-check-circle <?php echo $password2SUCCES ?> "></i>
                </div>

                <div class="error-message">
                    <?php if(!empty($password2Errors)){ ?>
                       
                        <?php foreach($password2Errors as $error){ ?>
                            <p><?php echo $error ?></p>
                        <?php } ?> 
                   
                    <?php } ?>  
                </div>   
            </div>
            
            <div class="sign-in-sign-up-buttons">
                <a href="sign-in.php" class="sign-up-btn">Sign In</a>
                <input type="submit" value="Sign Up" class="submit-btn">
            </div>
        </form>
    </div>
    <!--HEADER ENDS-->
</body>
</html>