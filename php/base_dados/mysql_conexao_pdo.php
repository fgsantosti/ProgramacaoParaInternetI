<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
	//instancia objeto PDO, conectando no MySQL
    $conn = new PDO("mysql:host=$servername;dbname=livro", $username, $password);
    // apresenta o erro PDO 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexao realizada com sucesso!"; 
}catch(PDOException $e){
    echo "Conexao falhou: " . $e->getMessage();
}