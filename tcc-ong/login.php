<?php
session_start();

// Configuração de conexão
$host = "localhost";
$db   = "bd_ong"; // nome do banco de dados criado
$user = "root";    // Usuário do MySQL
$pass = "";    //senha 


// Criar conexão
$conn = new mysqli($host, $user, $pass, $db);

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se formulário foi enviado corretamente
if (!isset($_POST['email'], $_POST['senha'])) {
    header("Location: gestao.php?error=preencha_todos_campos");
    exit;
}

$email = $_POST['email'];
$senha = $_POST['senha'];

// Prepara consulta segura
if ($stmt = $conn->prepare("SELECT senha, tipo_usuario, nm_usuario FROM tb_usuarios WHERE email = ?")) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hash_senha, $tipo_usuario, $nome);
        $stmt->fetch();

        // Verifica se tipo de usuário é “administrador”
        if ($tipo_usuario !== 'administrador') {
            $stmt->close();
            $conn->close();
            header("Location: gestao.php?error=acesso_negado");
            exit;
        }

        // Verifica senha — assumindo que está usando password_hash / password_verify
        if (password_verify($senha, $hash_senha)) {
            // Login bem‑sucedido
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $nome;
            $_SESSION['tipo_usuario'] = $tipo_usuario;

            // Redireciona para área restrita
            $stmt->close();
            $conn->close();
            header("Location: telainicial-sistema.php");
            exit;
        } else {
            // Senha incorreta
            $stmt->close();
            $conn->close();
            header("Location: gestao.php?error=senha_incorreta");
            exit;
        }

    } else {
        // Email não cadastrado
        $stmt->close();
        $conn->close();
        header("Location: gestao.php?error=email_nao_cadastrado");
        exit;
    }

} else {
    // Erro de preparar a consulta
    $conn->close();
    die("Erro ao preparar consulta.");
}
?>
