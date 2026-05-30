<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Usuários Cadastrados</title>
</head>
<body class="w3-light-grey">

<?php
include_once '../Model/Usuario.php';
include_once '../Controller/UsuarioController.php';
if(!isset($_SESSION)) { session_start(); }
if(!isset($_SESSION['Administrador'])) { header("Location: login.php"); exit(); }
?>

    <header class="w3-container w3-padding-32 w3-center">
        <h1 class="w3-text-white w3-panel w3-cyan w3-round-large"> Lista de Usuários Cadastrados no Sistema</h1>
    </header>

    <div class="w3-container w3-content" style="max-width: 800px;">
        <table class="w3-table-all w3-centered w3-card-4">
            <thead>
                <tr class="w3-center w3-blue">
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Visualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $usuario = new UsuarioController();
                $results = $usuario->gerarLista(); 
                if($results != null) {
                    while($row = $results->fetch_object()) {
                        echo '<tr>';
                        echo '<td style="width: 15%; vertical-align: middle;">'.$row->idusuario.'</td>';
                        echo '<td style="width: 60%; vertical-align: middle;" class="w3-left-align">'.$row->nome.'</td>';
                        echo '<td style="width: 25%; vertical-align: middle;">';
                        echo '<form action="Controller/Navegacao.php" method="post">';
                        echo '<input type="hidden" name="idUsuarioSelecao" value="'.$row->idusuario.'">';
                        echo '<button name="btnVisualizarUsuario" class="w3-button w3-orange w3-round-large w3-small"><i class="fa fa-eye"></i> Visualizar</button>';
                        echo '</form>';
                        echo '</td>';
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