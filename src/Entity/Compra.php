<?php

namespace Alura\Cursos\Entity;

/**
 * @Entity
 * @Table(name="compra")
 */
class Compra
{
    /**
     * @Id
     * @GeneratedValue
     * @Column (type="integer")
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $nome;

    /**
     * @Column(type="string")
     */
    private $statusDaCompra;
    private $produtos;

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getStatusDaCompra()
    {
        return $this->statusDaCompra;
    }

    public function setStatusDaCompra($statusDaCompra)
    {
        $this->statusDaCompra = $statusDaCompra;
        return $this;
    }

    public function getProdutos()
    {
        return $this->produtos;
    }

    public function setProdutos($produtos): void
    {
        $this->compras = $produtos;
    }

    public function addProduto(Produto $produto)
    {
        $this->compras->add($produto);
    }


}