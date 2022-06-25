<?php

namespace App\Entity;

use App\Db\Database;
use \PDO;

class Projetos
{
    /**
     * Indentificador único
     *
     * @var integer
     */
    public $id;
    /**
     * Indentificador único estrangeiro usuario
     *
     * @var integer
     */
    public $id_usuario;
    /**
     * Nome do Projeto
     *
     * @var string
     */
    public $nome;
    /**
     * Descricao do Projeto
     *
     * @var string
     */
    public $descricao;
    /**
     * Chave estrangeira do Gabinete
     *
     * @var integer
     */
    public $codgabinete;
    /**
     * Chave estrangeira do processador
     *
     * @var integer
     */
    public $codprocessador;
    /**
     * Chave estrangeira da ram
     *
     * @var integer
     */
    public $codram;
    /**
     * Chave estrangeira do Disco
     *
     * @var integer
     */
    public $coddisco;
    /**
     * Chave estrangeira da Placamae
     *
     * @var integer
     */
    public $codplacamae;
    /**
     * Chave estrangeira da placa de video
     *
     * @var integer
     */
    public $codplacavideo;
    /**
     * Chave estrangeira da Fonte
     *
     * @var integer
     */
    public $codfonte;
    /**
     * Data de criação
     *
     * @var integer
     */
    public $data;
    /**
     * Função com o dever de cadastrar no banco
     *
     *
     * @return void
     */
    public function cadastrar()
    {
        $database = new Database('projetos');
        $this->data = date('Y-m-d H:i:s');
        $this->id = $database->insert([
            'nome' =>        $this->nome,
            'descricao' =>   $this->descricao,
            'id_usuario' =>        $this->id_usuario,
            'datainicio' => $this->data,
            'codgabinete_gabinete' => $this->codgabinete,
            'codprocessador_processador' => $this->codprocessador,
            'codram_ram' => $this->codram,
            'coddisco_disco' => $this->coddisco,
            'codplacamae_placamae' => $this->codplacamae,
            'codplacavideo_placavideo' => $this->codplacavideo,
            'codfonte_fonte' => $this->codfonte
        ]);
    }
    /**
     * Trará todos os projetos de um usuario
     *
     * @param [string] $where
     * @param [string] $order
     * @param [integer] $limit
     * @return array
     */
    public static function getProjetos($where = null, $order = null, $limit = null)
    {
        return (new Database('projetos'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    /**
     * Trará a quantidade de projetos
     *
     * @param [string] $where
     * @return integer
     */
    public static function GetQuantidadesProjetos($where = null)
    {
        return (new Database('projetos'))->select($where, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
    }
    public static function getProjeto($id)
    {
        return (new Database('projetos'))->select('codprojeto = ' . $id)
            ->fetchObject(self::class);
    }
    /**
     * Função capaz de atualizar dados dos projetos.
     *
     * @return PDOStatement
     */
    public function atualizar()
    {
        return (new Database('projetos'))->update('codprojeto=' . $this->codgabinete, ([
            'nome' =>        $this->nome,
            'codgabinete_gabinete' =>   $this->codgabinete,
            'codfonte_fonte' =>        $this->codfonte,
            'codram_ram' =>        $this->codram,
            'coddisco_disco' =>        $this->coddisco,
            'codplacamae_placamae' =>        $this->codplacamae,
            'codplacavideo_placavideo' =>        $this->codplacavideo,
            'codprocessador_processador' =>        $this->codprocessador
        ]));
    }
}
