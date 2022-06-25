<?php

namespace App\Db;

class Pagination
{
    /**
     * Numero maximo de registros
     *
     * @var integer
     */
    private $limit;
    /**
     * Quantidade total de resultados do banco
     *
     * @var integer
     */
    private $results;
    /**
     * Quantidade de páginas
     *
     * @var integer
     */
    private $pages;
    /**
     * Página atual
     *
     * @var integer
     */
    private $currentPage;

    /**
     * Construtor da classe
     *
     * @param integer $results
     * @param integer $currentpages
     * @param integer $limit
     */
    public function __construct($results, $currentPage = 1, $limit = 3)
    {
        $this->results = $results;
        $this->limit = $limit;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
        $this->calculate();
    }
    /**
     * Método responsável para calcular a paginação
     *
     */
    private function calculate()
    {
        //Calcula o total de páginas
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

        //Verifica se a pagina atual não é excedida
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }
    /**
     * Retorna o limit do SQL
     *
     * @return string
     */
    public function getLimit()
    {
        $offset = ($this->limit * ($this->currentPage - 1));
        return $offset . ',' . $this->limit;
    }
    public function getPages()
    {
        //Não retorna paginas
        if ($this->pages == 1) return [];

        //Paginas
        $paginas = [];
        for ($i = 1; $i <= $this->pages; $i++) {
            $paginas[] = [
                'pagina' => $i,
                'atual' => $i == $this->currentPage
            ];
        }
        return $paginas;
    }
}
