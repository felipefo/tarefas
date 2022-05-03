<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/www/api/model/Validacoes.php";

/**
 * @author felipe
 */
class Tarefa {
   
    protected $descricao;
    protected $dataCriacao;
    protected $status;
    protected $categoria;
   
    public function get_descricao() {
        return $this->descricao;
    }

    public function get_dataCriacao() {
        return $this->dataCriacao;
    }

    public function get_status() {
        return $this->status;
    }

    public function get_categoria() {
        return $this->categoria;
    }

    public function set_descricao($descricao) {
        Validacoes::verificaTamanho("descricao", $descricao, 5, 30);
        $this->descricao = $descricao;
        return $this;
    }

    public function set_dataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
        return $this;
    }

    public function set_status($status) {
        $this->status = $status;
        return $this;
    }

    public function set_categoria($categoria) {
        $this->categoria = $categoria;
        return $this;
    }


    
    
}
