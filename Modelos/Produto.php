<?php 
require_once("Pedido.php");
require_once("Comida.php");


class Produto extends Pedido{

    // Atributos:
    private Comida $comida;
    private Bebida $bebida;
    private float $valor;
    private string $nome;
    private $id;


    // GETs e SETs:
     
    public function getComida(): Comida  {
        return $this->comida;
    }
    public function setComida(Comida $comida): self {
        $this->comida = $comida;
        return $this;
    }

    public function getBebida(): Bebida {
        return $this->bebida;
    }
    public function setBebida(Bebida $bebida): self {
        $this->bebida = $bebida;
        return $this;
    }

    public function getValor(): float {
        return $this->valor;
    }
    public function setValor(float $valor): self {
        $this->valor = $valor;
        return $this;
    }

  
    public function getNome(): string  {
        return $this->nome;
    }
    public function setNome(string $nome): self {
        $this->nome = $nome;
        return $this;
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }
}