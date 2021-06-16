<?php

namespace Alura\Cursos\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="cliente")
 */
class Cliente
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $nome;
    /**
     * @Column (type="string")
     */
    private $cpf;

    /**
     * @OneToMany(targetEntity="Produto", mappedBy="Cliente" )
     */
    private $produtos;


    public function __construct()
    {
        $this->produtos = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function addProduto(Produto $produto)
    {
        $this->produtos->add($produto);
        $produto->setCliente($this);
        return $this;
    }


    public function getProdutos()
    {
        return $this->produtos;
    }


}