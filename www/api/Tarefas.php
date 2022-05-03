<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/www/api/model/Tarefa.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/www/api/persistencia/TarefaMapper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/www/api/rotas/IRouter.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/www/api/rotas/Router.php";

//padrao de projetos strategy   
class Tarefas implements IRouter {

    public function delete() {
        http_response_code(404);
        throw new Exception("Não implementado ainda");
    }

    public function get() {

       // $tarefaMapper = new TarefaMapper();
       // $resposta = $tarefaMapper->buscar();
       // 
       //mock para teste o desenvolvimento
       $resposta = array();
       $task1 = array();
       $task1["id"] = 1;
       $task1["descricao"] = "Fazer os exercicios de dev web";
       $task1["data_criacao"] = "10-10-2021";
       $task1["status"] = "A fazer";
       $task1["categoria"] = "Escola";
       
       $task2 = array();
       $task2["id"] = 2;
       $task2["descricao"] = "Fazer os exercicios de poo2";
       $task2["data_criacao"] = "11-10-2021";
       $task2["status"] = "A fazer";
       $task2["categoria"] = "Escola";
       
       array_push($resposta ,$task1 , $task2);
      echo json_encode($resposta);

    }

    public function post() {
        $tarefa = new Tarefa();
        if (isset($_POST['descricao'])) {
            $tarefa->set_descricao($_POST['descricao']);
        } else if (isset($_POST['data_criacao'])) {
            $tarefa->set_descricao($_POST['data_criacao']);
        } else if (isset($_POST['status'])) {
            $tarefa->set_descricao($_POST['status']);
        } else {
            throw new Exception("Campo descricao vazio");
        }
        $tarefaMapper = new TarefaMapper();
        $resposta = $tarefaMapper->salvar();
        echo $resposta;
    }

    public function put() {
        http_response_code(404);
        throw new Exception("Não implementado ainda");
    }

}

header("Access-Control-Allow-Origin: *");
$router = new Router(new Tarefas());
$router->run();
