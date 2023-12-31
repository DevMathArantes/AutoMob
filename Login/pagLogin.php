<?php
//Deve estar presente em todas as paginas
include_once '../BackEnd/sessao.php';
include_once "../backEnd/modulos/permissionManager.php";
include_once "../backEnd/conexao.php";
$db = new Conexao();
if (logued()) {
    redirectByPermission();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="pagLogin.css">
    <script src="../backEnd/script.js"></script>
</head>

<body>
    <div id="titulo">
        <h1><img class="iconeTitulos" src="../Imgs/icoBandeira.png" alt="icone volante"> Auto escola Automob <img class="iconeTitulos" src="../Imgs/icoBandeira.png" alt="icone volante"></h1>
    </div>
    <div id="painel1" class="painelCentral">
        <form action="../backEnd/login/processLogin.php" method="POST">
            <h2>AUTOMOB</h2>
            <p><img class="icone" src="../Imgs/icoUsuario.png" alt="Icone usuario"> Acesse seu perfil:</p>
            <input type="text" id="cpfLog" name="User" placeholder="CPF" oninput="maskCPF('cpfLog')">
            <input type="password" name="Pass" placeholder="Senha">
            <input id="Logar" type="submit" value="Login">
            <span onclick="trocar(painel1,painel2)">Cadastre-se</span>
        </form>
        <?php
        if (isset($_GET["cadSucess"])) {
            msg(MSG_POSITIVE_BG, "Usuário cadastrado com sucesso!", "msgPopUp msgMargin", null, "msg1", 4000);
        }
        ?>
    </div>
    <div id="painel2" style="display: none;" class="painelCentral">
        <form action="../backEnd/cadastro/processCadastro.php" method="POST" onsubmit="return validateForm()" novalidate>
            <h2>AUTOMOB</h2>
            <p><img class="icone" src="../Imgs/icoUsuario.png" alt="Icone usuario">Cadastre seu perfil:</p>
            <input type="text" id="nome" name="nome" placeholder="Nome">
            <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome">
            <input type="date" id="data" name="dtNascimento" placeholder="Data de nascimento">
            <input type="text" name="endereco" placeholder="Endereço">
            <input type="text" id="cpfCad" name="cpf" placeholder="CPF" oninput="maskCPF('cpfCad')">
            <input type="text" id="telefone" name="telefone" placeholder="Telefone" oninput="maskTelefone(this)" maxlength="14" minlength="14">
            <input type="email" id="email" name="email" placeholder="E-mail">
            <input type="password" id="senha" name="senha" placeholder="Senha">
            <select name="tipo" id="">
                <option value="">Selecione um usuário</option>
                <?php
                    $result = $db->executar("SELECT id, tipoNome FROM tipos");
                    foreach($result AS $tipos){
                        $idTipo = $tipos['id'];
                        $nomeTipo = $tipos['tipoNome'];
                        echo "<option value='$idTipo'>$nomeTipo</option>";
                    }
                ?>
            </select>
            <input style="background-color: #3636ca;color: white;" type="submit" value="Solicitar">
            <span onclick="trocar(painel2,painel1)">Voltar</span>
        </form>
        <div class="msgN">
            <span id="nomeError">
                <?php if (isset($nomeError)) {
                    echo $nomeError;
                } ?></span>

            <span id="cpfError"><?php if (isset($cpfError)) {
                                    echo $cpfError;
                                } ?></span>

            <span id="dtError"><?php if (isset($dtError)) {
                                    echo $dtError;
                                } ?></span>

            <span id="emailError"><?php if (isset($emailError)) {
                                        echo $emailError;
                                    } ?></span>

            <span id="passwordError"><?php if (isset($passwordError)) {
                                            echo $passwordError;
                                        } ?></span>
        </div>

    </div>
    <script src="../index.js"></script>
</body>

</html>