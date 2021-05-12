<!DOCTYPE html>
<?php
include "libs/db_connect.php";
include "libs/util.php";
session_start();
checkLogin();
$username = getArr($_SESSION, 'username');
$iduser = getArr($_SESSION, 'id');
try {
    $query = "SELECT id, data from ordini where idutente=?";
    $stmt = $con->prepare($query);
    $stmt->execute(array($iduser));
    $rows = $stmt->rowCount();
} catch (Exception $ex) {
    print("Errore!" . $ex);
}
?>

<head>
    <title>Visualizza Ordini</title>
</head>

<body>
<?php if($rows>0) :?>
    <table border='1'>
        <tr>
            <th>ID Ordine</th>
            <th>Data Ordine</th>
            <th>Totale Ordine</th>
            <th>Dettagli Ordine</th>
        </tr>
        <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                try{
                    $querytot = "SELECT sum(d.qta*p.prezzo) as total from dettagli d join prodotti p on (d.idprodotto=p.id) where d.idordine=?";
                    $stmt2 = $con->prepare($querytot);
                    $stmt2 -> execute(array(intval($row['id'])));
                    $tot = $stmt2 -> fetch();
                }
                catch(Exception $ex){
                    print("Error".$ex);
                }
                echo "<tr>";
                echo "<td>" .$row['id']."</td>";
                echo "<td>" .$row['data']."</td>";
                echo "<td>" .$tot['total']. "</td>";
                echo "<td><a href=\"detailorder.php?orderid=".$row['id']."\">dettagli</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <a href="index.php">Home</a>
    <?php else : ?>
    Nessun ordine trovato... Torna alla <a href="index.php">home</a>

<?php endif; ?>

</body>