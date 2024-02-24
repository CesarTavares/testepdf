<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "testepdf";
$port = 3306;
try {
    //Conexão com a porta 3306
    //$conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);
     
    $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
    //echo "Conexão com Banco de Dados realizada com sucesso!!!!!!!";
} catch (PDOException $err) {
    echo "Erro: Conexão com Banco de Dados não realizado com sucesso. Erro gerado " . $err->getMessage();
}
