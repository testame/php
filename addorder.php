<?php
	include 'libs/db_connect.php';
	include 'libs/util.php';
	session_start();
	checkLogin();
	$username = getArr($_SESSION,'username');
	$userid= getArr($_SESSION,'id');
?>

<!DOCTYPE HTML>
<html>

<head>
	<title> POLDO </title>

</head>

<body>

	<a href="index.php">Home </a>

	<form method="POST">
		<br>
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

		echo "<table border='1'>";
		echo "<tr>";
		echo "<th>NOME</th>";
		echo "<th>DESCR</th>";
		echo "<th>PREZZO</th>";
		echo "</tr>";

		$i = 0;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr>";
			echo "<td>" . $row['nome'] . "</td>";
			echo "<td>" . $row['descr'] . "</td>";
			echo "<td>" . $row['prezzo'] . "</td>";
			echo "<td> qta: <input type='numeric' name='qta[".$i."]'/><input type ='hidden' name='id[".$i."]' value='" . $row['id'] . "'\></td>";
			$i++;


			echo "</tr>";
		}
		echo "</table>";
		echo "<input type ='hidden' name='numprod' value='$i'\>";


		?>


		<input type="submit" value="Aggiungi" />
	</form>

	<?php
	if ($_POST) {
		$numprod = getArr($_POST, "numprod");
		if ($numprod == "")
			$numprod = 0;
		$ordval = false;
		for ($i = 0; $i < $_POST['numprod']; $i++) {
			if (!is_numeric($_POST['qta'][$i]))
				$_POST['qta'][$i] = '0';
			if (intval(($_POST['qta'][$i]) > 0))
				$ordval = true;
		}

		if ($ordval) {  // c'è almeno un panino
			$query = "INSERT INTO ordini(idutente,data) VALUES (?,?)";
			try {
				$stmt = $con->prepare($query);

				$stmt->execute(array($userid, date('Y-m-d')));

				//$stmt->execute(array($username, "2021-03-17"));
				$lid = $con->lastInsertId();

				$query = "INSERT INTO dettagli(idordine,idprodotto,qta) VALUES (?,?,?)";
				$stmt = $con->prepare($query);
				for ($i = 0; $i < $_POST['numprod']; $i++) {
					if (intval(($_POST['qta'][$i]) > 0)) {
						$stmt->execute(array($lid, $_POST['id'][$i], $_POST['qta'][$i]));
					}
				}
			} catch (Exception $ex) {
				print("Errore!" . $ex);
			}
		} else {
			print(" <b> nessun ordine ....</b>");
		}
	}

	?>

</body>

</html>