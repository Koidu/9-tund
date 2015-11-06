<?php
	// laeme funktsiooni failis
	require_once("functions.php");
	
	// kontrollin, kas kasutaja on sisse loginud
	if(!isset($_SESSION["id_from_db"])){
			// suunan login.php lehele
			header("Location: login_sample.php");
	}
	// login v2lja
	if(isset($_GET["logout"])){
			session_destroy();
			header("Location: login_sample.php");
	}
	
	$car_plate = $color = $car_plate_error = $color_error = "";
?>

<p>
	Tere, <?=$_SESSION["user_email"];?>
	<a href ="?logout=1">Logi välja</a>

</p>


<?php
   if(isset($_POST["create"])){
			if ( empty($_POST["car_plate"]) ) {
				$car_plate_error = "See väli on kohustuslik";
			}else{
				$car_plate = cleanInput($_POST["car_plate"]);
			}
			if ( empty($_POST["color"]) ) {
				$color_error = "See väli on kohustuslik";
			}else{
				$color = cleanInput($_POST["color"]);
			}
			
			if(	$car_plate_error == "" && $color_error == ""){
				
				// msg on message funktsioonist
				$msg = createCarPlate ($car_plate, $color);
				
				if ($msg !=""){
					// Salvestamine õnnestus
					// teen tühjaks input value
					$car_palte = "";
					$color = "";
					
					echo $msg;
					
					
					
				}
				
			
			}
    } // create if end
  // funktsioon, mis eemaldab kõikvõimaliku üleliigse tekstist
  function cleanInput($data) {
  	$data = trim($data); //võtab ära tühjad enterid, tühikud ja tab´is
  	$data = stripslashes($data); // võtab ära vastupidised kaldkriipsud ehk \
  	$data = htmlspecialchars($data); // muudab tekstiks
  	return $data;
  }  
  
 
?>  
<h2>Lisa auto</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<label for="car_plate" >auto nr</label><br>
	<input id="car_plate" name="car_plate" type="text" value="<?=$car_plate; ?>"> <?=$car_plate_error; ?><br><br>
  	<label>värv</label><br>
	<input name="color" type="text" value="<?=$color; ?>"> <?=$color_error; ?><br><br>
  	<input type="submit" name="create" value="Salvesta">
  </form>