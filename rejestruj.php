<?php
 ob_start();
 session_start();
 if( isset($_SESSION['user'])!="" ){
  header("Location: index.php");
 }
 error_reporting( error_reporting() & ~E_NOTICE );
 include_once './skrypty/dbconnect.php';

 $error = false;

 if ( isset($_POST['btn-signup']) ) {
  
  // clean user inputs to prevent sql injections
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Wprowadź nazwe użytkownika";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Nazwa musi mieć co najmniej 3 znaki";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Nazwa może zawierać tylko litery i spacje";
  }
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Wprowadź poprawny email";
  } else {
   // check email exist or not
   $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
   $result = mysqli_query($polaczenie, $query);
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Podany email jest już uzywany";
   }
  }
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Wprowadź hasło.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Hasło musi mieć co najmniej 6 znaków.";
  }
  
  // password encrypt using SHA256();
  $password = hash('sha256', $pass);
  
  // if there's no error, continue to signup
  if( !$error ) {
   
   $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
   $res = mysqli_query($polaczenie, $query);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Rejestracja przebiegła pomyślnie. Przekierowanie do logowania";
    unset($name);
    unset($email);
    unset($pass);
	header('refresh: 3; url=loguj.php');
   } else {
    $errTyp = "danger";
    $errMSG = "Błąd podczas rejestracji"; 
   } 
    
  }
  
  
 }
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body>

<?php include 'naglowek.php';?>

<?php include 'menu.php';?>
  
<div class="container">

 <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
     <div class="col-sm-12">
        
         <div class="form-group">
             <h2 class="" align=center>Rejestracja</h2>
            </div>
        
         <div class="form-group">
             <hr />
            </div>
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
            <div class="row">
			<div class="col-sm-4">
			</div>
  <div class="col-sm-4">
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="name" class="form-control" placeholder="Nazwa użytkownika" maxlength="50" value="<?php echo $name ?>" />
                </div>
               <!-- <span class="text-danger"><?php echo $nameError; ?></span>-->
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Email" maxlength="40" value="<?php echo $email ?>" />
                </div>
               <!-- <span class="text-danger"><?php echo $emailError; ?></span> -->
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Hasło" maxlength="15" />
                </div>
              <!--  <span class="text-danger"><?php echo $passError; ?></span> -->
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Rejestruj</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            </div>
			</div>
        
        </div>
   
    </form>
    </div> 

</div>
<?php ob_end_flush(); ?>

<script src="./js/lightbox.js"></script>

</body>
</html>
<?php include 'stopka.php';?>
