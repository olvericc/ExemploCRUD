<?php
    require_once '../model/funcionario.php';
    $objFuncionario = new Funcionario();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
        <title>Funcionário</title>
    </head>
    <body>
        <!-- Tabela com Dados -->
        <div class="container">
        <h2>Funcionário</h2>
        <table class="table table-bordered">
            <p>
                <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModalCadastrar">
                    <span class="glyphicon glyphicon-user"></span> Cadastrar Funcionário
                </button>
            </p>
            <!-- Tipos de dados -->
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr> 
            </thead>
            <!-- Tabela -->
            <tbody>
        
                <?php
                    $query = "select * from funcionario";
                    $stmt = $objFuncionario->runQuery($query);
                    $stmt->execute();
                    if($stmt->rowCount() > 0){
                        while($rowFuncionario = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                ?>
                        <tr>
                            <!-- BLOCO NOME -->
                            <td>
                                <?php echo($rowFuncionario['nome']); ?>
                            </td>
                            <!-- BLOCO CPF -->
                            <td>
                                <?php echo($rowFuncionario['cpf']) ?>
                            </td>
                            <!-- BLOCO EDITAR -->
                            <td>
                                <p>
                                    <a href="#">
                                        <span class="glyphicon glyphicon-pencil"
                                            data-toggle="modal" data-target="#myModalEditar"
                                            data-funcionarioid="<?php echo $rowFuncionario['id'] ?>"
                                            data-funcionarionome="<?php echo $rowFuncionario['nome'] ?>"
                                            data-funcionariocpf="<?php echo $rowFuncionario['cpf'] ?>">
                                        </span>
                                    </a>
                                </p>
                            </td>
                            <!-- BLOCO DELETAR -->
                            <<td>
                            <p>
                            <a href="#">
                                    <span class="glyphicon glyphicon-trash"
                                        data-toggle="modal" data-target="#myModalDeletar"
                                        data-funcionarioid="<?php echo $rowFuncionario['id'] ?>" 
                                        data-funcionarionome="<?php echo $rowFuncionario['nome'] ?>">      
                                    </span>
                                </a> 
                            </p>
                            </td>
                        </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
        </div>

        <!-- Modal Cadastrar Funcionário -->

        <div class="modal fade" id="myModalCadastrar" role="dialog">           
        <div class="modal-dialog">

        <!-- Modal -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cadastrar Funcionário</h4>
            </div>
            
            <div class="modal-body">
            <form action="../controle/ctrl_funcionario.php" method="POST">
            <input type="hidden" name="insert" value="1">
                <!-- NOME -->
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="txtNome">
                </div>
                <!-- CPF -->
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="number" class="form-control" id="cpf" name="txtCpf">
                </div>
                <button type="submit" class="btn btn-success">Enviar</button>
            </form>
        </div>
        </div>
        </div>

        <!-- Modal Deletar Funcionário -->

        <div class="modal fade" id="myModalDeletar" role="dialog">
        <div class="modal-dialog">

        <!-- Modal -->
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Deletar Funcionário</h4>
        </div>

        <div class="modal-body">
            <form action="../controle/ctrl_funcionario.php" method="POST">
            <input type="hidden" name="delete_id" value="" id="recipient-id">
                <!-- NOME -->    
                <div class="form-group">    
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="recipient-nome" name="txtNome" readonly>
                </div>
                <button type="submit" class="btn btn-danger">Deletar</button>
            </form>
        </div>
        </div>
        </div>
        </div>

        <!-- Modal Editar Cliente-->
    
    <div class="modal fade" id="myModalEditar" role="dialog">
    <div class="modal-dialog">
    
    <!-- Modal -->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Funcionário</h4>
        </div>  <!-- modal-header -->

        <div class="modal-body">
            <form action="../controle/ctrl_funcionario.php" method="POST">
            <input type="hidden" name="editar_id" value="" id="recipient-id">
                <div class="form-group">    
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="recipient-nome" name="txtNome">
                </div>
                <div class="form-group">
                    <label for="idade">CPF:</label>
                    <input type="number" class="form-control" id="recipient-cpf" name="txtCpf">
                </div>
                <button type="submit" class="btn btn-warning">Editar</button>
            </form>
        </div>
      </div>
    </div>  <!-- modal content -->
    </div>
    </body> 
</html>