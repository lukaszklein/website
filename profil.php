<?php
 ob_start();
 session_start();
 require_once './skrypty/dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 // select loggedin users detail
 $query="SELECT * FROM users WHERE userId=".$_SESSION['user'];
 $res=mysqli_query($polaczenie, $query);
 $userRow=mysqli_fetch_array($res);
 if ($userRow!='')
 {
	 $zalogowany=1;
 }
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body>

<?php include 'naglowek.php';?>

<?php include 'menu.php';?>
  
<div class="container">
  Witaj uzytkowniku: <?php echo $userRow['userName']; ?>
</div>

<?php include 'stopka.php';?>

<script src="./js/lightbox.js"></script>

</body>
</html>
<?php ob_end_flush(); ?>