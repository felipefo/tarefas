<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/api/rotas/IRouter.php";

/**
 * @author felipe
 */
class Router implements IRouter {

    public $class; //aberta a extensão e fechada a modificação        

    public function Router($class) {
        $this->class = $class;
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

    public function get() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->class->get();
            return true;
        }
        return false;
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
            $this->class->post();
            return true;
        }
        return false;
    }

    public function put() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $this->class->put();
            return true;
        }
        return false;
    }

}
