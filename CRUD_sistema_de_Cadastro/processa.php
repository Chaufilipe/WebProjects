<?php

session_start();//para poder usar o método SESSION

// inicializadas para a situção de não terem valores selecionados na tabela
$id = 0;
$nome = '';
$email = '';
$profissao='';
$actualizar = false;//usada para a troca com o editar

$mysqli = new mysqli('localhost','root','','registro','3308') or die(mysqli_error($mysqli));
//Ao clicar no botão gravar, ele vai inserir na tabela os valores indicados
if(isset($_POST['gravar'])){
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $profissao = $_POST['profissao'];

      $mysqli->query("INSERT INTO usuarios(nome,email,profissao) VALUES('$nome','$email','$profissao')") or die ($mysqli->error);
      //Esta função mostra a mensangem na página mas deve ser inicializada antes, como está em cima: session_start()
      $_SESSION['message']="Conteúdo Gravado com Sucesso!";
      $_SESSION['msg_type'] = "sucesso";

      header('location: index.php');//serve para redirecionar o usuário da página indicada
}

//usamos o GET pois ele mostrará o processamento na URL visto que "apagar" está no xcript do codigo html
if(isset($_GET['apagar'])){
      $id = $_GET['apagar'];
      $mysqli->query("DELETE FROM usuarios WHERE id=$id") or die($mysqli->error());

      $_SESSION['message']="Conteúdo Apagado com Sucesso!";
      $_SESSION['msg_type']="perigo";

      header("location: index.php");
}


if(isset($_GET['editar'])){
      $id= $_GET['editar'];
      $actualizar = true;//para o caso de clicar no botão "editar" então ele mudará para o botão "actualizar"
      $result = $mysqli->query("SELECT * FROM usuarios WHERE id=$id") or die($mysqli->error());

//este array precorrera cada linha para verificar o conteudo que pretendemos editar se foi encontrado
      if($result->num_rows){
            $row = $result->fetch_array();
            $nome = $row['nome'];
            $email = $row['email'];
            $profissao = $row['profissao'];

      }
}

if(isset($_POST['actualizar'])){
      $id = $_POST['id'];
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $profissao= $_POST['profissao'];

      $mysqli->query("UPDATE usuarios SET nome='$nome', email='$email', profissao='$profissao' WHERE id=$id ") or die($mysqli->error);

      $_SESSION['message'] = "Conteúdo Actualizado";
      $_SESSION['msg_type'] = "Atenção";

      header('location: index.php');
}

?>