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
			

		}
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
<title>Bem-Fazer</title>
</head>
<main id="main-doc">
<body>
<p><b>Inscrever Utente em serviço: </b></p>
<?php
	$sql ="SELECT codUtente, nome FROM tpdam.tblutente;";
	$stmt = $mysqli->prepare($sql);
	$stmt->execute();
    $stmt->bind_result($idUte, $nomeUte);

	printf("<form action='' method='post'>");
	printf("<label for='Utente'>Utente: </label>");
	printf("<select name='Utente'>");
	while ($stmt->fetch()){
		printf("<p>");
		printf("<option value = $idUte> $nomeUte </option>" );
		printf("</p>");
	}
	printf("</select>");
	printf("<br>");

	$sql2 ="SELECT codServico,descricao FROM tpdam.tblservico;";
	$stmt2 = $mysqli->prepare($sql2);
	$stmt2->execute();
    $stmt2->bind_result($codServ,$nomServ);

	printf("<form action='' method='post'>");
	printf("<label for='Serv'>Serviço: </label>");
	printf("<select name='Serv'>");
	while ($stmt2->fetch()){
		printf("<p>");
		printf("<option value = $codServ>$nomServ</option>" );
		printf("</p>");
	}
	printf("</select>");
	printf("<br>");
	$stmt2->close();

	$sql3 ="SELECT codPrestador,nome FROM tpdam.tblprestador;";
	$stmt3 = $mysqli->prepare($sql3);
	$stmt3->execute();
    $stmt3->bind_result($idPrest, $nomePrest);

	printf("<label for='Prestador'>Prestador: </label>");
	printf("<select name='Prestador'>");
	while ($stmt3->fetch()){
		printf("<p>");
		printf("<option value = $idPrest> $nomePrest </option>" );
		printf("</p>");
	}
	printf("</select>");
	printf("<br>");

	$sql5 ="SELECT codPrestadorServico FROM tpdam.relprestadorservicos where tblServico_codServico=? and tblPrestador_codPrestador=?;";
	$stmt5 = $mysqli->prepare($sql5);
	$stmt5->bind_param("ii",$codServ,$idPrest);
	$stmt5->execute();
    $stmt5->bind_result($idPrestServ);
	$stmt5->close();

	printf("<label for='dataIniServ'>Data para inicio do serviço:</label>");
	printf("<input type='datetime-local' id='dataIniServ' name='dataIniServ' required>");
	printf("<br>");
	printf("<label for='dataFimServ'>Data para fim do serviço:</label>");
	printf("<input type='datetime-local' id='dataFimServ' name='dataFimServ' required>");
	printf("<br>");
	printf("<label for='descrServ'>Descrição do serviço:</label>");
	printf("<input type='text' id='descrServ' name='descrServ'>");
	printf("<br>");
	printf("<input type='submit' value='Enviar!'/>");
	printf("</form>");
	if (isset($_POST['Utente'])) {
		$idUte = $_POST['Utente'];
		$codServ = $_POST['Serv'];
		$idPrest = $_POST['Prestador'];
		$dataIni = date("Y-m-d H:i:s", strtotime($_POST['dataIniServ']));
		$dataFim = date("Y-m-d H:i:s", strtotime($_POST['dataFimServ']));
		$obs=$_POST['descrServ'];
	}

	
	$sql4 = "INSERT INTO `tpdam`.`relreservaprestacaoservicos` (`codServico`,`codPrestador`,`dataInicio`,`dataFim`,`obs`,`relPrestadorServicos_codPrestadorServico`,`relPrestadorServicos_tblServico_codServico`,`relPrestadorServicos_tblPrestador_codPrestador`,`tblUtente_codUtente`,`tblOperadores_codOpreador`) VALUES (?,?,?,?,?,?,?,?,?,?);";
	$stmt4 = $mysqli->prepare($sql4);
	$stmt4->bind_param("iisssiiiii",$codServ,$idPrest,$dataIni,$dataFim,$obs,$idPrestServ,$codServ,$idPrest,$idUte,$user);
	$stmt4->execute();
	$stmt4->close();

	
?>
<p><b>Alterar data de serviço: </b></p>
<?php
	$sql6 ="SELECT docReservaPrestacaoServicos,obs FROM tpdam.relreservaprestacaoservicos;";
	$stmt6 = $mysqli->prepare($sql6);
	$stmt6->execute();
    $stmt6->bind_result($idPS, $obs);
	$stmt6->execute();
	printf("<form action='' method='post'>");
	printf("<label for='Serv'>Serviço a ser alterado: </label>");
	printf("<select name='Serv'>");
	while ($stmt6->fetch()){
		printf("<p>");
		printf("<option value = $idPS>$obs</option>" );
		printf("</p>");
	}
	printf("</select>");
	printf("<br>");
	printf("<label for='dataIniServAtt'>Data para inicio do serviço:</label>");
	printf("<input type='datetime-local' id='dataIniServAtt' name='dataIniServAtt' required>");
	printf("<br>");
	printf("<label for='dataFimServAtt'>Data para fim do serviço:</label>");
	printf("<input type='datetime-local' id='dataFimServAtt' name='dataFimServAtt' required>");
	printf("<br>");
	printf("<input type='submit' value='Enviar!'/>");
	printf("</form>");

	if (isset($_POST['Serv']) && is_array($_POST['Serv'])) {
		foreach($_POST['Serv'] as $idPS){
			$dataIniAtt = date("Y-m-d H:i:s", strtotime($_POST['dataIniServAtt']));
			$dataFimAtt = date("Y-m-d H:i:s", strtotime($_POST['dataFimServAtt']));
			$sql7= "UPDATE dataInicio,dataFim FROM tpdam.relreservaprestacaoservicos SET dataInicio=?,dataFim=? WHERE docReservaPrestacaoServicos=?;";
			$stmt7 = $mysqli->prepare($sql7);
			$stmt7->bind_param("ssi",$dataIniAtt, $dataFimAtt,$idPS);
			$stmt7->execute();
		} 
	}
?>

<p><b>Realizar backup para XML: </b></p>
<form action='dump.php' method='post'>
<select name='dump' id='dump'>
<option value="tblutente">Backup da lista de utentes</option>
<option value="tbloperadores">Backup da lista de operadores</option>
<option value="relreservaprestacaoservicos">Backup da lista de serviços</option>
</select>
<input type='submit' value='Enviar!'/>
<br>
</form>

<p><b>Realizar upload de XML com dados de utentes: </b></p>
<form action="UploadUte.php" method="post" enctype="multipart/form-data">
Escolha um ficheiro:
<input type="file" name="fich" id="Upload">
<input type="submit" name="submit" value="Iniciar Upload">
</form>  
</body>
</main>
</html>