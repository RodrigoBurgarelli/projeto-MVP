<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Administração - Detalhes do Candidato</title>
</head>
<body class="w3-light-grey">

<?php
include_once '../Model/Usuario.php';
include_once '../Controller/FormacaoAcadController.php';
include_once '../Controller/ExperienciaProfissionalController.php';

if(!isset($_SESSION)) { session_start(); }
if(!isset($_SESSION['Administrador'])) { header("Location: login.php"); exit(); }

// Recupera o usuário que foi guardado na sessão pelo controlador
$userGrid = unserialize($_SESSION['UsuarioInspecionado']);
$idCandidato = $userGrid->getID();
?>

    <header class="w3-container w3-padding-16 w3-center">
        <h1 class="w3-text-white w3-panel w3-cyan w3-round-large"> Currículo de: <?php echo $userGrid->getNome(); ?> </h1>
    </header>

    <div class="w3-container w3-content" style="max-width: 900px; margin-bottom: 50px;">
        
        <div class="w3-container w3-card-4 w3-white w3-margin-bottom w3-round-large">
            <h3 class="w3-text-blue"><i class="fa fa-user"></i> Dados Pessoais</h3>
            <div class="w3-row-padding w3-margin-bottom">
                <div class="w3-third">
                    <label>ID do Usuário</label>
                    <input class="w3-input w3-border w3-light-grey w3-round" type="text" value="<?php echo $idCandidato; ?>" disabled>
                </div>
                <div class="w3-third">
                    <label>CPF</label>
                    <input class="w3-input w3-border w3-light-grey w3-round" type="text" value="<?php echo $userGrid->getCPF(); ?>" disabled>
                </div>
                <div class="w3-third">
                    <label>Data de Nascimento</label>
                    <input class="w3-input w3-border w3-light-grey w3-round" type="text" value="<?php echo date('d/m/Y', strtotime($userGrid->getDataNascimento())); ?>" disabled>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-bottom">
                <div class="w3-half">
                    <label>Nome Completo</label>
                    <input class="w3-input w3-border w3-light-grey w3-round" type="text" value="<?php echo $userGrid->getNome(); ?>" disabled>
                </div>
                <div class="w3-half">
                    <label>E-mail registrado</label>
                    <input class="w3-input w3-border w3-light-grey w3-round" type="text" value="<?php echo $userGrid->getEmail(); ?>" disabled>
                </div>
            </div>
        </div>

        <div class="w3-container w3-card-4 w3-white w3-margin-bottom w3-round-large w3-padding-16">
            <h3 class="w3-text-blue"><i class="fa fa-graduation-cap"></i> Formação Acadêmica</h3>
            <table class="w3-table-all w3-centered">
                <thead>
                    <tr class="w3-blue">
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Descrição do Curso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fController = new FormacaoAcadController();
                    $formacoes = $fController->gerarListaPorId($idCandidato);
                    if($formacoes != null) {
                        while($rowF = $formacoes->fetch_object()) {
                            echo '<tr>';
                            echo '<td>'.date('d/m/Y', strtotime($rowF->inicio)).'</td>';
                            echo '<td>'.date('d/m/Y', strtotime($rowF->fim)).'</td>';
                            echo '<td class="w3-left-align">'.$rowF->descricao.'</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="w3-container w3-card-4 w3-white w3-margin-bottom w3-round-large w3-padding-16">
            <h3 class="w3-text-blue"><i class="fa fa-briefcase"></i> Experiência Profissional</h3>
            <table class="w3-table-all w3-centered">
                <thead>
                    <tr class="w3-blue">
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Empresa</th>
                        <th>Descrição das Funções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $epController = new ExperienciaProfissionalController();
                    $experiencias = $epController->gerarListaPorId($idCandidato);
                    if($experiencias != null) {
                        while($rowEP = $experiencias->fetch_object()) {
                            echo '<tr>';
                            echo '<td>'.date('d/m/Y', strtotime($rowEP->inicio)).'</td>';
                            echo '<td>'.date('d/m/Y', strtotime($rowEP->fim)).'</td>';
                            echo '<td>'.$rowEP->empresa.'</td>';
                            echo '<td class="w3-left-align">'.$rowEP->descricao.'</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <form action="Controller/Navegacao.php" method="post" class="w3-center w3-margin-top">
            <button name="btnListarCadastrados" class="w3-button w3-dark-grey w3-round-large" style="width: 40%;"><i class="fa fa-arrow-left"></i> Voltar para Lista </button>
        </form>
        
    </div>
</body>
</html>