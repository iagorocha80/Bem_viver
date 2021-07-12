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
	// Define as variaveis de login
	if(isset($_POST['nomOp'])){
		$test="funfa";
		$nomOp=$_POST['nomOp'];
		$passOp=$_POST['passOp'];
		$tipOp=$_POST['TipOp'];
		$foneOp=$_POST['foneOp'];
		$moradaOp=$_POST['moradaOp'];
		$hashed_password = password_hash($passOp, PASSWORD_DEFAULT);
		$sql = "INSERT INTO tpdam.tbloperadores (nome,morada,telefone,`password`,tblTipoOperador_codTipoOperador) VALUES (?,?,?,?,?);";
		$stmt = $mysqli->prepare($sql);
        echo $mysqli -> error;
		$stmt->bind_param("ssiss",$nomOp,$hashed_password,$tipOp,$foneOP,$moradaOp);
		$stmt->execute();
		$stmt->close();
	}
	echo $test;
    echo "<br>";
    echo $tipOp;
    echo "<br>";
    echo $passOp;
    echo "<br>";
    echo  $hashed_password;
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