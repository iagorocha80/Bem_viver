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
        session_start();
        //confere se a sessão do utilizador está ativa
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
            header("location: login.php");
            exit;
        }
        
?>
<?php
    if(isset($_POST['codServ'])){
        $codServ=$_POST['codServ'];
        $nomServ=$_POST['descriServ'];
        $sql="INSERT INTO tpdam.tblservico (`codServico`,`descricao`) VALUES(?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("is",$codServ,$nomServ);
        $stmt->execute();
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
