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

<form method="POST"  >
            
            nome: <input type="text" name="username"/> <br>
            password: <input type="password" name="pass1"/> <br>
            password: <input type="password" name="pass2"/> <br>
            mail: <input type="text" name="mail"/> <br>
            
            <input type="submit" value="Aggiungi"/>
        </form>

<?php
	if ($_POST) {
        $username= getArr($_POST, "username");
        $pass1= getArr($_POST, "pass1");
        $pass2= getArr($_POST, "pass2");
        $mail= getArr($_POST, "mail");

	
        if ( $username!="" && $pass1!="" && $pass2!=""&& $mail!="")
        {
			if ($pass1 ==$pass2) {
				$query="INSERT INTO utenti(username,password,mail) VALUES (?,?,?)";
				try{
					$stmt=$con->prepare($query);
					$stmt->execute(array($username, hash('sha256',$pass1),$mail));
				} catch (Exception $ex) {
					print("Errore!" . $ex);
				}
			} else{
				print(" <b> password non coincidenti</b>");
				
			}
			
			
		}else
		{
			print(" <b> mancano parametri  </b>");
		}
	}
?>
        
    </body>
</html>

