<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Administradores Cadastrados</title>
</head>
<body class="w3-light-grey">

<?php
include_once '../Model/Administrador.php';
include_once '../Controller/AdministradorController.php';
if(!isset($_SESSION)) { session_start(); }
?>

    <header class="w3-container w3-padding-32 w3-center">
        <h1 class="w3-text-white w3-panel w3-cyan w3-round-large"> Lista de Administradores Cadastrados no Sistema </h1>
    </header>

    <div class="w3-container w3-content" style="max-width: 700px;">
        <table class="w3-table-all w3-centered w3-card-4">
            <thead>
                <tr class="w3-center w3-blue">
                    <th>Código</th>
                    <th>Nome</th>
                    <th>CPF</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $adm = new AdministradorController();
                $results = $adm->gerarLista();
                if($results != null) {
                    while($row = $results->fetch_object()) {
                        echo '<tr>';
                        echo '<td style="width: 15%;">'.$row->idadministrador.'</td>';
                        echo '<td style="width: 50%;" class="w3-left-align">'.$row->nome.'</td>';
                        echo '<td style="width: 35%;">'.$row->cpf.'</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>

        <form action="Controller/Navegacao.php" method="post" class="w3-center w3-margin-top">
            <button name="btnVoltar" class="w3-button w3-blue w3-round-large w3-margin" style="width: 40%;"> Voltar </button>
        </form>
    </div>
</body>
</html>