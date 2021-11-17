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

      $tarefaMapper = new TarefaMapper();
      $resposta = $tarefaMapper->buscar();
      echo json_encode($resposta);

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
        echo $resposta;
    }

    public function put() {
        http_response_code(404);
        throw new Exception("Não implementado ainda");
    }

}

header("Access-Control-Allow-Origin: *");
$api= new Tarefas();
$router = new Router($api);
$router->run();
