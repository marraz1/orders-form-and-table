<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" 

href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" 

src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" 

src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!DOCTYPE html>
<html lang="lt">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title> Užsakymų peržiūra</title>
	</head>
	<style>
		.main {
		  font-size:0.8em; 
		}
	</style>
	<center>
		<br>
		<h1>Čia matomi visi gyvūnų užsakymai</h1>
	</center>
	<form method="post" action="">
		<table method="post" id="myTable" class="table table-striped table-bordered main" style= "background-color: #84ed86; color: #761a9b; width:50%" width="50%">
			<thead>
				<tr>
					<th align="left">ID</th>
					<th align="left">Vardas</th>
					<th align="left">Pavardė</th>
					<th align="left">El.paštas</th>
					<th align="left">Telefono numeris</th>
					<th align="left">Adresas</th>
					<th align="left">Komentaras</th>
					<th align="left">Lytis</th>
					<th align="left">Užsakymo data</th>
					<th align="left">Gyvunas</th>
					<th align="left">Gyvuno amžius nuo</th>
					<th align="left">Gyvuno amžius iki</th>
					<th align="left">Gyvuno lytis</th>
					<th align="left">Gyvuno ugis</th>
					<th align="left">Gyvuno spalva</th>
					<th align="left">Gyvuno kailis</th>
					<th align="left">Options</th>
				</tr>
			</thead> 
<?php
include 'mysql.php';
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
//Pasirenka kintamuosius iš duomenų bazės
$sql_orders = "SELECT `ID`, `Vardas`, `Pavarde`, `El.pastas`, `Telefono_numeris`,
 `Adresas`, `Komentaras`, `Lytis`, `uzsakymo_data`, `gyvunas`, `gyvuno_amzius_nuo`, `gyvuno_amzius_iki`,
 `gyvuno_lytis`, `gyvuno_ugis`, `gyvuno_spalva`, `gyvuno_kailis` FROM `orders`";
if (!$sql_orders)
	{
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
//Ciklas kuris atspauzdina duomenis iš duomenų bazės
$result_orders = $conn -> query ($sql_orders);
while($row_orders = $result_orders->fetch_array())
	{
		echo
            "<tr>
				<td align='left'>{$row_orders['ID']}</td>
				<td align='left'>{$row_orders['Vardas']}</td>
				<td align='left'>{$row_orders['Pavarde']}</td>
				<td align='left'>{$row_orders['El.pastas']}</td>
				<td align='left'>{$row_orders['Telefono_numeris']}</td>
				<td align='left'>{$row_orders['Adresas']}</td>
				<td align='left'>{$row_orders['Komentaras']}</td>
				<td align='left'>{$row_orders['Lytis']}</td>
				<td align='left'>{$row_orders['uzsakymo_data']}</td>
				<td align='left'>{$row_orders['gyvunas']}</td>
				<td align='left'>{$row_orders['gyvuno_amzius_nuo']}</td>
				<td align='left'>{$row_orders['gyvuno_amzius_iki']}</td>
				<td align='left'>{$row_orders['gyvuno_lytis']}</td>
				<td align='left'>{$row_orders['gyvuno_ugis']}</td>
				<td align='left'>{$row_orders['gyvuno_spalva']}</td>
				<td align='left'>{$row_orders['gyvuno_kailis']}</td>
				\n";
?>
	
				<td align='left' data-title='Options'>	
				<input type="submit" name="submit" value="Ištrinti" onclick="myFunction()" id="<?php echo $row_orders['ID'] ?>" class="delete_contact" href="javascript:void(0)" title="Remove"></input>			
			</tr>
			<?php
    }
$conn->close();
?> 
		</table>
	</form>
</html>

<script>
$(document).ready(function() 
	{
		$('#myTable').DataTable();
	} 
);
</script>

<script type ="text/javascript">	
 $(document).ready(function() {
	 $('#myTable').DataTable();	
} );   
   
$(document).ready(function(){	
	
			/* kodo dalis kuris patikia pažymėtų klientų numerių id kitam failui ir jis juos ištriną */
	function delete_contact(ids){
         $.ajax( {
            type: "POST",
            url: '/NFQ/delete.php',
            data:  {
		 ids: ids
	    },
            dataType: "json",
        })
        .done(function(msg)
        {
                for (index = 0, len = ids.length; index < len; ++index) {
                    id = ids[index];
		    $("tr."+id).remove();
                }

        })
        .fail(function (jqXHR, textStatus, errorThrown){
                var error = "Request failed: " + textStatus + " - " + errorThrown;
                console.log(error);
        });
}

 $( ".delete_contact" ).click(function() {
		delete_contact([$(this).attr('ID')]);
    });

});
</script>
