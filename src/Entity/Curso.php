<?php

namespace Alura\Cursos\Entity;

/**
 * @Entity
 * @Table(name="curso")
 */
class Curso
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
    private $descricao;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Curso
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }
}
