<?php ob_start();
 session_start();
 require_once 'dbconnect.php';
 global $zalogowany;
  // select loggedin users detail
  if ( isset($_SESSION['user'])!="" )
	  {
 $is_logged="SELECT * FROM users WHERE userId=".$_SESSION['user'];
 $response=mysqli_query($polaczenie, $is_logged);
 $row=mysqli_fetch_array($response);
 if ($row!='')
 {
	 $zalogowany=1;
 }
	  }
	  
?>