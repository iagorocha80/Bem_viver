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
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_FILES["fich"]) && $_FILES["fich"]["error"] == 0){
        $allowed = array("xml" => "text/xml");
        $filename = $_FILES["fich"]["name"];
        $filetype = $_FILES["fich"]["type"];
        $filesize = $_FILES["fich"]["size"];
    
       
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Erro: Tipo de ficheiro inválido");
    
        
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Erro: Tamanho do ficheiro ultrapassa o máximo suportado pelo servidor");
    
        
        if(in_array($filetype, $allowed)){
            
            if(file_exists("upload/" . $filename)){
                echo $filename . " Ficheiro já existente";
            } else{
                move_uploaded_file($_FILES["fich"]["tmp_name"], "upload/" . $filename);
                echo "Upload bem sucessedido";
            } 
        } else{
            echo "Erro"; 
        }
    } else{
        echo "Erro: " . $_FILES["fich"]["error"];
    }
}  
?>

<?php
    $affectedRow = 0;
    $xml = simplexml_load_file("upload/".$filename) or die("Error: Cannot create object");
    foreach ($xml->children() as $row) {
        $codUtente = $row->codUtente;
        $nome = $row->nome;
        $morada = $row->morada;
        $telefone = $row->telefone;
        
        $sql = "INSERT INTO tpdam.tblutente(`codUtente`,`nome`,`morada`,`telefone`) VALUES(?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("isss",$codUtente,$nome,$morada,$telefone);
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