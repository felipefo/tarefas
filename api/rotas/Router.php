<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/www/api/rotas/IRouter.php";

/**
 * @author felipe
 */
class Router implements IRouter {

    public $class; //aberta a extensão e fechada a modificação        

    function __construct($class) {
        $this->class = $class;
    }

    public function get() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // var_dump($this->class);
            $this->class->get();
            return true;
        }
        return false;
    }

    public function run() {

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
            $this->class->delete();
            return true;
        }
        return false;
    }

    public function post() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['method']) && $_POST['method'] === 'PUT') {
                $this->class->put();
                http_response_code(200);
            } else {
                $this->class->post();
                http_response_code(201);
                return true;
            }
        }
        return false;
    }

    public function put() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            http_response_code(400);
            throw new Exception("Nao suportado. Usar o post com o hidden field");
            return true;
        }
        return false;
    }

}
