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
    if(isset($_POST['nomUte'])){
        $nomUte=$_POST['nomUte'];
        $foneUte=$_POST['foneUte'];
        $moradaUte=$_POST['moradaUte'];
        $sql="INSERT INTO tpdam.tblutente (`nome`,`morada`,`telefone`) VALUES(?,?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sss",$nomUte,$moradaUte,$foneUte);
        $stmt->execute();
        $stmt->close();    
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
