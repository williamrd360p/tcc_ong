<?php
$nome = trim($_POST['nome']);
$tipo_usuario = $_POST['tipo_usuario']; // para 'voluntario' ou 'aluno'

if ($tipo_usuario !== 'voluntario' && $tipo_usuario !== 'aluno') {
    die("Tipo inválido");
}

$stmt = $conn->prepare("INSERT INTO usuarios (nome, tipo_usuario) VALUES (?, ?)");
$stmt->bind_param("ss", $nome, $tipo_usuario);
$stmt->execute();
