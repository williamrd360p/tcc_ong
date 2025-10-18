<?php
session_start();

$host = "localhost";
$db = "bd_ong";
$user = "usuario";  // Altere para seu usuário do banco
$pass = "senha";    // Altere para sua senha do banco

// Conexão
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Pega dados do formulário
if (!isset($_POST['email'], $_POST['senha'])) {
    // Dados não enviados
    header("Location: gestao.html?error=preencha_todos_campos");
    exit;
}

$email = $_POST['email'];
$senha = $_POST['senha'];

// Prepara consulta
$stmt = $conn->prepare("SELECT senha, tipo_usuario, nm_usuario FROM tb_usuario WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hash_senha, $tipo_usuario, $nome);
    $stmt->fetch();

    // Verifica se é administrador
    if ($tipo_usuario !== 'administrador') {
        // Redireciona com erro ou mostra mensagem
        header("Location: gestao.html?error=acesso_negado");
        exit;
    }

    // Verifica senha (hash)
    if (password_verify($senha, $hash_senha)) {
        // Login ok, salva sessão
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $nome;
        $_SESSION['tipo_usuario'] = $tipo_usuario;

        // Redireciona para área restrita
        header("Location: telainicial-sistema.php");
        exit;
    } else {
        // Senha incorreta
        header("Location: gestao.html?error=senha_incorreta");
        exit;
    }
} else {
    // Email não cadastrado
    header("Location: gestao.html?error=email_nao_cadastrado");
    exit;
}

$stmt->close();
$conn->close();
?>
