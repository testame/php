<?php
include 'libs/db_connect.php';
?>

<!DOCTYPE HTML>
<html>

<head>
	<title> POLDO </title>

</head>

<body>
	<a href="index.php">Home </a>

	<?php
	//select all data
	$query = "SELECT id,nome,descr,prezzo from prodotti";
	try {
		$num = 0;
		$stmt = $con->prepare($query);
		$stmt->execute();
		//Lettura numero righe risultato 
		$num = $stmt->rowCount();
	} catch (PDOException $ex) {
		echo "Errore !" . $ex->getMessage();
	}
	//se num > 0 recordset vuoto o errore 
	if ($num > 0) {

		echo "<table border='1'>";
		echo "<tr>";
		echo "<th>NOME</th>";
		echo "<th>DESCR</th>";
		echo "<th>PREZZO</th>";
		echo "</tr>";
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr>";
			echo "<td>" . $row['nome'] . "</td>";
			echo "<td>" . $row['descr'] . "</td>";
			echo "<td>" . $row['prezzo'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "No records found.";
	}

	?>

</body>

</html>