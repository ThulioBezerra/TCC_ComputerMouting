<?php

namespace App\Entity;

use App\Db\Database;
use \PDO;

class Usuario
{
    /**
     * Usuario da conta
     *
     * @var string
     */
    public $id_usuario;
    /**
     * Usuario da conta
     *
     * @var string
     */
    public $usuario;
    /**
     * CSenha da conta
     *
     * @var string
     */
    public $senha;
    /**
     * Data de criação
     *
     * @var integer
     */
    public $datacri;
    /**
     * Função com o dever de cadastrar no banco
     *
     *
     * @return PDOStatement
     */
    public function login()
    {
        $database = new Database('usuario');
        $statement = $database->select("usuario = '" . $this->usuario . "' AND " . "senha='" . $this->senha . "'");
        $fetch = $statement->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }
    /**
     * Função com o dever de achar um usuario
     *
     *
     * @return PDOStatement
     */
    public function getUsuario()
    {
        $database = new Database('usuario');
        $statement = $database->select("usuario = '" . $this->usuario . "'");
        $fetch = $statement->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }
    public function cadastrar()
    {
        //Insere o valor no banco (Usuario)
        $this->datacri = date('Y-m-d H:i:s');
        $database = new Database('usuario');
        $this->id_usuario = $database->insert([
            'usuario' =>        $this->usuario,
            'senha' =>   $this->senha,
            'datacri' =>        $this->datacri,
            'tipo_usuario' => 0
        ]);
        return $this->id_usuario;
    }
    /**
     * Método responsável atualizar senha
     *
     * @return boolean
     */
    public function atualizarpass()
    {
        return (new Database('usuario'))->update('id_usuario=' . $this->id_usuario, ([
            ' senha' =>        $this->senha
        ]));
    }
    /**
     * Método responsável excluir acc
     *
     * @return boolean
     */
    public function excluir()
    {
        return (new Database('usuario'))->delete('id_usuario = ' . $this->id_usuario);
    }
}
