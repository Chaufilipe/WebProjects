<!DOCTYPE html> 
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Sistema de Cadastro</title>
	<link rel="stylesheet" href="_css/estilo.css">
</head>

<body>
     <?php require_once 'processa.php'; ?>
     
     <?php
            if(isset($_SESSION['message'])): ?> <!--caso seja accionada a função então imprimir o que está em baixo-->

            <div class="alert<?=$_SESSION['msg_type']; ?>">

            <?php
                  echo $_SESSION['message'];
                  unset($_SESSION['message']);
            ?> 
            </div> 

           <?php endif ?>

     <?php
      $mysqli = new mysqli('localhost','root','','registro','3308') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM usuarios") or die($mysqli->error);
     ?>
<div class="container">

      <section> 
            <table class="tabela">
                  <thead>
                        <tr>
                              <th>Nome</th>
                              <th>Profissão</th>
                              <th>Email</th>
                              <th colspan="2">Modificar</th>
                        </tr>

                  </thead>
            <?php
                  while($row = $result->fetch_assoc()):?>
                  <tr>
                        <td><?php echo $row['nome']; ?> </td>
                        <td><?php echo $row['profissao']; ?></td>
                        <td><?php echo $row['email']; ?> </td>
                        <td>
                              <button><a href="index.php?editar=<?php echo $row['id'];?>" class="btn-edit">Editar</a></button>
                              <button><a href="processa.php?apagar=<?php echo $row['id'];?>" class= "btn-apag">Apagar</a></button
                        </td>
                  </tr>
                  <?php endwhile; ?>

            </table>
      </section>  
      	<nav>
      		<ul class="menu">

                  <form id="form" method="POST" action="processa.php">
                        <input type="hidden" name="id" value="<?php echo $id;?>">


                        Nome<br>
                        <input type="text" name="nome" value="<?php echo $nome ;?>" class="campo" maxlength="50" required autofocus><br>
                        Email<br>
                        <input type="email" name="email" value="<?php echo $email; ?>" class="campo" maxlength="50" required><br>
                        Profissão<br>
                        <input type="text" name="profissao" value="<?php echo $profissao; ?>" class="campo" maxlength="30" required>
                        <br>
                        <?php if($actualizar==true): ?>
                              <button type="submit" class="btn" name="actualizar">Actualizar</button>
                        <?php else:?>
                              <button type="submit" class="btn" name="gravar">Gravar</button>
                        <?php endif;?>
                  </form>
      	</nav>
       </div>
</body>
</html>
