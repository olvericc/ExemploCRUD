<?php
    require_once 'db.php';

    class Funcionario{
        private $conn;

        public function __construct(){
            $database = new Database();
            $db = $database->dbConnection();
            $this-> conn = $db;
        }

        public function runQuery($sql){
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }

        public function insert($nome, $cpf){  //adicionar registro do funcionario
            try
            {
                $sql = "INSERT INT funcionario(nome, cpf, telefone, sexo) VALUES (:nome, :cpf, :telefone, :sexo)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":nome", $nome);
                $stmt->bindparam(":cpf", $cpf);
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e){
                echo("Error".$e->getMessage());
            }
            finally
            {
                $this->conn = null;
            }
        }
        public function update($nome, $cpf, $id){    //atualizar registro do funcionario
            try
            {
                $sql = "UPDATE funcionario SET nome = :nome, cpf = :cpf, :telefone = telefone, sexo = :sexo,  WHERE id = :id"; 
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":nome", $nome);
                $stmt->bindparam(":cpf", $cpf);
                $stmt->bindparam("id", $id);
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e)
            {
                echo("Error".$e->getMessage());    
            }
            finally
            {
                $this->conn = null;
            }  
        }
        public function delete($id){
            try{
                $sql = "DELETE FROM funcionario WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":id",$id0);
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e)
            {
                echo("Error".$e->getMessage());
            }
            finally
            {
                $this->conn = null;
            }
        }
        public function redirect($url)  {
            header("Location: ".$url);
        }
    }
?>