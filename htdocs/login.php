<?php
// Inicia a sessão
session_start();

// Liga a base de dados
include("config.php");		        
	    $mysqli = new mysqli($host, $user, $pw, $bd); 
	    if ($mysqli->connect_errno){
	            die("Erro fatal: " . $mysqli->connect_error);
	    }

// confere se o usuario já tem login feito
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
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

<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Bem-Fazer</title>
<main id="main-doc">
<body>
<div class="login">
<h1><b>Realizar Login: </b></h1>
<form action='' method='post'>
<label for="username"> Nome do Operador: </label>
<input type="text" name="username" placeholder="Nome" id="username" required>
<br>
<label for="password">Password: </label>
<input type="password" name="password" placeholder="Password" id="password" required>
<br>
<input type="submit" value="Login">
</form>
<?php
    if(isset($_POST['username'], $_POST['password'])){
        $nome=$_POST['username'];
        $passhashed=$_POST['password'];
        $stmt = $mysqli->prepare('SELECT codOpreador, `password`, `tblTipoOperador_codTipoOperador` FROM tpdam.tbloperadores WHERE nome = ?');
        $stmt->bind_param('s', $nome);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password,$tipOp);
            $stmt->fetch();
            if (password_verify($passhashed, $password)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $nome;
                $_SESSION['id'] = $id;
                $_SESSION['type'] = $tipOp;
                echo $_SESSION['type'];
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
                $stmt->close();
            } else {
                echo 'Password inválida';
            }
        } else {
            echo 'Nome do Operador inválido';
        }
    }
?>
<?php
    /*$sql ="SELECT `tblTipoOperador_codTipoOperador` FROM tpdam.tbloperadores WHERE nome= ? and codOpreador = ?;";
    $stmt2 = $mysqli->prepare($sql);
    echo $mysqli->error;
    $stmt2->bind_param('si',$nome,$id);
    $stmt2->execute();
    $stmt2->bind_result($tipOp);
    printf($tipOp);
    echo $tipOp;
    if($tipOp=='1'){
        header("location: adm.php");
    }
    else if($tipOp=='2'){
        header("location: op.php");
    }
    else{}*/
?>
</div>
</body>
</main>
</head>
</html>

