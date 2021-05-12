<?php
include 'libs/db_connect.php';
include 'libs/util.php';
session_start();
checkLogin();
?>
<!DOCTYPE HTML>
<html>

<head>
    <title> POLDO </title>

</head>

<body>

    <a href="index.php">Home </a>

    <form method="POST">
        nome: <input type="text" name="nome" /> <br>
        descr: <input type="text" name="descr" /> <br>
        prezzo[.]: <input type="decimal" name="prezzo" /> <br>

        <input type="submit" value="Aggiungi" />
    </form>

    <?php
    if ($_POST) {
        $nome = getArr($_POST, "nome");
        $descr = getArr($_POST, "descr");
        $prezzo = getArr($_POST, "prezzo");

        if ($nome != "" && $descr != "" && $prezzo != "") {
            $query = "INSERT INTO prodotti (nome,descr,prezzo) VALUES (?,?,?)";
            try {
                $stmt = $con->prepare($query);
                $stmt->execute(array($nome, $descr, $prezzo));
            } catch (Exception $ex) {
                print("Errore!" . $ex);
            }
        } else {
            print(" <b> parametri non inseriti </b>");
        }
    }
    ?>

</body>

</html>