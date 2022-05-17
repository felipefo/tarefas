<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/api/model/Tarefa.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/persistencia/TarefaMapper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/rotas/IRouter.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/api/rotas/Router.php";

//padrao de projetos strategy   
class Tarefas implements IRouter {

    public $role_validacao = [
        "get" => ['cliente','admin'],
        "delete" => ['admin'],
        "post" => ["cliente", 'admin'],
        "put" => ["cliente", 'admin'],
    ];
    
    public function delete() {
        if (isset($_REQUEST['id'])) {
            $tarefaMapper = new TarefaMapper();
            $tarefaMapper->remover($_REQUEST['id']);
        } else {
            http_response_code(400);
            throw new Exception("Faltando o identificador da tarefa");
        }
    }

    public function get() {
        if(isset($_SESSION["user_id"])){
            $tarefaMapper = new TarefaMapper();
            $resposta = $tarefaMapper->buscar($_SESSION["user_id"]);
            echo json_encode($resposta);
        }
        else echo '[]';
    }

    public function post() {
        $tarefa = new Tarefa();
        if (isset($_POST['descricao'])) {
            $tarefa->set_descricao($_POST['descricao']);
        }if (isset($_POST['datafim'])) {
            $tarefa->set_data_fim($_POST['datafim']);
        }if (isset($_POST['status'])) {
            $tarefa->set_status($_POST['status']);
        }
        $tarefaMapper = new TarefaMapper();
        $resposta = $tarefaMapper->salvar($tarefa);
        http_response_code(201);
        echo $resposta;
    }

    public function put() {
        $tarefa = new Tarefa();
        if (isset($_POST['descricao'])) {
            $tarefa->set_descricao($_POST['descricao']);
        }if (isset($_POST['datafim'])) {
            $tarefa->set_data_fim($_POST['datafim']);
        }if (isset($_POST['status'])) {
            $tarefa->set_status($_POST['status']);
        }if (isset($_REQUEST['id'])) {
            $tarefa->set_id($_REQUEST['id']);
        }
        $tarefaMapper = new TarefaMapper();
        $resposta = $tarefaMapper->atualizar($tarefa);
        echo $resposta;
    }

}

header("Access-Control-Allow-Origin: *");
$api = new Tarefas();
$router = new Router($api);
$router->run();
