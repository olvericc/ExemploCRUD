<?php
    require_once '../model/cliente.php';
    $objCliente = new Cliente ();

    if(isset($_POST['delete_id'])){  //delete
        $id = $_POST['delete_id'];
        if($objCliente->delete($id)){
            $objCliente->redirect('../view/cliente.php');
        }
    }
    
    if(isset($_POST['insert'])){    //insert
        $nome = $_POST['txtNome'];
        $idade = $_POST['txtIdade'];
        $sexo = $_POST['txtSexo'];
        if($objCliente->insert($nome, $idade, $sexo)){
            $objCliente->redirect('../view/cliente.php');
        }

    }

    if(isset($_POST['editar_id'])){     //update    
        $id = $_POST['editar_id'];
        $nome = $_POST['txtNome'];
        $idade = $_POST['txtIdade'];
        $sexo = $_POST['txtSexo'];
        if($objCliente->update($nome, $idade, $sexo, $id)){
            $objCliente->redirect('../view/cliente.php');
        }
    }
?>