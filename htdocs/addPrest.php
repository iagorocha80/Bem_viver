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
    if(isset($_POST['nomPrest'])){
        $nomPrest=$_POST['nomPrest'];
        $fonePrest=$_POST['fonePrest'];
        if(is_numeric($fonePrest)==false){
            $fonePrest=000000000;
        }
        $mailPrest=$_POST['mailPrest'];
        $sexPrest=$_POST['sexPrest'];
        $nascPrest=date("Y-m-d H:i:s", strtotime($_POST['nascPrest']));
        $moradaPrest=$_POST['moradaPrest'];
        $sql="INSERT INTO tpdam.tblprestador (`nome`,`telefone`,`email`,`sexo`,`dataNascimento`,`morada`) VALUES(?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssssss",$nomPrest,$fonePrest,$mailPrest,$sexPrest,$nascPrest,$moradaPrest);
        $stmt->execute();
        $stmt->close();
        $sql2="SELECT codprestador FROM tpdam.tblprestador WHERE nome=? and email=?";
        $stmt2 = $mysqli->prepare($sql2);
        $stmt2->bind_param("ss",$nomPrest,$mailPrest);
        $stmt2->execute();
        $stmt2->bind_result($idPrest);
        $stmt2->close();
        if(is_array($_POST['Serv'])){
            foreach($_POST['Serv'] as $idServ){
                $sql3="INSERT INTO tpdam.relprestadorservicos(`tblServico_codServico`,`tblPrestador_codPrestador`) VALUES(?,?)";
                $stmt3 = $mysqli->prepare($sql3);
                $stmt3->bind_param("ii",$idServ,$idPrest);
            }
        }
        
    }
?>
<?php
    header("location: adm.php");
    exit;
?>
