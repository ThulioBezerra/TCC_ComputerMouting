<?php

namespace App\Db;

use \PDO;
use \Exception;
use \PDOException;

class Database
{
    /**
     * Host de conexao ao db
     *
     * @var string
     */
    const HOST = 'localhost';
    /**
     * Nome do banco de dados
     *
     * @var string
     */
    const NAME = 'montagem';
    /**
     * Usuário do banco
     *
     * @var string
     */
    const USER = 'root';
    /**
     * Senha do banco
     *
     * @var string
     */
    const PASS = "lifeboy777";
    /**
     * Nome da tabela
     *
     * @var string
     */
    private $table;
    /**
     * Instância de conexão ao db
     *
     * @var PDO
     */
    private $conexao;

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }
    /**
     * Cria uma conexão com o DB
     *
     */
    private function setConnection()
    {
        try {
            $this->conexao = new PDO('mysql:host=' . self::HOST . '; dbname=' . self::NAME, self::USER, self::PASS);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro no banco de dados! " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro genérico! " . $e->getMessage();
        }
    }
    /**
     * Insere no banco de Dados
     *
     * @param array $values [field => values]
     * @return integer ID inserido
     */
    public function insert($values)
    {   //Dados da Query
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        //Query a montar
        $query = 'INSERT INTO ' . $this->table . '(' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        //Executa o insert
        $this->execute($query, array_values($values));
        //Retorna o ID
        return $this->conexao->lastInsertId();
    }
    /**
     * Vai executar as querys no banco
     *
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            //Prepara a query
            $state = $this->conexao->prepare($query);
            //Insere os parâmetros (VALUES)
            $state->execute($params);
            return $state;
        } catch (PDOException $e) {
            echo "Erro no banco de dados! " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro genérico! " . $e->getMessage();
        }
    }
    /**
     * Método que irá executar a consulta no banco
     *
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {   //DADOS da Query
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //Monta a query
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        //Executa a query
        return $this->execute($query);
    }
    /**
     * Irá executar as atualizações
     *
     * @param [string] $where
     * @param [array] $values[field => value]
     * @return boolean
     */
    public function update($where, $values)
    {
        //Dados da Query
        $fields = array_keys($values);

        //Monta a query
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?, ', $fields) . '=? WHERE ' . $where;
        //Executar a query
        $this->execute($query, array_values($values));
        return true;
    }
    /**
     * Método responsável por excluir dados do banco
     * @param  string $where
     * @return boolean
     */
    public function delete($where)
    {
        //MONTA A QUERY
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;
        echo $query;
        //EXECUTA A QUERY
        $this->execute($query);
        //RETORNA SUCESSO
        return true;
    }
}
