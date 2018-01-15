<?php
// Include config file
require_once './skrypty/dbconnect.php';
 
// Define variables and initialize with empty values
$name = $cat = $desc = $img = $imgmini = "";
$name_err = $cat_err = $desc_err = $img_err = $imgmini_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["nazwa"]);
    if(empty($input_name)){
        $name_err = 'Wpisz nazwe.';     
    } else{
        $name = $input_name;
    }
	
	// Validate salary
    $input_cat = trim($_POST["kategoria_id"]);
    if(empty($input_cat)){
        $cat_err = "Wpisz kategorie";     
    } elseif(!ctype_digit($input_cat)){
        $cat_err = 'Wpisz numer kategorii';
    } else{
        $cat = $input_cat;
    }
    
    // Validate address address
    $input_desc = trim($_POST["opis"]);
    if(empty($input_desc)){
        $desc_err = 'Wpisz opis.';     
    } else{
        $desc = $input_desc;
    }
    
    // Validate salary
    $input_img = trim($_POST["img"]);
    if(empty($input_img)){
        $img_err = 'Wpisz nazwe obrazu.';     
    } else{
        $img = $input_img;
    }
	
	// Validate salary
    $input_imgmini = trim($_POST["imgmini"]);
    if(empty($input_imgmini)){
        $imgmini_err = 'Wpisz nazwe miniatury.';     
    } else{
        $imgmini = $input_imgmini;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($cat_err) && empty($desc_err) && empty($img_err) && empty($imgmini_err)){
        // Prepare an update statement
        $sql = "UPDATE produkty SET nazwa=?, kategoria_id=?, opis=?, img=?, imgmini=? WHERE id=?";
         
        if($stmt = mysqli_prepare($polaczenie, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sisssi", $param_name, $param_cat, $param_desc, $param_img, $param_imgmini, $param_id);
            
            // Set parameters
            $param_name = $name;
			$param_cat = $cat;
            $param_desc = $desc;
            $param_img = $img;
			$param_imgmini = $imgmini;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: produkty_spis.php");
                exit();
            } else{
                echo "Blad zapisu";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    //mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM produkty WHERE id = ?";
        if($stmt = mysqli_prepare($polaczenie, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    // Retrieve individual field value
					$cat = $row["kategoria_id"];
                    $name = $row["nazwa"];
                    $desc = $row["opis"];
                    $img = $row["img"];
					$imgmini = $row["imgmini"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        //mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
                        <h2>Edytuj wpis</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nazwa</label>
                            <input type="text" name="nazwa" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($cat_err)) ? 'has-error' : ''; ?>">
                            <label>Kategoria</label>
							<?php $polaczenie = @mysqli_connect('localhost', 'root', '', 'pai_projekt');
								$sql = 'SELECT * FROM kategorie';
								$wynik = mysqli_query($polaczenie, $sql);
								$wszystkie_produkty=array();
								while ($objekt = mysqli_fetch_array($wynik))
								{
								 $wszystkie_produkty[]=$objekt;
								}
							$combo= '<select name="kategoria_id" id="kategoria_id">';
							foreach($wszystkie_produkty as $produkt) {
								$combo.='<option value="'.$produkt['id'].'">'.$produkt['nazwa'].'</option>';
							}
							$combo.='</select>';
							echo $combo;?>
                            <span class="help-block"><?php echo $cat_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($desc_err)) ? 'has-error' : ''; ?>">
                            <label>Opis</label>
                            <textarea name="opis" class="form-control"><?php echo $desc; ?></textarea>
                            <span class="help-block"><?php echo $desc_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($img_err)) ? 'has-error' : ''; ?>">
                            <label>Nazwa obrazu</label>
                            <input type="text" name="img" class="form-control" value="<?php echo $img; ?>">
                            <span class="help-block"><?php echo $img_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($imgmini_err)) ? 'has-error' : ''; ?>">
                            <label>Nazwa obrazu</label>
                            <input type="text" name="imgmini" class="form-control" value="<?php echo $imgmini; ?>">
                            <span class="help-block"><?php echo $imgmini_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Aktualizuj">
                        <a href="produkty_spis.php" class="btn btn-default">Anuluj</a>
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