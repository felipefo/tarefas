<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/www/api/model/Usuario.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/www/api/persistencia/UsuarioMapper.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/www/api/rotas/IRouter.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/www/api/rotas/Router.php";

class Usuarios implements IRouter {

    public function login($usuario) {
        $usuarioMapper = new UsuarioMapper();
        $resposta = $usuarioMapper->autenticacao($usuario);
        if ($resposta) {
            $_SESSION["user_name"] = $resposta['login']; //armazenando informacoes no servidor de forma temporaria 
            $_SESSION["user_id"] = $resposta['id']; //armazenando informacoes no servidor de forma temporaria 
            $_SESSION["role"] = $resposta['role'];   //armazenando informacoes no servidor de forma temporaria
        }
    }

    public function logout() {
        try {
            session_destroy(); //destroy a sessao no servidor.
        } catch (Exception $ex) {
            
        }
    }

    public function info() {
        try {
            var_dump($_SESSION);
        } catch (Exception $ex) {
            
        }
    }

     public $role_validacao = [
        "get" => ['admin'],
        "delete" => ['admin'],
        "post" => ["cliente", 'admin'],
        "put" => ["cliente", 'admin'],
    ];
        
    public function delete() {

        http_response_code(501);
        throw new Exception("Nao implementado ainda");
    }

    public function get() {
        if (str_ends_with($_SERVER['REQUEST_URI'], "info")) {
            $this->info();
        } else {
            $tarefaMapper = new TarefaMapper();
            $tarefaMapper->buscar();
        }
    }

    public function post() {
        if (str_ends_with($_SERVER['REQUEST_URI'], "login")) {
            $usuario = new Usuario();
            if (isset($_POST['login'])) {
                $usuario->set_login($_POST['login']);
            }if (isset($_POST['senha'])) {
                $usuario->set_senha($_POST['senha']);
            }
            $this->login($usuario);
            http_response_code(200);
        } else if (str_ends_with($_SERVER['REQUEST_URI'], "logout")) {
            $this->logout();
        }
    }

    public function put() {
        http_response_code(501);
        throw new Exception("Nao implementado ainda");
    }

}

header("Access-Control-Allow-Origin: *");
$api = new Usuarios();
$router = new Router($api);
$router->run();
