<?php
session_start();
include("conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$rg = $_POST['rg'];
$telefone = $_POST['telefone'];
$celular = $_POST['celular'];
$email = $_POST['email'];

$result = "UPDATE paciente SET nome='$nome', cpf='$cpf', endereco='$endereco', numero='$numero',";
$result .= " complemento='$complemento', bairro='$bairro', cidade='$cidade', estado='$estado',";
$result .= " rg='$rg', telefone='$telefone', celular='$celular', email='$email' WHERE id='$id'";
$resultado = mysqli_query($con, $result) or die(mysqli_connect_error());

if (mysqli_affected_rows($con)) {
    $_SESSION['msg'] = "<p style='color:green;'>Paciente alterado com sucesso</p>";
    header("Location: consu_paciente.php");
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Paciente não foi alterado, verifique</p>";
    header("Location: consu_paciente.php");
}

mysqli_close($con);
?>
