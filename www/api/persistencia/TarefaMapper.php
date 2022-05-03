<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/www/api/model/Tarefa.php";
/**
 * Description of TarefaMapper
 * @author felipe
 */
class TarefaMapper {
    
    public $dbuser = "root";
    public $dbpass = "";
    public $pdo;
    function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=listatarefas", $this->dbuser, $this->dbpass);
    }
    public function salvar(Tarefa $tarefa) {
        $sql = "INSERT INTO tarefas (descricao, data_criacao, categoria, status) VALUES ('"
                . $tarefa->get_descricao()
                . "','" . $tarefa->get_dataCriacao()
                . "','" . $tarefa->get_categoria()
                . "','" . $tarefa->get_status() . "')";
        if ($this->pd->query($sql) == TRUE) {
            echo "Criado com sucesso";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            throw new Exception("Erro ao criar tarefa" . $conn->error);
        }
    }
    public function buscar() {
        $sql = "select * from tarefas";
        $statement = $this->pd->prepare($sql );
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return  $json;
    }
}
