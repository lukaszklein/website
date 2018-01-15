 <?php 
	require_once('./skrypty/dbconnect.php');
//si l'utilisateur a clicker sur valider
if (isset($_POST['submit'])){
	if(isset($_POST['id'])) $id = htmlspecialchars(mysql_real_escape_string($_POST['id']));
	else      $id="";
	if(isset($_POST['nom'])) $nom = htmlspecialchars(mysql_real_escape_string($_POST['nom']));
	else      $nom="";
	if(isset($_POST['prenom'])) $prenom =  htmlspecialchars(mysql_real_escape_string($_POST['prenom']));
	else      $prenom="";
	if(isset($_POST['email'])) $email = $email =  htmlspecialchars(mysql_real_escape_string($_POST['email']));
	else      $email="";
	if(isset($_POST['password'])) $password =  htmlspecialchars(mysql_real_escape_string($_POST['password']));
	else      $password="";
	if(isset($_POST['naissance'])) $naissance =  htmlspecialchars(mysql_real_escape_string($_POST['naissance']));
	else      $naissance="";
	if(isset($_POST['sexe'])) $sexe =  htmlspecialchars(mysql_real_escape_string($_POST['sexe']));
	else      $sexe="";
	
	$sql="INSERT INTO poi(id, nom, prenom, email, password, naissance, sexe) VALUES 
	($id,'$nom', '$prenom','$email', '$password', '$naissance', '$sexe')";
	mysql_query($sql)or die(mysql_error());
} 

?>
<form action="" style="
    width: 383px;
    border: 2px solid rgb(72, 14, 54);
    height: 305px;
">
  <fieldset>
    <div>  
    </div>
    <legend>Coordonnees</legend>
    <label for="familyname">Nom :</label>
    <input type="text" id="familyname" placeholder="Nom" name="nom" style="
    margin-left: 65px;
"/>
	<br>
    <label for="firstname">Prenom :</label>
    <input type="text" id="firstname" placeholder="prenom" name="prenom" style="
    margin-left: 45px;
"/>
	<br>
    <label for="email">Email :</label>
    <input type="email" id="email" placeholder="Email" name="email" style="
    margin-left: 60px;
"/>
	<br>
    <label for="password">Mot de Passe :</label>
    <input type="password" id="password" name="password"/>
  </fieldset>
  <fieldset>
    <legend>Date de Naissance</legend>
    <label for="jour">Jour :</label>
    <select name="jour" id="jour">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
    </select>
    <label for="Année">Mois :</label>
    <select name="mois" id="mois">
      
      <option value="Janvier">Janvier</option>
      <option value="Fevrier">Fevrier</option>
      <option value="Mars">Mars</option>
      <option value="Avril">Avril</option>
      <option value="Mai">Mai</option>
      <option value="Juin">Juin</option>
      <option value="Juillet">Juillet</option>
      <option value="Aout">Aout</option>
      <option value="Septembre">Septembre</option>
      <option value="Octobre">Octobre</option>
      <option value="Novembre">Novembre</option>
      <option value="Decembre">Decembre</option>
    </select>
    <label for="annee">Annee :</label>
    <select name="annee" id="annee">
      <option value="">2014</option>
      <option value="">2013</option>
      <option value="">2012</option>
      <option value="">2011</option>
      <option value="">2010</option>
      <option value="">2009</option>
      <option value="">2008</option>
      <option value="">2007</option>
      <option value="">2006</option>
      <option value="">2005</option>
      <option value="">2004</option>
      <option value="">2003</option>
      <option value="">2002</option>
      <option value="">2001</option>
	  <option value="">2000</option>
	  <option value="">1999</option>
	  <option value="">1998</option>
	  <option value="">1997</option>
	  <option value="">1996</option>
	  <option value="">1995</option>
	  <option value="">1994</option>
	  <option value="">1995</option>
	  <option value="">1994</option>
	  <option value="">1993</option>
	  <option value="">1992</option>
	  <option value="">1991</option>
	  <option value="">1990</option>
	  <option value="">1989</option>
	  <option value="">1988</option>
	  <option value="">1987</option>
	  <option value="">1986</option>
	  <option value="">1985</option>
    </select>
    
  </fieldset>
  <fieldset>
    <legend>Civilite</legend>
    <label for="m">Masculin</label>
    <input type="radio" name="civ" id="m"/>
    <label for="f">Feminin</label>
    <input type="radio" name="civ" id ="f"/>
  </fieldset>
  <input type="submit" class="botton" value="Envoyer" style="
    margin-top: 4px;
    margin-left: 90px;
"/>
  <input type="submit" class="botton" value="Annuler" style="
    margin-top: 4px;
    margin-left: 50px;
"/>
</form>