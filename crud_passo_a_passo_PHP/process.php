<?php

session_start();

$mysqli = new mysqli('localhost','root','','crud','3308') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$nome = '';
$localizacao = '';

if (isset($_POST['guardar'])){
	$nome = $_POST['nome'];
	$localizacao = $_POST['localizacao'];
	
	$mysqli->query("INSERT INTO dados (nome,localizacao) VALUES('$nome','$localizacao')") or die ($mysqli->error);
	
	$_SESSION['message'] = "Conteúdo gravado!";
	$_SESSION['msg_type'] = "sucesso";
	
	header("location: index.php");
	
}

if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM dados WHERE id=$id") or die($mysqli->error());
	
	$_SESSION['message'] = "Conteúdo apagado com sucesso!";
	$_SESSION['msg_type'] = "cuidado";
	
	header("location: index.php");
}

if(isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM dados WHERE id=$id") or die($mysqli->error());
	

	if($result->num_rows){
		$row = $result->fetch_array();
		$nome = $row['nome'];
		$localizacao = $row['localizacao'];
	}	
}

if (isset($_POST['update'])){
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$localizacao = $_POST['localizacao'];
	
	$mysqli->query("UPDATE dados SET nome = '$nome', localizacao='$localizacao' WHERE id=$id") or die($mysqli->error);
	
	$_SESSION['message']= "Conteúdo actualizado!";
	$_SESSION['msg_type'] = "Atencão";

	header('location: index.php');
	
}

?>



 