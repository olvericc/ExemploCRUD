<?php
    require_once '../model/cliente.php';
    $objCliente = new Cliente();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Cliente</title>
</head>
<body>
<!-- Tabela com Dados -->
<div class="container">
    <h2>Cliente</h2>
        <table class="table table-bordered">
        <p>
            <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModalCadastrar">
                <span class="glyphicon glyphicon-user"></span> Cadastrar Cliente
            </button>
        </p>

    <!-- Tipos de dados -->
        <thead>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>Sexo</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr> 
        </thead>
    
    <!-- Tabela  -->    
            <tbody>
                <?php
                    $query = "select * from cliente";
                    $stmt = $objCliente->runQuery($query);
                    $stmt->execute(); 
                    if($stmt->rowCount() > 0){
                        while($rowCliente = $stmt->fetch(PDO::FETCH_ASSOC)){
                ?>
                        <tr>
                            <!-- BLOCO NOME -->
                            <td> 
                                <?php echo($rowCliente['nome']); ?> 
                            </td>
                            <!-- BLOCO IDADE -->
                            <td>
                                <?php echo($rowCliente['idade']); ?> 
                            </td>
                            <!-- BLOCO SEXO -->
                            <td>
                                <?php echo($rowCliente['sexo']); ?>
                            </td>
                            <!-- BLOCO EDITAR -->
                            <td>
                            <p>
                                <a href="#">
                                    <span class="glyphicon glyphicon-pencil"
                                        data-toggle="modal" data-target="#myModalEditar"
                                            data-clienteid="<?php echo $rowCliente['id'] ?>"   
                                            data-clientenome="<?php echo $rowCliente['nome'] ?>"
                                            data-clienteidade="<?php echo $rowCliente['idade'] ?>"
                                            data-clientesexo="<?php echo $rowCliente['sexo'] ?>">
                                    </span>
                                </a>
                            </p>
                            </td>
                            <!-- BLOCO DELETAR -->
                            <td>
                            <p>
                                <a href="#">
                                    <span class="glyphicon glyphicon-trash"
                                    data-toggle="modal" data-target="#myModalDeletar"
                                        data-clienteid="<?php echo $rowCliente['id'] ?>" 
                                        data-clientenome="<?php echo $rowCliente['nome'] ?>">      
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

<!-- Modal Cadastrar Cliente-->
    
    <div class="modal fade" id="myModalCadastrar" role="dialog">
    <div class="modal-dialog">
    
    <!-- Modal -->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cadastrar Cliente</h4>
        </div>

        <div class="modal-body">
            <form action="../controle/ctrl_cliente.php" method="POST">
            <input type="hidden" name="insert" value="1">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="txtNome">
                </div>
                <div class="form-group">
                    <label for="idade">Idade:</label>
                    <input type="number" class="form-control" id="idade" name="txtIdade">
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <input type="text" class="form-control" id="sexo" name="txtSexo">
                </div>

                <button type="submit" class="btn btn-success">Enviar</button>
            </form>
        </div>
      </div>
    </div>
</div>

<!-- Modal Deletar Cliente-->
    
    <div class="modal fade" id="myModalDeletar" role="dialog">
    <div class="modal-dialog">
    
    <!-- Modal -->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Deletar Cliente</h4>
        </div>

        <div class="modal-body">
            <form action="../controle/ctrl_cliente.php" method="POST">
            <input type="hidden" name="delete_id" value="" id="recipient-id">
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
          <h4 class="modal-title">Editar Cliente</h4>
        </div>  <!-- modal-header -->

        <div class="modal-body">
            <form action="../controle/ctrl_cliente.php" method="POST">
            <input type="hidden" name="editar_id" value="" id="recipient-id">
                <div class="form-group">    
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="recipient-nome" name="txtNome">
                </div>
                <div class="form-group">
                    <label for="idade">Idade:</label>
                    <input type="number" class="form-control" id="recipient-idade" name="txtIdade">
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <input type="text" class="form-control" id="recipient-sexo" name="txtSexo">
                </div>
                <button type="submit" class="btn btn-warning">Editar</button>
            </form>
        </div>
      </div>
    </div>  <!-- modal content -->
</div>

<!-- Script do Deletar Cliente -->

<script>
    $('#myModalDeletar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipientid = button.data('clienteid');
        var recipientnome = button.data('clientenome');


        var modal = $(this)
        modal.find('.modal-title').text('Tem certeza que deseja deletar o cliente '+recipientnome);
        modal.find('#recipient-id').val(recipientid);
        modal.find('#recipient-nome').val(recipientnome);
    })      
</script>

<!-- Script do Editar Cliente -->

<script>
    $('#myModalEditar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipientid = button.data('clienteid');
        var recipientnome = button.data('clientenome');
        var recipientidade = button.data('clienteidade');
        var recipientsexo = button.data('clientesexo');


        var modal = $(this)
        modal.find('.modal-title').text('Editar cliente');
        modal.find('#recipient-id').val(recipientid);
        modal.find('#recipient-nome').val(recipientnome);
        modal.find('#recipient-idade').val(recipientidade);
        modal.find('#recipient-sexo').val(recipientsexo);   
    })      
</script>

</body>
</html>