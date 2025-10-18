<?php
session_start();

// Verifica se o usuário está logado como administrador
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    // Redireciona para o formulário de login (gestao.html)
    header("Location: gestao.html");
    exit;
}
?>
    
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Restrita - Espaço Tia Jú</title>
    <link rel="stylesheet" href="telainicial-sistema.css">
    <script src="sistema.js" defer></script>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="logo-nav">
                <img src="img/LOGO.png" alt="">
            </div>
            <div class="nav-list">
                <p>PÁGINAS</p>
                <ul>
                    <li>
                        <a href="#" title="Créditos: Flaticon - ícone Home" target="_blank">
                            <img src="img/home.png" alt="Home">
                        </a>
                        <a href="telainicial-sistema.html">Início</a>
                    </li>
                    <li>
                        <a href="#" title="Créditos: Flaticon - ícone Administração" target="_blank">
                            <img src="img/settings.png" alt="Administração">
                        </a>
                        <a href="administradores.html">Administração</a>
                    </li>
                    <li>
                        <a href="#" title="Créditos: Flaticon - ícone Alunos" target="_blank">
                            <img src="img/group.png" alt="Alunos">
                        </a>
                        <a href="alunos.html">Alunos</a>
                    </li>
                    <li>
                        <a href="#" title="Créditos: Flaticon - ícone Calendário" target="_blank">
                            <img src="img/calendar.png" alt="Calendário">
                        </a>
                        <a href="calendario.html">Calendário</a>
                    </li>
                    <li>
                        <a href="#" title="Créditos: Flaticon - ícone Voluntários" target="_blank">
                            <img src="img/love.png" alt="Voluntários">
                        </a>
                        <a href="voluntario.html">Voluntários</a>
                    </li>
                </ul>
            </div>
            <div class="sair-conta">
                <ul>
                    <li>
                        <a href="#"><img src="img/account.png" alt=""></a>
                        <button id="perfilBtn">Perfil</button>
                    </li>
                    <li>
                        <a href="#"><img src="img/exit.png" alt=""></a>
                        <a href="logout.php"><button>Sair da conta</button></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="perfil">
            <div class="foto-perfil">
                <img id="img-perfil" src="img/user_7324850.png" alt="Foto do perfil">
                <input type="file" id="upload-perfil1" accept="image/*">
            </div>
            <p style="margin-top: 7px;" id="nome-perfil">
                <?php echo htmlspecialchars($_SESSION['nome']); ?>
            </p>
        </div>

        <div class="conteudo">
            <div class="topo">
                <h1>Sistema<br>Espaço Tia Jú</h1>
            </div>

            <div class="cards">
                <div class="flex">
                    <div class="card"> 
                        <div class="card-flex">
                            <img src="img/audience.png" alt="">
                            <p class="numero" id="qtd-alunos">--</p>
                        </div>
                        <p>Alunos cadastrados</p>
                    </div>
                    <div class="card">
                        <div class="card-flex">
                            <img src="img/love1.png" alt="">
                            <p class="numero" id="qtd-voluntarios">--</p>
                        </div>
                        <p>Voluntários</p>
                    </div>
                    <div class="card"> 
                        <div class="card-flex">
                            <img src="img/manager.png" alt="">
                            <p class="numero" id="qtd-admins">--</p>
                        </div>
                        <p>Administradores</p>
                    </div>
                </div>
                <div class="flex1">
                    <div class="card"> 
                        <div class="card-flex">
                            <img src="img/event.png" alt="">
                            <p class="numero" id="qtd-eventos">--</p>
                        </div>
                        <p>Eventos</p>
                    </div>
                    <div class="card"> 
                        <div class="card-flex">
                            <img src="img/text.png">
                            <p class="numero" id="qtd-anotacoes">--</p>
                        </div>
                        <p>Anotações</p>
                    </div>
                </div>
            </div>

            <div class="evento">
                <h3>Próximo evento:</h3>
                <div class="capa-evento">
                    <span class="placeholder-text">Sem eventos próximos</span>
                    <img id="imagem-evento" src="" alt="Capa do evento">
                </div>
                <p id="nome-evento">Nome do evento</p>
                <small id="data-evento" style="font-size: 2rem;">--/--/----</small>
            </div>
        </div>

        <div id="loginModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeBtn">&times;</span>
                <form class="login-form">
                    <img id="foto-perfil" src="img/user_7324850.png" alt="Foto do perfil">
                    <label for="upload-perfil2" class="estilizar-img">Adicionar imagem</label>
                    <input type="file" id="upload-perfil2" accept="image/*" hidden>
                    <label for="text">Nome</label>
                    <input type="text" id="Nome-exibido" required />
                    <label for="date">Data de nascimento</label>
                    <input type="date">
                    <label for="name">Sua descrição</label>
                    <input type="text" placeholder="">
                    <button type="submit">Salvar perfil</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
