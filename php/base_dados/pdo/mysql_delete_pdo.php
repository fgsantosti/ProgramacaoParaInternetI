<?php
	//Delete via lista
	$id = $_GET["id"];
  	
  	//Alteração direta
  	//$id = 8; 

	//incluindo as funcionalidaes do arquivo mysql_conexao_pdo.php
	include_once 'mysql_conexao_pdo.php';
	try {
		//executa uma instrução SQL de update
		$result = $conn -> query("DELETE FROM famosos WHERE idFamosos = '{$id}'");
		if ($result) {
			echo "Deletado com sucesso!<br>";
			header("Location:mysql_lista_pdo_obj.php");
		}else{
			echo "Erro ao deletar!";
		}	
		$conn = null;
	} catch (PDOException $e) {
		print "Erro!: ". $e -> getMessage(). "<br>";
	}

	//echo '<a href="mysql_lista_pdo_obj.php">Voltar para Página listar</a>';