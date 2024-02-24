<?php

// somewhere early in your project's loading, require the Composer autoloader
// see: http://getcomposer.org/doc/00-intro.md
require './vendor/autoload.php';

// incluir conexao com BD
include_once './conexao.php';

//Query para recuperar os registros do banco de dados
$query_usuarios = "SELECT id, nome, email FROM usuarios";

//Preparar a QUERY
$result_usuarios = $conn->prepare($query_usuarios);

//EXECUTAR A QUERY
$result_usuarios->execute();

//Informações para o PDF 
$dados = "!<DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='http://localhost/testepdf/css/estilo.css'>";
$dados .= "<title>Minha Carteira </title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<h1> Minha Carteira </h1>";

//Ler os registros retornado do BD
while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
    //var_dump($row_usuario);
    extract($row_usuario);
    $dados .= "ID: $id <br>";
    $dados .= "NOME: $nome <br>";
    $dados .= "E-MAIL: $email <br>";
    $dados .= "<hr>";
}

// $dados .= "<img src='http://localhost/testepdf/imagens/logo_minha_carteira1.png' <br>";
// $dados .= "O PHP proin aidfajk jkçld asdfm nhbujb bf.r nuf nag;.a;n;kfnbn.nm,nalagjklglueqwuglkgaak uj.gjj
// nsfgnss,bsg.sgss,fgshgb bjjbf jb jb vb ljfdgçsj jb.jbb jb";
$dados .= "</body>";

//reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf(['enable_remote' => true]);

$dompdf->loadHtml($dados);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();