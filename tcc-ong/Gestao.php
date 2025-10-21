<?php
// gestao.php
// página de login para administradores
?>
<!DOCTYPE html>
<html lang="pt‑BR">
<head>
    <meta charset="UTF‑8" />
    <meta name="viewport" content="width=device‑width, initial‑scale=1" />
    <title>Login ‑ Gestão</title>
    <link rel="stylesheet" href="gestao.css" />
</head>
<body>
    <div class="navbar">
        <div class="Logo"><img src="img/LOGO.png" alt="" class="Logo1"></div>
        <ul class="nav-list">
            <li class="nav-item"><a href="index.html">Início</a></li>
            <li class="nav-item"><a href="Projeto.html">Projeto</a></li>
            <li class="nav-item"><a href="Serviços.html">Serviços</a></li>
            <li class="nav-item"><a href="Sobrenos.html">Sobre Nós</a></li>
            <li class="nav-item"><a href="gestao.php">Gestão</a></li>
            <li class="nav-item"><a id="contato" href="#rodape">Contato</a></li>
            <li class="nav-item" id="Colabore"><a id="colabore" href="Colabore.html">Colabore</a></li>
        </ul>
    </div>

    <h1>GESTÃO</h1>
    <p>Área Reservada Apenas para Administradores</p>

    <div class="acesso-gestao">
        <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            echo '<div style="color:red; margin-bottom:10px;">';
            switch ($error) {
                case 'preencha_todos_campos':
                    echo "Por favor, preencha todos os campos.";
                    break;
                case 'acesso_negado':
                    echo "Acesso negado. Apenas administradores têm permissão.";
                    break;
                case 'senha_incorreta':
                    echo "Senha incorreta.";
                    break;
                case 'email_nao_cadastrado':
                    echo "Email não cadastrado.";
                    break;
                default:
                    echo "Erro desconhecido.";
            }
            echo '</div>';
        }
        ?>
        <form action="login.php" method="POST" class="login">
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required />
            </div>
            <div>
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required />
            </div>
            <div class="button">
                <button type="submit">ENTRAR</button>
            </div>
        </form>
    </div>  

    <div class="rodape" id="rodape">
        <div class="logo-rodape">
            <img src="img/LOGO.png" alt="">
        </div>
        <div class="inf-rodape">
            <div class="redes">
                <h1>Redes Sociais</h1>
                <div class="insta">
                    <a href="https://www.flaticon.com/br/icones-gratis/logotipo-do-instagram" title="logotipo do instagram ícones" target="_blank">
                        <img src="img/instagram (1).png" alt="">
                    </a>
                    <p>@espacotiaju</p>
                </div>
                <div class="facebook">
                    <a href="https://www.flaticon.com/br/icones-gratis/facebook" title="facebook ícones" target="_blank">
                        <img src="img/facebook (1).png" alt="">
                    </a>
                    <p style="color: black;">Espaço de Leitura Tia Jú</p>
                </div>
                <div class="youtube">
                    <a href="https://www.flaticon.com/br/icones-gratis/youtube" title="youtube ícones" target="_blank">
                        <img src="img/youtube.png" alt="">
                    </a>
                    <p>@EspaçoTiaJu</p>
                </div>
            </div>
            <div class="formas-contato">
                <h1>Formas de contato</h1>
                <div class="whatsapp">
                    <a href="https://www.flaticon.com/br/icones-gratis/whatsapp" title="whatsapp ícones" target="_blank">
                        <img src="img/whatsapp (1).png" alt="">
                    </a>
                    <p style="color: black;">+55 13 99638‑4626</p>
                </div>
                <div class="email">
                    <a href="https://www.flaticon.com/br/icones-gratis/gmail" title="gmail ícones" target="_blank">
                        <img src="img/gmail.png" alt="">
                    </a>
                    <p>associacaotiajumongagua@gmail.com</p>
                </div>
            </div>
            <div class="localizacao">
                <h1>Localização</h1>
                <p>Rua Santa Cecilia, 560 Bairro: Agenor de Campos CEP: 11730‑000 Município: Mongaguá Estado: São Paulo</p>
            </div>
        </div>
    </div>
</body>
</html>
