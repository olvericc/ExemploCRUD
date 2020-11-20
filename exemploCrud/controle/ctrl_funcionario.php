<?php
    require_once '../model/funcionario.php';
    $objFuncionario = new Funcionario ();
    //delete
    if(isset($_POST['delete_id'])){
        $id = $_POST['delete_id'];
        if($objFuncionario->delete($id)){
            $objFuncionario->redirect('../view/funcionario.php');
        }
    }
    //insert
    if(isset($_POST['insert'])){
        $nome = $_POST['txtNome'];
        $cpf = $_POST['txtCpf'];
        if($objFuncionario->insert($nome, $cpf)){
            $objFuncionario->redirect('../view/funcionario.php');
        }
    }
    //update
    if(isset($_POST['editar_id'])){
        $nome = $_POST['txtNome'];
        $cpf = $_POST['txtCpf'];
        $id = $_POST['editar_id'];
        if($objFuncionario->update($nome, $cpf, $id)){
            $objFuncionario->redirect('../view/funcionario.php');
        }
    }  
?>