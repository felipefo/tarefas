<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/www/api/model/Validacoes.php";

/**
 * @author felipe
 */
class Tarefa {
   
    protected $id;
    protected $descricao;
    protected $dataCriacao;
    protected $status;
    protected $categoria;
    protected $dataFim;
    
    const AFAZER = 1;
    const FAZENDO = 2;
    const FEITO = 3;
    
    public function get_id() {
        return $this->id;
    }
    
    public function set_id($id) {
        return $this->id = $id;
    }
   
    public function get_descricao() {
        return $this->descricao;
    }

    public function get_data_criacao() {
        return $this->dataCriacao;
    }
    
     public function get_data_fim() {
        return $this->dataFim;
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

    public function set_data_criacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
        return $this;
    }
    
     public function set_data_fim($dataFim) {
        $this->dataFim = $dataFim;
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
