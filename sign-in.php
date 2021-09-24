<?php
$pdo = new PDO('mysql:host=localhost; port=3306; dbname=movie-site', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$username = '';
$password = '';

$errors[] = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username-sign-in'];
    $password = $_POST['password-sign-in'];

    $sql = "SELECT `name`, `password` FROM `users` WHERE `name`='".$username."' AND `password`='".$password."'";
    $result = $pdo->query($sql);
    
    foreach($result as $res){
        if($res['name'] != $username && $res['password'] != $password) {
            echo  $username;
            
        } else {
            header("Location:./foruser.php");
        }
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
            <h3 class="title">sign in</h3>
            <div class="form-control">
                <i class="fas fa-user"></i>
                <input type="text" name="username-sign-in" placeholder="Username" value="<?php echo $username ?>">
                <div class="error-accept">
                    <i class="fas fa-exclamation-circle <?php echo $usernameERROR ?> "  ></i>
                    <i class="fas fa-check-circle <?php echo $usernameSUCCES ?> "></i>
                </div>
            </div>
            <div class="form-control">
                <i class="fas fa-lock"></i>
                <input type="password" name="password-sign-in" placeholder="Password" value="<?php echo $password ?>">
            </div>
            
            <div class="sign-in-sign-up-buttons">
                <a href="sign-up.php" class="sign-up-btn">Sign Up</a>
                <input type="submit" value="Sign In" class="submit-btn">

                <?php if(!empty($errors)){ ?>
                    <?php foreach($errors as $err){ ?>
                        <p><?php $err ?></p>
                    <?php } ?>    
                <?php } ?>    
            </div>
        </form>
    </div>
    <!--HEADER ENDS-->
</body>
</html>