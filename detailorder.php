<!DOCTYPE html>
<?php
include "libs/db_connect.php";
include "libs/util.php";
session_start();
checkLogin();
$iduser = intval(getArr($_SESSION, 'id'));
$orderid = intval(getArr($_GET, 'orderid'));
try {
    //Controlla anche che l'ordine appartenga all'utente
    $query = "SELECT p.id, p.nome, p.descr, p.prezzo, d.qta FROM ordini o join dettagli d on (o.id=d.idordine) join prodotti p on (p.id=d.idprodotto) where o.idutente=? and o.id=?";
    $stmt = $con->prepare($query);
    $stmt->execute(array($iduser, $orderid));
    $rownums = $stmt->rowCount();
} catch (Exception $ex) {
    print("Error: " . $ex);
}
?>

<head>
    <title>Dettagli ordine</title>
</head>

<body>
    <?php if ($rownums > 0) : ?>
        <table border='1'>
            <tr>
                <th>IDProd</th>
                <th>Nome</th>
                <th>Descrizione</th>
                <th>Prezzo</th>
                <th>Qta</th>
            </tr>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['descr'] . "</td>";
                echo "<td>" . $row['prezzo'] . "</td>";
                echo "<td>" . $row['qta'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="index.php">Home</a>
    <?php endif; ?>
</body>