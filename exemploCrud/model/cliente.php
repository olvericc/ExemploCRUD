<?php
    require_once 'db.php';

    class Cliente{
        private $conn;

        public function __construct(){
            $database = new Database(); //banco estanciado 
            $db = $database->dbConnection();
            $this->conn = $db;
        }

        public function runQuery($sql){
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }

        public function insert($nome, $idade, $sexo){   //criar registro do cliente
            try{
                $sql = "INSERT INTO cliente(nome, idade, sexo) VALUES (:nome, :idade, :sexo)"; //():) parametros
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":nome", $nome);   //atribui valor aos paramentros 
                $stmt->bindparam(":idade", $idade);
                $stmt->bindparam(":sexo", $sexo);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error".$e->getMessage());   //mostra o ERRO
            }finally{
                $this->conn = null;
            }   
        }

        public function update($nome, $idade, $sexo, $id){  //atualizar registro do cliente
            try{
                $sql = "UPDATE cliente SET nome = :nome, idade = :idade, sexo = :sexo WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":nome", $nome);
                $stmt->bindparam(":idade", $idade);
                $stmt->bindparam(":sexo", $sexo);
                $stmt->bindparam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error".$e->getMessage());
            }finally{
                $this->conn = null;
            }  
        }

        public function delete($id){    //deletar registro do cliente
            try{
                $sql = "DELETE FROM cliente WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindparam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo("Error".$e->getMessage());
            }finally{
                $this->conn = null;
            }
        }

        public function redirect($url){ //redirecionar
            header("Location: ".$url);  
        }

    }
?>  