 <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
  <title>Cadastro</title>

     <link rel="stylesheet" href="_css/estilo.css" />

</head>


<body>
<?php require_once 'process.php';?>

<?php
	if(isset($_SESSION['message'])): ?>
	
	<div class = "alert<?=$_SESSION['msg_type']?>">
	
		<?php
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>
 <?php
	$mysqli = new mysqli('localhost', 'root', '', 'crud', '3308') or die(mysqli_error($mysqli));
	$result = $mysqli->query("SELECT * FROM dados") or die($mysqli->error);
	//pre_r($result); 
	?>
	
	 <div class="row">
	<table id="tabelaspec">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Localização</th>
				<th colspan="2">Acção</th>
			</tr>
		</thead>
    <?php
			while($row = $result->fetch_assoc()):?>
			<tr>
				<td><?php echo $row['nome']; ?></td>
				<td><?php echo $row['localizacao']; ?></td>
				<td>
					<a href="index.php?edit=<?php echo $row['id']; ?>"
						class="btn-edit">Edit</a>
						
					<a href="process.php?delete=<?php echo $row['id'];?>"
						class="btn-del">Delete</a>
				</td>
			</tr>
		<?php endwhile; ?>
	</table>
 </div>
	
	<?php
	pre_r($result->fetch_assoc());
	
	function pre_r($array){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
 ?>
 

<form method="POST" action="process.php">
	<input type="hidden" name="id" value="<?php echo $id; ?>"> 

<fieldset id="usuario"><legend>Identificação do Usuário</legend>
    <p><label for="cNome"> Nome:</label><input type="text" name="nome" id="cNome" value="<?php echo $nome; ?>" size="30" maxlength="30" placeholder="Nome Completo"/></p>
    <p><label for="cLoc">Localização:</label><input type="txt" name="localizacao" value="<?php echo $localizacao; ?>" id="cLoc" size="30" maxlength="30" placeholder="Sua localização"/></p>
</fieldset>

	<?php 
	if($update==true):
	?>
		<button type="submit" id="btn" name="update">Actualizar</button>
	<?php else: ?>
		<button type="submit" name="guardar" id="btn">Guardar</button>
	<?php endif; ?>
	
</form>

</body>
</html>