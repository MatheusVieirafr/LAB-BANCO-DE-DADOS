<?php
session_start();
include("conexao.php");
$matricula = $_POST['matricula'];
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$telefone = $_POST['telefone'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$salario = $_POST['salario'];
$turno_trabalho = $_POST['turno_trabalho'];
$id_funcao = $_POST['id_funcao'];

$result= "UPDATE enfermeiro SET nome='$nome', cpf='$cpf', rg='$rg', endereco='$endereco', telefone='$telefone', celular='$celular', numero='$numero', turno_trabalho='$turno_trabalho',";
$result.= "salario='$salario', bairro='$bairro', cidade='$cidade', estado='$estado', email='$email', id_funcao='$id_funcao' WHERE matricula='$matricula'";
$resultado= mysqli_query($con, $result) or die (mysqli_connect_error());

if(mysqli_affected_rows($con)){
    $_SESSION['msg']= "<p style='color:green;'>Enfermeiro alterado com sucesso</p>";
    header("Location: consulta_enfermeiro.php");
}else{
    $_SESSION['msg']= "<p style='color:green;'>Enfermeiro não foi alterado, verifique!</p>";
    header("Location: consulta_enfermeiro.php");
}
mysqli_close($con);

?>