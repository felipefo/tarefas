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
        $this->pdo = new PDO("mysql:host=localhost;dbname=tarefas", $this->dbuser, $this->dbpass);
    }
    public function salvar(Tarefa $tarefa) {
        $sql = "INSERT INTO tarefa (descricao, data_fim, status) VALUES ('"
                . $tarefa->get_descricao()
                . "','" . date("Y-m-d", strtotime($tarefa->get_data_fim())) . "'"
                . ",1);";
        if ($error = $this->pdo->query($sql) == TRUE) {
            echo "Criado com sucesso";
        } else {
            echo "Error: " . $sql . "<br>" . $error;
            throw new Exception("Erro ao criar tarefa" . $error);
        }
    }
    public function buscar() {
        $sql = "select * from tarefa";
        $statement = $this->pdo->prepare($sql );
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return  $results;
    }
}
