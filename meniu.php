<!DOCTYPE html>
<html>
	<head>
		<style>
			.error {color: #FF0000;}

			#gallery-text-left{
				/* Added */
				width: 50%;

			}
			#gallery-paragraph-1{
			border-left:8px solid #3CB371;
			border-radius:4px;
			padding-left:15px;
				/* Added */
				word-wrap: break-word;
			}
			#gallery-paragraph-2{
			border-left:8px solid #3CB371;
			border-left:4px;
			padding-left:15px;
			}


			#gallery-text-right{
				/* Added */
				width: 50%;

			}

			input[type=text], select {
				width: 30%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
				
			}

			input[type=email], select {
				width: 30%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}

			input[type=tel], select {
				width: 30%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}


			textarea[type=text], select {
				width: 30%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}

			input[type=submit] {
				width: 20%;
				background-color: #4CAF50;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				border-radius: 4px;
				cursor: pointer;
			}



			input[type=submit]:hover {
				background-color: #45a049;
			}


			label {
				font-family: Georgia, "Times New Roman", Times, serif;
				font-size: 18px;
				color: #333;
				height: 20px;
				width: 200px;
				margin-top: 10px;
				margin-left: 10px;
				text-align: left;
				clear: both;
				float:left;
				margin-left:15px;
			}

		</style>
		<title> Gyvūnėlių užsakymai</title>
	</head>
	<body>
		<center>
			<br>
			<h1>Čia galite užsisakyti naminį gyvūnėlį</h1>
			<div class="slideshow-container">
				<div class="mySlides fade">
				  <img src="C:\xampp\htdocs\NFQ\imange\dog.jpg" width="800" height="250">
				</div>
				<div class="mySlides fade">
				  <img src="C:\xampp\htdocs\NFQ\imange\dog_cat.jpg" width="800" height="250">
				</div>
				<div class="mySlides fade">
				  <img src="C:\xampp\htdocs\NFQ\imange\reat.jpg" width="800" height="250">
				</div>
			</div>
			<br>
			<div style="text-align:center">
			  <span class="dot"></span> 
			  <span class="dot"></span> 
			  <span class="dot"></span> 
			</div>
		</center>
<?php 
include 'mysql.php';
//Naudojemi kintamieji
$corect = 0;

$firstname = "";
$lastname = "";
$email = "";
$number = "";
$comment = "";
$gender = "";
$addres = "";

$firstnameErr = "";
$lastnameErr = "";
$emailErr = "";
$numberErr = "";
$genderErr = "";
$addresErr = "";

$ggyvunas = "";
$gamziusnuo ="";
$gamziusiki = "";
$glytis = "";
$gugis = "";
$gspalva = "";
$gkailis = "";

//Po užsakymo paspaudimo patikrinami laukai ir jei viskas gerai, užsakymas įrašomas į duomenų bazę
if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (isset($_POST['submit'])) 
			{
				//Funkcija tikrina ar vardas gerai įvestas
				if (empty($_POST["firstname"])) 
					{
						$firstnameErr = "Blogai įvestas vardas";
						$corect = 1;
					} 
				else 
					{
						$firstname = ($_POST["firstname"]);
						// Tikrinama ar naudojamos abecėlių raidės
						if (!preg_match("/^[ą-žĄ-Ža-zA-Z]*$/",$firstname)) 
							{					
								$firstnameErr = "Tiktais abecėlių radės"; 
							}
					}
				//Funkcija tikrina ar pavardė gerai įvesta
				if (empty($_POST["lastname"])) 
					{
						$corect = 1;
						$lastnameErr = "Blogai įvesta pavardė";
					} 
				else 
					{
						$lastname = ($_POST["lastname"]);
						// Tikrinama ar naudojamos abecėlių raidės
						if (!preg_match("/^[ą-žĄ-Ža-zA-Z]*$/",$lastname))
							{
								$lastnameErr = "Tiktais abecėlių radės"; 
							}
					}
				//Funkcija tikrina ar le.paštas gerai įvestas
				if (empty($_POST["email"])) 
					{
						$corect = 1;
						$emailErr = "Blogai įvestas el.paštas";
					}
				else 
					{
						$email = ($_POST["email"]);
						// Tikrinama ar el.paštas gerai suvestas
						if (!filter_var($email, FILTER_VALIDATE_EMAIL))
							{	
								$emailErr = "Nežinomas el.paštas"; 
							}
					}
				//Funkcija tikrina ar numeris gerai įvestas	
				if (empty($_POST["number"]))
					{
						$corect = 1;
						$numberErr = "Blogai įvestas numeris";
					}
				else 
					{
						$number = ($_POST["number"]);
						// Tikrinama ar numeris susideda iš skaičių
						if (!preg_match("/^[0-9]*$/",$number)) 
							{
								$numberErr = "Tiktais skaičiai"; 
							}
					}
				//Funkcija tikrina ar adresas gerai įvestas
				if (empty($_POST["addres"])) 
					{
						$corect = 1;
						$addresErr = "Blogai įvestas adresas";
					}
				else
					{
						$addres =($_POST["addres"]);
						//Tikrinama ar tinkami panaudoti simboliai
						if (!preg_match("/^[ą-žĄ-Ža-zA-Z0-9]*$/",$addres)) 
						{					
						  $addresErr = "Lietuviškos raidės ir skaičiai"; 
						}
					}
		  
				if (empty($_POST["comment"]))
					{
						$comment = "";
					} 
				else
					{
						$comment = ($_POST["comment"]);
					}

				if (empty($_POST["gender"]))
					{
						$corect = 1;
						$genderErr = "Gender is required";
					}
				else
					{
						$gender = ($_POST["gender"]);
					}

				 if (empty($_POST["Gyvunas"]))
					{
						$ggyvunas = "";
					}
				else	
					{
						$ggyvunas = ($_POST["Gyvunas"]);
					}

				if (empty($_POST["Metai_nuo"]))
					{
						$gamziusnuo = "";
					} 
				else
					{
						$gamziusnuo = ($_POST["Metai_nuo"]);
					}
		  
				if (empty($_POST["Metai_iki"])) 
					{
						$gamziusiki = "";
					} 
				else
					{
					$gamziusiki = ($_POST["Metai_iki"]);
					}
		  
				if (empty($_POST["lyties_tipas"])) 
					{
						$glytis = "";
					} 
				else
					{
						$glytis = ($_POST["lyties_tipas"]);
					}
		  
				if (empty($_POST["gyvuno_ugis"])) 
					{
						$gugis = "";
					}
				else
					{
						$gugis = ($_POST["gyvuno_ugis"]);
					}
		  
				if (empty($_POST["g_spalva"])) 
					{
						$gspalva = "";
					}
				else
					{
						$gspalva =($_POST["g_spalva"]);
					}
		  
				if (empty($_POST["g_kailis"])) 
					{
						$gkailis = "";
					} 
				else
					{
						$gkailis =$_POST["g_kailis"];
					}
		  
				/*function test_input($data)
				{
					$data = trim($data);
					$data = stripslashes($data);
					$data = htmlspecialchars($data);
					return $data;
				}*/
				//Funkcija kuri patikrina jei kintamasis ==0 tuomet užsakyma patalpina į duonenų baze, kutu atvejų klaidos pranešimą
				if($corect == 0)
					{
						$conn = new mysqli($servername, $username, $password, $dbname);
						// Check connection
						if($conn->connect_error)
							{
								die("Connection failed: " . $conn->Connect_error);
							}
							/* change character set to utf8 */
						if (!$conn->set_charset("utf8")) 
							{
								printf("Error loading character set utf8: %s\n", $conn->error);
								exit();
							}
						$sql_insert = "INSERT INTO `orders`(`Vardas`, `Pavarde`, `El.pastas`, `Telefono_numeris`, 
							`Adresas`, `Komentaras`, `Lytis`, `gyvunas`, `gyvuno_amzius_nuo`, `gyvuno_amzius_iki`,
							`gyvuno_lytis`, `gyvuno_ugis`, `gyvuno_spalva`, `gyvuno_kailis`) 
							VALUES ('$firstname','$lastname','$email','$number','$addres','$comment','$gender',
							'$ggyvunas','$gamziusnuo','$gamziusiki','$glytis',' $gugis','$gspalva','$gkailis')";
						//Naudojemi kintamiejo nunulinami;	
						$firstname = "";
						$lastname = "";
						$email = "";
						$number = "";
						$comment = "";
						$gender = "";
						$addres = "";
						
						//Funkcija patikrna ar užsakymas sėkmingai nusiustas
						if($conn->query($sql_insert)==TRUE)
							{
								echo "Užsakymas sėkmingai išsiūstas";
							}
						else
							{
								echo "Error: " . $sql_insert . " <br>" . $conn->error;
							}

					}
				else
					{
						echo "Blogai įvesti duomenys";
					}

			} 
		else 
			{
        //assume btnSubmit
			}
	}

//$conn->close();
?>

		<div id="gallery-text">
			<div id="gallery-text-left" style="float:left">
				<p id="gallery-text-quote-left" style="font-family:Century Gothic;color:#006600">
					<b> Kontaktiniai duomenys </b>
				</p>
				<p><span class="error"> * privalomi laukai </span></p>
				<form id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
					<p id="gallery-paragraph-1" style="font-family:Georgia">
						<label>Vardas:</label><input type="text" name="firstname" value="<?php echo $firstname;?>" placeholder="Tavo vardas..">
						<span class="error">* <?php echo $firstnameErr;?></span>
						<br><br>
						<label>Pavardė:</label><input type="text" name="lastname" value="<?php echo $lastname;?>" placeholder="Tavo pavardė..">
						<span class="error">* <?php echo $lastnameErr;?></span>
						<br><br>
						<label>El. paštas:</label> <input type="email" name="email" value="<?php echo $email;?>" placeholder="Tavo El.paštas..">
						<span class="error">* <?php echo $emailErr;?></span>
						<br><br>
						<label>Telefono numeris:</label>  <input type="tel" name="number" value="<?php echo $number;?>" placeholder="Tavo telefono numeris..">
						<span class="error">* <?php echo $numberErr;?></span>
						<br><br>
						<label>Adresas:</label> <textarea type="text" name="addres" rows="2" cols="40" value="<?php echo $addres;?>" placeholder="Tavo adresas.."></textarea>
						<span class="error">* <?php echo $addresErr;?></span>
						<br><br>
						<label>Komentaras:</label> <textarea type="text" name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
						<br><br>
						<label>Lytis:</label>
						<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Moteris") echo "checked";?> value="Moteris">Moteris
						<input type="radio" name="gender" <?php if (isset($gender) && $gender=="Vyras") echo "checked";?> value="Vyras">Vyras
						<span class="error">* <?php echo $genderErr;?></span>
						<br><br>
					</p>
			</div>
			<form method="post">
				<div id="gallery-text-right" style="float:left">
					<p id="gallery-text-quote-right" style="font-family:Century Gothic; color:#006600"><b>Pageidaujamas gyvūnas</b></p>
					<p id="gallery-paragraph-2" style="font-family:Georgia">
 <?php
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error)
	{
		die("Connection failed: " . $conn->Connect_error);
	}
/* change character set to utf8 */
if (!$conn->set_charset("utf8"))
	{
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
	}
$sql = "SELECT Gyvunas FROM `gyvunas` GROUP BY Gyvunas ASC";
if (!$sql) 
	{
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
	
$result = $conn -> query ($sql);
echo "<label>Gyvūnas:</label> <select name='Gyvunas'>";
while($row = $result->fetch_array())
	{
		echo "<option value='" . $row['Gyvunas'] ."'>" . $row['Gyvunas'] ."</option>";
	}
echo "</select>";
echo "<br><br>";

$sql_amzius = "SELECT Metai FROM `amzius`";
if (!$sql_amzius) 
	{
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
$result_amzius = $conn -> query ($sql_amzius);
echo "<label>Gyvūno amžius nuo:</label> <select name='Metai_nuo' style='width: 100px;'>";
while($row_amzius = $result_amzius->fetch_array())
	{
		echo "<option value='" . $row_amzius['Metai'] ."'>" . $row_amzius['Metai'] ."</option>";
	}
echo "</select>";

$sql_amzius_iki = "SELECT Metai FROM `amzius`";
if (!$sql_amzius_iki) 
	{
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
$result_amzius_iki = $conn -> query ($sql_amzius_iki);
echo "iki: <select name='Metai_iki' style='width: 100px;'>";
while($row_amzius_iki = $result_amzius_iki->fetch_array())
	{
		echo "<option value='" . $row_amzius_iki['Metai'] ."'>" . $row_amzius_iki['Metai'] ."</option>";
	}
echo "</select>";
echo "<br><br>";;

$sql_lytis = "SELECT lyties_tipas FROM `lytis` ";
if (!$sql_lytis) 
	{
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
$result_lytis = $conn -> query ($sql_lytis);
echo "<label>Gyvūno lytis: </label><select name='lyties_tipas'>";
while($row_lytis = $result_lytis->fetch_array())
	{
		echo "<option value='" . $row_lytis['lyties_tipas'] ."'>" . $row_lytis['lyties_tipas'] ."</option>";
	}
echo "</select>";
echo "<br><br>";

$sql_ugis = "SELECT gyvuno_ugis FROM `ugis` GROUP BY gyvuno_ugis desc ";
if (!$sql_ugis) 
	{
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
$result_ugis = $conn -> query ($sql_ugis);
echo "<label>Gyvūno ugis: </label><select name='gyvuno_ugis'>";
while($row_ugis = $result_ugis->fetch_array())
	{
		echo "<option value='" . $row_ugis['gyvuno_ugis'] ."'>" . $row_ugis['gyvuno_ugis'] ."</option>";
	}
echo "</select>";
echo "<br><br>";

$sql_spalva = "SELECT g_spalva FROM `spalva` GROUP BY g_spalva desc ";
if (!$sql_spalva) 
	{
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
$result_spalva = $conn -> query ($sql_spalva);
echo "<label>Gyvūno spalva:</label> <select name='g_spalva'>";
while($row_spalva = $result_spalva->fetch_array())
	{
		echo "<option value='" . $row_spalva['g_spalva'] ."'>" . $row_spalva['g_spalva'] ."</option>";
	}
echo "</select>";
echo "<br><br>";

$sql_kailis = "SELECT g_kailis FROM `kailis` GROUP BY g_kailis desc ";
if (!$sql_kailis) 
	{
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
$result_kailis = $conn -> query ($sql_kailis);
echo "<label>Gyvūno kailis:</label> <select name='g_kailis'>";
while($row_kailis = $result_kailis->fetch_array())
	{
		echo "<option value='" . $row_kailis['g_kailis'] ."'>" . $row_kailis['g_kailis'] ."</option>";
	}
echo "</select>";
echo "<br><br>";

$conn->close();
?>
				</div>
				<input type="submit" name="submit" value="Užsakyti" />		
		</div>
			</form>
		</form>
	</body>
</html>

<script>
var slideIndex = 0;
showSlides();

function showSlides() 
	{
		var i;
		var slides = document.getElementsByClassName("mySlides");
		var dots = document.getElementsByClassName("dot");
		for (i = 0; i < slides.length; i++) {
		   slides[i].style.display = "none";  
		}
		slideIndex++;
		if (slideIndex > slides.length) {slideIndex = 1}    
		for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		}
		slides[slideIndex-1].style.display = "block";  
		dots[slideIndex-1].className += " active";
		setTimeout(showSlides, 2000); // pakeičia paveikslelį kas 2 sekundes
	}

</script>