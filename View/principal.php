<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Enlatados Juarez</title>
    <style>
        /* Ajuste do tamanho da barra lateral */
        .w3-sidebar {
            width: 120px;
        }
        /* Aplicação da fonte padrão */
        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Montserrat", sans-serif;
        }
        /* Margem necessária para o conteúdo não sumir atrás da barra lateral */
        #main-container {
            margin-left: 120px;
        }
    </style>
</head>
<body class="w3-light-grey">

<?php
include_once '../Model/Usuario.php';
include_once '../Controller/FormacaoAcadController.php'; 
include_once '../Controller/ExperienciaProfissionalController.php'; 

if(!isset($_SESSION)) {
    session_start();
}

// Trava de segurança opcional: impede erro caso acesse o link sem fazer login
if (!isset($_SESSION['Usuario'])) {
    header("Location: login.php");
    exit();
}

$usuarioLogado = unserialize($_SESSION['Usuario']);
?>

    <nav class="w3-sidebar w3-bar-block w3-center w3-blue">
        <a href="#home" class="w3-bar-item w3-button w3-block w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-home w3-xxlarge"></i>
            <p>HOME</p>
        </a>
        <a href="#dPessoais" class="w3-bar-item w3-button w3-block w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-address-book-o w3-xxlarge"></i>
            <p>Dados Pessoais</p>
        </a>
        <a href="#formacao" class="w3-bar-item w3-button w3-block w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-mortar-board w3-xxlarge"></i>
            <p>Formação</p>
        </a>
        <a href="#eProfissional" class="w3-bar-item w3-button w3-block w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-briefcase w3-xxlarge"></i>
            <p>Experiência Profissional</p>
        </a>
        <a href="#outrasFormacoes" class="w3-bar-item w3-button w3-block w3-hover-light-grey w3-hover-text-cyan w3-text-light-grey">
            <i class="fa fa-graduation-cap w3-xxlarge"></i>
            <p>Outras Formações</p>
        </a>
    </nav>

    <div class="w3-padding-large" id="main-container">

        <header class="w3-container w3-padding-32 w3-center" id="home">
            <h1>
                <img src="../Img/Enlatados.png" alt="Logo" class="w3-image" width="50%">
            </h1>
            <a class="w3-text-cyan" href="http://www.freepik.com" target="_blank">Designed by brgfx / Freepik</a>
            <br>
            <h1 class="w3-text-cyan">SISTEMA DE CURRICULOS</h1>
        </header>

        <hr class="w3-opacity">

        <div class="w3-padding-64 w3-content w3-text-grey" id="dPessoais">
            <h2 class="w3-text-cyan">Dados Pessoais</h2>
            
            <form action="Controller/Navegacao.php" method="post" class="w3-row w3-light-grey w3-text-blue w3-margin" style="width:100%;">
                <input class="w3-input w3-border w3-round-large" name="txtID" type="hidden" value="<?php echo $usuarioLogado->getID();?>">
                
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:11%;"><i class="w3-xxlarge fa fa-user"></i></div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtNome" type="text" placeholder="Nome Completo" value="<?php echo $usuarioLogado->getNome();?>">
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:11%;"><i class="w3-xxlarge fa fa-calendar"></i></div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtData" type="date" value="<?php echo $usuarioLogado->getDataNascimento();?>">
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:11%;"><i class="w3-xxlarge fa fa-drivers-license"></i></div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtCPF" type="text" placeholder="CPF: 99999999999" value="<?php echo $usuarioLogado->getCPF();?>">
                    </div>
                </div>

                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:11%;"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtEmail" type="text" placeholder="Email" value="<?php echo $usuarioLogado->getEmail();?>">
                    </div>
                </div>
                
                <div class="w3-row w3-section">
                    <button name="btnAtualizar" class="w3-button w3-block w3-blue w3-round-large">Atualizar Dados</button>
                </div>
            </form>
        </div>

        <hr class="w3-opacity">

        <div class="w3-padding-64 w3-content w3-text-grey" id="formacao">
            <h2 class="w3-text-cyan">Formação</h2>
            
            <form action="Controller/Navegacao.php" method="post" class="w3-row w3-light-grey w3-text-blue w3-margin" style="width:100%;">
                <div class="w3-row w3-center w3-margin-bottom">
                    <div class="w3-col" style="width:50%; font-weight: bold;">Data Inicial</div>
                    <div class="w3-rest" style="font-weight: bold;">Data Final</div>
                </div>
                
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:45%;">
                        <div class="w3-col" style="width:15%;"><i class="w3-xxlarge fa fa-calendar"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtInicioFA" type="date">
                        </div>
                    </div>
                    
                    <div class="w3-col" style="width: 10%; min-height: 1px;"></div>
                    
                    <div class="w3-col w3-section" style="width:45%;">
                        <div class="w3-col" style="width:15%;"><i class="w3-xxlarge fa fa-calendar"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtFimFA" type="date">
                        </div>
                    </div>
                </div>
                
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:7%;"><i class="w3-xxlarge fa fa-align-justify"></i></div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtDescFA" type="text" placeholder="Descrição: Ex.: Técnico em Desenvolvimento de Sistemas - Centro Paula Souza">
                    </div>
                </div>
                
                <div class="w3-row w3-section w3-center">
                    <button name="btnAddFormacao" class="w3-button w3-blue w3-round-large" style="width: 20%;">
                        <i class="w3-xxlarge fa fa-user-plus"></i>
                    </button>
                </div>
            </form>

            <div class="w3-container w3-margin-top">
                <table class="w3-table-all w3-centered w3-card-2">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fCon = new FormacaoAcadController();
                        $results = $fCon->gerarLista($usuarioLogado->getID());
                        if($results != null) {
                            while($row = $results->fetch_object()) {
                                echo '<tr>';
                                echo '<td style="width: 10%;">'.date("d/m/Y", strtotime($row->inicio)).'</td>';
                                echo '<td style="width: 10%;">'.date("d/m/Y", strtotime($row->fim)).'</td>';
                                echo '<td style="width: 65%;" class="w3-left-align">'.$row->descricao.'</td>';
                                echo '<td style="width: 5%;">';
                                echo '  <form action="/Controller/Navegacao.php" method="post">';
                                echo '      <input type="hidden" name="id" value="'.$row->idformacaoAcademica.'">';
                                echo '      <button name="btnExcluirFA" class="w3-button w3-block w3-red w3-round w3-small"><i class="fa fa-trash"></i></button>';
                                echo '  </form>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <hr class="w3-opacity">

        <div class="w3-padding-64 w3-content w3-text-grey" id="eProfissional">
            <h2 class="w3-text-cyan">Experiência Profissional</h2>
            
            <form action="Controller/Navegacao.php" method="post" class="w3-row w3-light-grey w3-text-blue w3-margin" style="width: 100%;">
                <div class="w3-row w3-center w3-margin-bottom">
                    <div class="w3-col" style="width:45%; font-weight: bold;">Data Inicial</div>
                    <div class="w3-col" style="width:10%; min-height: 1px;"></div>
                    <div class="w3-col" style="width:45%; font-weight: bold;">Data Final</div>
                </div>
                
                <div class="w3-row w3-section">
                    <div class="w3-col w3-section" style="width:45%;">
                        <div class="w3-col" style="width:15%;"><i class="w3-xxlarge fa fa-calendar"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtInicioEP" type="date">
                        </div>
                    </div>
                    <div class="w3-col" style="width:10%; min-height: 1px;"></div>
                    <div class="w3-col w3-section" style="width:45%;">
                        <div class="w3-col" style="width:13%;"><i class="w3-xxlarge fa fa-calendar"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtFimEP" type="date">
                        </div>
                    </div>
                </div>
                
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:7%;"><i class="w3-xxlarge fa fa-building-o"></i></div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtEmpEP" type="text" placeholder="Centro Paula Souza">
                    </div>
                </div>
                
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:7%;"><i class="w3-xxlarge fa fa-align-justify"></i></div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtDescEP" type="text" placeholder="Descrição: Ex.: Técnico em Desenvolvimento de Sistemas - Desenvolvimento de Páginas WEB">
                    </div>
                </div>
                
                <div class="w3-row w3-section w3-center">
                    <button name="btnAddEP" class="w3-button w3-blue w3-round-large" style="width: 20%;">
                        <i class="w3-xxlarge fa fa-user-plus"></i>
                    </button>
                </div>
            </form>
            
            <div class="w3-container w3-margin-top">
                <table class="w3-table-all w3-centered w3-card-2">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Empresa</th>
                            <th>Descrição</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ePro = new ExperienciaProfissionalController();
                        $resultsEP = $ePro->gerarLista($usuarioLogado->getID());
                        if($resultsEP != null) {
                            while($rowEP = $resultsEP->fetch_object()) {
                                echo '<tr>';
                                echo '<td style="width: 10%;">'.date("d/m/Y", strtotime($rowEP->inicio)).'</td>';
                                echo '<td style="width: 10%;">'.date("d/m/Y", strtotime($rowEP->fim)).'</td>';
                                echo '<td style="width: 15%;">'.$rowEP->empresa.'</td>';
                                echo '<td style="width: 60%;" class="w3-left-align">'.$rowEP->descricao.'</td>';
                                echo '<td style="width: 5%;">';
                                echo '  <form action="/Controller/Navegacao.php" method="post">';
                                echo '      <input type="hidden" name="idEP" value="'.$rowEP->idexperienciaprofissional.'">';
                                echo '      <button name="btnExcluirEP" class="w3-button w3-block w3-red w3-round w3-small"><i class="fa fa-trash"></i></button>';
                                echo '  </form>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <hr class="w3-opacity">

        <div class="w3-padding-64 w3-content w3-text-grey" id="outrasFormacoes">
            <h2 class="w3-text-cyan">Outras Formações</h2>
            
            <form action="Controller/Navegacao.php" method="post" class="w3-row w3-light-grey w3-text-blue w3-margin" style="width: 100%;">
                <div class="w3-row w3-center w3-margin-bottom">
                    <div class="w3-col" style="width:45%; font-weight: bold;">Data Inicial</div>
                    <div class="w3-col" style="width:10%; min-height: 1px;"></div>
                    <div class="w3-col" style="width:45%; font-weight: bold;">Data Final</div>
                </div>
                
                <div class="w3-row w3-section">
                    <div class="w3-col w3-section" style="width:45%;">
                        <div class="w3-col" style="width:15%;"><i class="w3-xxlarge fa fa-calendar"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtInicioOF" type="date">
                        </div>
                    </div>
                    <div class="w3-col" style="width:10%; min-height: 1px;"></div>
                    <div class="w3-col w3-section" style="width:45%;">
                        <div class="w3-col" style="width:13%;"><i class="w3-xxlarge fa fa-calendar"></i></div>
                        <div class="w3-rest">
                            <input class="w3-input w3-border w3-round-large" name="txtFimOF" type="date">
                        </div>
                    </div>
                </div>
                
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:7%;"><i class="w3-xxlarge fa fa-align-justify"></i></div>
                    <div class="w3-rest">
                        <input class="w3-input w3-border w3-round-large" name="txtDescOF" type="text" placeholder="Ex: Curso de Inglês - Inglês City">
                    </div>
                </div>
                
                <div class="w3-row w3-section w3-center">
                    <button name="btnAddOF" class="w3-button w3-blue w3-round-large" style="width: 20%;">
                        <i class="w3-xxlarge fa fa-user-plus"></i>
                    </button>
                </div>
            </form>
            
            <div class="w3-container w3-margin-top">
                <table class="w3-table-all w3-centered w3-card-2">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>--/--/----</td>
                            <td>--/--/----</td>
                            <td class="w3-left-align">Exemplo: Curso Extensão de PHP Avançado</td>
                            <td>
                                <button class="w3-button w3-red w3-round w3-small"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div> </body>
</html>