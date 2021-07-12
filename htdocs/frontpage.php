<?php 
	    // liga à base dados 
	    include("config.php");		        
	    $mysqli = new mysqli($host, $user, $pw, $bd); 
	    if ($mysqli->connect_errno){
	            die("Erro fatal: " . $mysqli->connect_error);
	    }	
      // confere se o usuario já tem login feito
      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $id=$_SESSION["id"];
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
<header id="header">
    <nav id="nav-bar">
      <ul class="nav">
      <li><a class="nav-link" href="#Sobre" rel="internal">Sobre a Bem-Fazer</a></li>
      <li><a class="nav-link" href="#Servicos" rel="internal">Serviços</a></li> 
       <li><a class="nav-link" href="login.php" rel="internal">Log-in</a></li> 
      </ul>
      </nav>
      <br>
</header>
<br>
<main id="main-doc">
<body>
<div><section class="main-section" id="Sobre">
        <h1>Sobre a Bem-Fazer</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </section></div>
      <div><section class="main-section" id="Servicos">
        <h1>Serviços</h1>
        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</p>
      </section></div>
</body>
</main>
</html>