<?php 
	    // liga à base dados 
	    include("config.php");		        
	    $mysqli = new mysqli($host, $user, $pw, $bd); 
	    if ($mysqli->connect_errno){
	            die("Erro fatal: " . $mysqli->connect_error);
	    }	
?>
<?php
		session_start();
        //confere se a sessão do utilizador está ativa
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
            header("location: login.php");
            exit;
        }
		
?>
<?php
	if(isset($_POST['dump'])){
		$tbl= $_POST['dump'];
		$xml = new SimpleXMLElement("<$tbl/>");
		$stmt = $mysqli->query("SELECT * FROM $tbl");
		
		while($row = $stmt->fetch_assoc()){
			$elem = $xml->addChild('elem');
		 
			foreach ($row as $key => $value) {
			$elem->addChild($key, $value);
			}
		}
		$xml->saveXML('dump.xml');
		header('Content-disposition: attachment; filename="dump.xml"');
        header('Content-type: "text/xml"; charset="utf8"');
        readfile('dump.xml');
		exit;
	}
	
?>
<?php
    if($_SESSION['type']=='1'){
		header("location: adm.php");
		exit;
	}
	else if($_SESSION['type']=='2'){
		header("location: op.php");
		exit;
	}
	else{
		header("location: login.php");
		exit;
	}

?>