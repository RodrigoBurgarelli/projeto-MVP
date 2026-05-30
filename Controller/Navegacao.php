<?php
if (!isset($_SESSION)) {
    session_start();
}

switch (true) {
    
    // 1. ACESSO INICIAL VIA INDEX.PHP
    case empty($_POST):
        include_once __DIR__ . "/../View/login.php";
        break;

    // 2. CLIQUE EM PRIMEIRO ACESSO
    case isset($_POST["btnPrimeiroAcesso"]):
        include_once __DIR__ . "/../View/primeiroAcesso.php";
        break;

    // 3. ENVIAR CADASTRO DE NOVO USUÁRIO
    case isset($_POST["btnCadastrar"]):
        require_once __DIR__ . "/UsuarioController.php";
        $uController = new UsuarioController();
        $sucesso = $uController->inserir($_POST["txtNome"], $_POST["txtCPF"], $_POST["txtEmail"], $_POST["txtSenha"]);
        if ($sucesso) { 
            include_once __DIR__ . "/../View/cadastroRealizado.php"; 
        } else { 
            include_once __DIR__ . "/../View/cadastroNaoRealizado.php"; 
        }
        break;

    // 4. LOGAR COMO CANDIDATO COMUM
    case isset($_POST["btnLogin"]):
        require_once __DIR__ . "/UsuarioController.php";
        $uController = new UsuarioController();
        if ($uController->login($_POST["txtLogin"], $_POST["txtSenha"])) { 
            include_once __DIR__ . "/../View/principal.php"; 
        } else { 
            include_once __DIR__ . "/../View/cadastroNaoRealizado.php"; 
        }
        break;

    // 5. ATUALIZAR DADOS CADASTRAIS DO CANDIDATO
    case isset($_POST["btnAtualizar"]):
        require_once __DIR__ . "/UsuarioController.php";
        $uController = new UsuarioController();
        $sucesso = $uController->atualizar($_POST["txtID"], $_POST["txtNome"], $_POST["txtCPF"], $_POST["txtEmail"], date("Y-m-d", strtotime($_POST["txtData"])));
        if ($sucesso) { 
            include_once __DIR__ . "/../View/atualizacaoRealizada.php"; 
        } else { 
            include_once __DIR__ . "/../View/operacaoNaoRealizada.php"; 
        }
        break;

    // 6. ADICIONAR FORMAÇÃO ACADÊMICA
    case isset($_POST["btnAddFormacao"]):
        require_once __DIR__ . "/FormacaoAcadController.php";
        include_once __DIR__ . "/../Model/Usuario.php";
        $fController = new FormacaoAcadController();
        $sucesso = $fController->inserir(date("Y-m-d", strtotime($_POST["txtInicioFA"])), date("Y-m-d", strtotime($_POST["txtFimFA"])), $_POST["txtDescFA"], unserialize($_SESSION["Usuario"])->getID());
        if ($sucesso) { 
            include_once __DIR__ . "/../View/informacaoInserida.php"; 
        } else { 
            include_once __DIR__ . "/../View/operacaoNaoRealizada.php"; 
        }
        break;

    // 7. EXCLUIR FORMAÇÃO ACADÊMICA
    case isset($_POST["btnExcluirFA"]):
        require_once __DIR__ . "/FormacaoAcadController.php";
        include_once __DIR__ . "/../Model/Usuario.php";
        $fController = new FormacaoAcadController();
        if ($fController->remover($_POST["id"])) { 
            include_once __DIR__ . "/../View/informacaoExcluida.php"; 
        } else { 
            include_once __DIR__ . "/../View/operacaoNaoRealizada.php"; 
        }
        break;

    // 8. ADICIONAR EXPERIÊNCIA PROFISSIONAL
    case isset($_POST["btnAddEP"]):
        require_once __DIR__ . "/ExperienciaProfissionalController.php";
        include_once __DIR__ . "/../Model/Usuario.php";
        $epController = new ExperienciaProfissionalController();
        $sucesso = $epController->inserir(date("Y-m-d", strtotime($_POST["txtInicioEP"])), date("Y-m-d", strtotime($_POST["txtFimEP"])), $_POST["txtEmpEP"], $_POST["txtDescEP"], unserialize($_SESSION["Usuario"])->getID());
        if ($sucesso) { 
            include_once __DIR__ . "/../View/informacaoInserida.php"; 
        } else { 
            include_once __DIR__ . "/../View/operacaoNaoRealizada.php"; 
        }
        break;

    // 9. EXCLUIR EXPERIÊNCIA PROFISSIONAL
    case isset($_POST["btnExcluirEP"]):
        require_once __DIR__ . "/ExperienciaProfissionalController.php";
        include_once __DIR__ . "/../Model/Usuario.php";
        $epController = new ExperienciaProfissionalController();
        if ($epController->remover($_POST["idEP"])) { 
            include_once __DIR__ . "/../View/informacaoExcluida.php"; 
        } else { 
            include_once __DIR__ . "/../View/operacaoNaoRealizada.php"; 
        }
        break;

    // 10. REDIRECIONAR PARA A TELA DE LOGIN DO ADMINISTRADOR
    case isset($_POST["btnADM"]):
        include_once __DIR__ . "/../View/ADMLogin.php";
        break;

    // 11. PROCESSAR AUTENTICAÇÃO DO ADMINISTRADOR
    case isset($_POST["btnLoginADM"]):
        require_once __DIR__ . "/AdministradorController.php";
        $aController = new AdministradorController();
        
        if ($aController->login($_POST['txtLoginADM'], $_POST['txtSenhaADM'])) { 
            // CORREÇÃO: Usando __DIR__ para garantir que o painel seja encontrado
            include_once __DIR__ . "/../View/ADMPrincipal.php"; 
        } else { 
            include_once __DIR__ . "/../View/cadastroNaoRealizado.php"; 
        }
        break;

    // 12. EXIBIR LISTA DE CANDIDATOS CADASTRADOS
    case isset($_POST["btnListarCadastrados"]):
        include_once __DIR__ . "/../View/ADMListarCadastrados.php";
        break;

    // 13. EXIBIR LISTA DE ADMINISTRADORES CADASTRADOS (DESAFIO)
    case isset($_POST["btnListarAdmins"]):
        include_once __DIR__ . "/../View/ADMListarAdministradores.php";
        break;

    // 14. BOTÃO VOLTAR DO PAINEL DO ADMINISTRADOR
    case isset($_POST["btnVoltar"]):
        include_once __DIR__ . "/../View/ADMPrincipal.php";
        break;
}
?>