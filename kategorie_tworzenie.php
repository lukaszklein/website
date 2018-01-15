<?php
// Include config file
require_once './skrypty/dbconnect.php';
 
// Define variables and initialize with empty values
$name = "";
$name_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["nazwa"]);
    if(empty($input_name)){
        $name_err = "Wpisz nazwe kategorii";
    } elseif(!filter_var(trim($_POST["nazwa"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-_.\s ]+$/")))){
        $name_err = 'Please enter a valid name.';
    } else{
        $name = $input_name;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO kategorie (nazwa) VALUES (?)";
         
        if($stmt = mysqli_prepare($polaczenie, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);
            
            // Set parameters
            $param_name = $name;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: kategorie_spis.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    //mysqli_close($link);
}
?>
 
 <?php include './skrypty/czyzalogowany.php';?>
<!DOCTYPE html>
<html lang="en">
	<?php include 'head.php';?>
	<body>
	<?php include 'naglowek.php';?>
	<?php include 'menu.php';?>
	<div class="row">
	<div class="col-sm-1">
			<nav class="nav-sidebar">
				<ul class="nav">
                    <li><a href="kategorie_spis.php">Kategorie</a></li>
                    <li><a href="produkty_spis.php">Produkty</a></li>
				</ul>
			</nav>
		</div>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
			<div class="col-sm-3"></div>
                <div class="col-sm-4" align=center>
                    <div class="page-header">
                        <h1>Tworzenie nowej kategorii</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nazwa</label>
                            <input type="text" name="nazwa" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Dodaj">
                        <a href="kategorie_spis.php" class="btn btn-default">Anuluj</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
	</div>
	<?php include 'stopka.php';?>
	<script src="./js/lightbox.js"></script>
</body>
</html>