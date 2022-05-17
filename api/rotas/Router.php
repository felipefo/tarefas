<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/api/rotas/IRouter.php";

/**
 * @author felipe
 */
class Router implements IRouter {

    public $class; //aberta a extensão e fechada a modificação        

    function __construct($class) {
        $this->class = $class;
    }

    public function checkPermission($verbo) {
        if (isset($_SESSION["role"])) {
            $role = $_SESSION["role"];
            $roles = $this->class->role_validacao[$verbo];
            if (!in_array($role, $roles)) {
                http_response_code(403);
                throw new Exception("Sem premissao para acessar esse recurso");
            }
        } else {
            http_response_code(403);
            throw new Exception("Voce não esta logado");
        }
    }

    public function get() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            #$this->checkPermission('get');
            $this->class->get();
            return true;
        }
        return false;
    }

    public function run() {
        session_start(); //inicia a criacao da sesao no servidor. 
        //Esta sessao pertence somente a este servidor.
        try {
            if ($this->get()) {
                return;
            } else if ($this->post()) {
                return;
            } else if ($this->delete()) {
                return;
            } else if ($this->put()) {
                return;
            }
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
            http_response_code(400);
        } catch (Exception $e) {
            echo $e->getMessage();
            http_response_code(400);
        }
    }

    //https://restfulapi.net/http-methods/#delete
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            #$this->checkPermission('delete');
            $this->class->delete();
            return true;
        }
        return false;
    }

    public function post() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['method']) && $_POST['method'] === 'PUT') {
                #$this->checkPermission('post');
                $this->class->put();
                http_response_code(200);
            } else {
               
 			    $this->class->post();
                return true;
            }
        }
        return false;
    }

    public function put() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            #$this->checkPermission('put');
            http_response_code(400);
            throw new Exception("Nao suportado. Usar o post com o hidden field");
            return true;
        }
        return false;
    }

}
