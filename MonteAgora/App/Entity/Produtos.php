<?php

namespace App\Entity;

use App\Db\Database;
use \PDO;

class Produtos
{
    /**
     * Indentificador único (ALL)
     *
     * @var integer
     */
    public $id;

    /**
     * Descricao do Produto (ALL)
     *
     * @var string
     */
    public $descricao;
    /**
     * Nome do produto (ALL)
     *
     * @var string
     */
    public $nome;

    /**
     * Tipo (Fonte[ATX, Micro...], disco[HDD/SSD], RAM[DDR's], Gabinete[ATX, micro] Placa-Mãe[Atx, EAtx...]) )
     *
     * @var string
     */
    public $tipo;
    //Fonte
    /**
     * Potencia da [Fonte];
     *
     * @var integer
     */
    public $potencia;
    /**
     * Tipo de conexão com a Placa-Mãe
     *
     * @var string
     */
    public $conexoespm;
    /**
     * Tipo de conexão com a Placa de video
     *
     * @var string
     */
    public $conexoespv;
    /**
     * Tipo de conexão 12v
     *
     * @var string
     */
    public $conector12v;
    //Placa-Mãe
    /**
     * Socket da placa-mãe ou Socket do processador
     *
     * @var string
     */
    public $ssocket;
    /**
     * Qt de Slots de RAM
     *
     * @var integer
     */
    public $slotsram;
    /**
     * Consumo do Produto[W's] / All
     *
     * @var integer
     */
    public $consumo;
    /**
     * Tipo de Memória(Para placa-mãe, suportada; Para processador, DDR's suportado(s);)
     *
     * @var string
     */
    public $tipomem;
    /**
     * Quantidade de slots PCI x16/x8
     *
     * @var integer
     */
    public $qtpci;
    /**
     * Quantidade de ram Sup da placa-mãe/Processador
     *
     * @var integer
     */
    public $ramsup;
    /**
     * String se há ou não video na placa mãe ou processador[s/n];
     *
     * @var string
     */
    public $video;
    /**
     * Barramento (Para Placa-Mãe: Barramento suportado; Para Processador, seu barramento; Para memoria ram, seu barramento; Para disco, seu barramento; Para placa de video, seu barramento)
     *
     * @var float
     */
    public $barramento;
    /**
     * String dos conectores da placa-mãe[24/20+4/20]
     *
     * @var string
     */
    public $conectores;
    /**
     * Quantidade de conectores sata
     *
     * @var string
     */
    public $qtsata;
    //Processador
    /**
     * Litografia do processador
     *
     * @var integer
     */
    public $litografia;
    //RAM
    /**
     * Int sobre capacidade da RAM/Disco
     *
     * @var integer
     */
    public $capacidade;
    /**
     * Função com o dever de cadastrar no banco
     *
     * @param string Tipo de produto a ser cadastrado $produto
     * @return void
     */
    public function cadastrar($produto)
    {
        if ($produto == 'gabinete') {

            //Insere o valor no banco (Gabinete)
            $database = new Database('gabinete');
            $this->id = $database->insert([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'tipogab' =>        $this->tipo
            ]);
        } else if ($produto == 'fonte') {
            //Insere o valor no banco (Fonte)
            $database = new Database('fonte');
            $this->id = $database->insert([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'tipo' =>        $this->tipo,
                'potencia' => $this->potencia,
                'conexoespm' => $this->conexoespm,
                'conector12v' => $this->conector12v,
                'conexoespv' => $this->conexoespv
            ]);
        } else if ($produto == 'placamae') {
            //Insere o valor no banco(Placamae)
            $database = new Database('placamae');
            $this->id = $database->insert([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'tipo' =>        $this->tipo,
                'ssocket' => $this->ssocket,
                'slotsram' => $this->slotsram,
                'consumo' => $this->consumo,
                'tipomem' => $this->tipomem,
                'qtpci' => $this->qtpci,
                'ramsup' => $this->ramsup,
                'video' => $this->video,
                'barramento' => $this->barramento,
                'conectores' => $this->conectores,
                'qtsata' => $this->qtsata
            ]);
        } else if ($produto == 'processador') {
            //Insere o valor no banco(Processador)
            $database = new Database('processador');
            $this->id = $database->insert([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'tipomem' =>     $this->tipomem,
                'ssocket' => $this->ssocket,
                'consumo' => $this->consumo,
                'ramsup' => $this->ramsup,
                'litografia' => $this->litografia,
                'video' => $this->video,
                'barramento' => $this->barramento

            ]);
        } else if ($produto == 'ram') {
            //Insere o valor no banco(RAM)
            $database = new Database('ram');
            $this->id = $database->insert([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'tipo' =>        $this->tipo,
                'consumo' => $this->consumo,
                'capacidade' => $this->capacidade,
                'barramento' => $this->barramento
            ]);
        } else if ($produto == 'disco') {
            //Insere o valor no banco(Discos)
            $database = new Database('disco');
            $this->id = $database->insert([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'tipo' =>        $this->tipo,
                'consumo' =>     $this->consumo,
                'capacidade' =>  $this->capacidade,
                'barramento' =>  $this->barramento
            ]);
        } else if ($produto == 'placavideo') {
            //Insere o valor no banco(placadevideo)
            $database = new Database('placavideo');
            $this->id = $database->insert([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'consumo' =>     $this->consumo,
                'barramento' =>  $this->barramento
            ]);
        }
        print_r($this);
    }
    /**
     * Método responsável por efetuar a atualização no banco;
     *
     * @return boolean
     */
    public function atualizar($produto)
    {
        if ($produto == 'gabinete') {
            return (new Database('gabinete'))->update('codgabinete=' . $this->codgabinete, ([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'tipogab' =>        $this->tipogab
            ]));
        } else if ($produto == 'placamae') {
            return (new Database('placamae'))->update('codplaca=' . $this->codplaca, ([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'tipo' =>        $this->tipo,
                'ssocket' => $this->ssocket,
                'slotsram' => $this->slotsram,
                'consumo' => $this->consumo,
                'tipomem' => $this->tipomem,
                'qtpci' => $this->qtpci,
                'ramsup' => $this->ramsup,
                'video' => $this->video,
                'barramento' => $this->barramento,
                'conectores' => $this->conectores,
                'qtsata' => $this->qtsata
            ]));
        } else if ($produto == 'processador') {
            return (new Database('processador'))->update('codprocessador=' . $this->codprocessador, ([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'tipomem' =>     $this->tipomem,
                'ssocket' => $this->ssocket,
                'consumo' => $this->consumo,
                'ramsup' => $this->ramsup,
                'litografia' => $this->litografia,
                'video' => $this->video,
                'barramento' => $this->barramento

            ]));
        } else if ($produto == 'ram') {
            return (new Database('ram'))->update('codram=' . $this->codram, ([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'tipo' =>        $this->tipo,
                'consumo' => $this->consumo,
                'capacidade' => $this->capacidade,
                'barramento' => $this->barramento
            ]));
        } else if ($produto == 'placavideo') {
            return (new Database('placavideo'))->update('codplacavideo=' . $this->codplacavideo, ([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'consumo' =>     $this->consumo,
                'barramento' =>  $this->barramento
            ]));
        } else if ($produto == 'disco') {
            return (new Database('disco'))->update('coddisco=' . $this->coddisco, ([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'tipo' =>        $this->tipo,
                'consumo' =>     $this->consumo,
                'capacidade' =>  $this->capacidade,
                'barramento' =>  $this->barramento
            ]));
        } else if ($produto == 'fonte') {
            return (new Database('fonte'))->update('codfonte=' . $this->codfonte, ([
                'nome' =>        $this->nome,
                'descricao' =>   $this->descricao,
                'tipo' =>        $this->tipo,
                'potencia' => $this->potencia,
                'conexoespm' => $this->conexoespm,
                'conector12v' => $this->conector12v,
                'conexoespv' => $this->conexoespv
            ]));
        }
    }


    /**
     * Método que dará Select/Obter os produtos propostos em pesquisa;
     *
     * @param string $where
     * @param string $order
     * @param integer $limit
     * @param string $table
     * @return array
     */
    public static function getProduto($id, $produto)
    {
        if ($produto == 'gabinete') {
            return (new Database('gabinete'))->select('codgabinete = ' . $id)
                ->fetchObject(self::class);
        } else if ($produto == 'placamae') {
            return (new Database('placamae'))->select('codplaca = ' . $id)
                ->fetchObject(self::class);
        } else if ($produto == 'processador') {
            return (new Database('processador'))->select('codprocessador = ' . $id)
                ->fetchObject(self::class);
        } else if ($produto == 'ram') {
            return (new Database('ram'))->select('codram = ' . $id)
                ->fetchObject(self::class);
        } else if ($produto == 'placavideo') {
            return (new Database('placavideo'))->select('codplacavideo = ' . $id)
                ->fetchObject(self::class);
        } else if ($produto == 'disco') {
            return (new Database('disco'))->select('coddisco = ' . $id)
                ->fetchObject(self::class);
        } else if ($produto == 'fonte') {
            return (new Database('fonte'))->select('codfonte = ' . $id)
                ->fetchObject(self::class);
        }
    }
    /**
     * Trará todos os produtos de uma tabela
     *
     * @param string $where
     * @param string $order
     * @param integer $limit
     * @param string $table
     * @return void
     */
    public static function getProdutos($where = null, $order = null, $limit = null, $table)
    {
        if ($table == 'gabinete') {
            return (new Database('gabinete'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
        } else if ($table == 'placamae') {
            return (new Database('placamae'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
        } else if ($table == 'processador') {
            return (new Database('processador'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
        } else if ($table == 'ram') {
            return (new Database('ram'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
        } else if ($table == 'placavideo') {
            return (new Database('placavideo'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
        } else if ($table == 'disco') {
            return (new Database('disco'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
        } else if ($table == 'fonte') {
            return (new Database('fonte'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
        }
    }

    /**
     * Método que Obterá a quantidade dos produtos ;
     *
     * @param string $where

     * @return integer
     */
    public static function GetQuantidadesProdutos($where = null, $table)
    {
        switch ($table) {
            case 'gabinete':
                return (new Database('gabinete'))->select($where, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
                break;
            case 'placamae':
                return (new Database('placamae'))->select($where, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
                break;
            case 'processador':
                return (new Database('processador'))->select($where, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
                break;
            case 'fonte':
                return (new Database('fonte'))->select($where, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
                break;
            case 'placavideo':
                return (new Database('placavideo'))->select($where, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
                break;
            case 'ram':
                return (new Database('ram'))->select($where, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
                break;
            case 'disco':
                return (new Database('disco'))->select($where, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
                break;
        }
    }
    /**
     * Método responsável por excluir a vaga do banco
     *
     * @param string $table
     * @return boolean
     */
    public function excluir($table)
    {
        switch ($table) {
            case 'gabinete':
                return (new Database('gabinete'))->delete('codgabinete = ' . $this->codgabinete);
            case 'placamae':
                return (new Database('placamae'))->delete('codplaca = ' . $this->codplaca);
                break;
            case 'processador':
                return (new Database('processador'))->delete('codprocessador = ' . $this->codprocessador);
                break;
            case 'fonte':
                return (new Database('fonte'))->delete('codfonte = ' . $this->codfonte);
                break;
            case 'placavideo':
                return (new Database('placavideo'))->delete('codplacavideo = ' . $this->codplacavideo);
                break;
            case 'ram':
                return (new Database('ram'))->delete('codram = ' . $this->codram);
                break;
            case 'disco':
                return (new Database('disco'))->delete('coddisco = ' . $this->coddisco);
                break;
        }
    }
    /**
     * Método responsável separar os produtos
     * @param array $arrays
     * @param string $condicoes
     * @param string $table
     * @return array
     */
    public static function separe($arrays, $condicoes, $table)
    {
        $arrays = array();
        switch ($table) {
            case 'gabinete':

            case 'placamae':
                foreach ($arrays as $key => $value) {
                    if ($value['tipomem'] === $condicoes) {
                        $parentArrays[] = $key;
                    }
                }
                break;
            case 'processador':
                foreach ($arrays as $key => $value) {
                    if ($value['tipomem'] === $condicoes) {
                        $parentArrays[] = $key;
                    }
                }
                break;
            case 'fonte':

                break;
            case 'placavideo':

                break;
            case 'ram':
                foreach ($arrays as $key => $value) {
                    if ($value['tipomem'] === $condicoes) {
                        $parentArrays[] = $key;
                    }
                }
                break;
            case 'disco':

                break;
        }

        return $parentArrays;
    }
}
