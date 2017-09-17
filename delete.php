<?php
include 'mysql.php';
/* kodo dalis kuris ištrina užsakyma iš duomenų bazės pagal id */
$ids = $_POST['ids'] ?: [];
$ids = array_map("intval", $ids);

if (count($ids) > 0){
    try {
        $conn = new PDO("mysql:host=".$servername.";port=3306;dbname=".$dbname, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
	$implode_ids = implode(',', $ids);
        $stmt = $conn->prepare("DELETE FROM orders WHERE ID IN ($implode_ids)");
	
		if ($stmt->execute()) { 
			$return_arr['status'] = "success";
		}else{
			$return_arr['status'] = "error";
		}
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
		$return_arr['status'] = "error";
    }
	echo json_encode($return_arr);
}
?>