<?php
/**
 * Description of Usuario
 * @author felipe
 */
class Usuario {
 
    protected $id;
    protected $login;
    protected $senha;
    public  $role;
    
    public function get_id() {
        return $this->id;
    }
    
    public function get_role() {
        return $this->role;
    }

    public function get_login() {
        return $this->login;
    }

    public function get_senha() {
        return $this->senha;
    }

    public function set_id($id) {
        $this->id = $id;
        return $this;
    }

    public function set_login($login) {
        $this->login = $login;
        return $this;
    }

    public function set_senha($senha) {
        $this->senha = $senha;
        return $this;
    }
    
    public function set_role($role) {
        $this->role = $role;
        return $this;
    }


}
