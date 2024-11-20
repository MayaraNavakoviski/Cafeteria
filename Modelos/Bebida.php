<?php 
require_once("Pedido.php");
require_once("Produto.php");

class Bebida extends Produto {

    // Atributos
    private $temperatura;
    private $tamanho;

    // Array para armazenar os pedidos
    private array $pedidoArray = [];

     // permite acessar o menuuuuu
    private Pedido $pedido;

    // Construtor:
    public function __construct() {
        $this->pedido = new Pedido();
    }

     // Métodos:
     public function listarPedido() {
        $escolha = 0;

        do {
            echo "** -------- MENU ------------**\n";
            echo "1 -------- ADICIONAR --------*\n";
            echo "2 -------- CANCELAR ---------*\n";
            echo "3 -------- LISTAR -----------*\n";
            echo "4 -------- TOTAL ------------*\n";
            echo "0 -------- SAIR -------------*\n";

            $escolha = (int) readline("De qual serviço você precisa? ");

            switch ($escolha) {
                case 1:
                    echo "\n--- ADICIONAR PEDIDO ---\n";

                    $novoPedido = new Pedido();
                    $novoPedido->setNomeCliente(readline("Informe o nome do cliente: "));
                    $novoPedido->setNomeGarcom(readline("Informe o nome do garçom: "));
                    $novoPedido->setNomeCaixeiro(readline("Informe o nome do caixeiro: "));

                    echo "\n---- MENU: ----\n";
                    $menuArray = $this->pedido->menu(); // Chama o menu de Pedido.php
                    foreach ($menuArray as $item) {
                        echo $item->getId() . " - " . $item->getNome() . " - R$ " . number_format($item->getValor(), 2) . "\n";
                    }

                    $numero = (int) readline("Informe o número do prato/bebida: ");
                    $prato = $this->retPrato($menuArray, $numero);

                    if ($prato) {
                        $novoPedido->setPrato($prato);
                        $this->pedidoArray[] = $novoPedido;
                        echo "Pedido adicionado com sucesso!\n";
                    } else {
                        echo "Prato/bebida não encontrado!\n";
                    }
                    break;

                case 2:
                    echo "\n--- CANCELAR PEDIDO ---\n";

                    if (empty($this->pedidoArray)) {
                        echo "Nenhum pedido registrado.\n";
                        break;
                    }

                    foreach ($this->pedidoArray as $i => $ped) {
                        echo ($i + 1) . "º Pedido: " . $ped . "\n";
                    }

                    $indiceRemover = (int) readline("Informe o número do pedido a ser removido: ") - 1;

                    if ($indiceRemover >= 0 && $indiceRemover < count($this->pedidoArray)) {
                        array_splice($this->pedidoArray, $indiceRemover, 1);
                        echo "Pedido removido com sucesso!\n";
                    } else {
                        echo "Número de pedido inválido!\n";
                    }
                    break;

                case 3:
                    echo "\n--- LISTAR PEDIDOS ---\n";

                    if (empty($this->pedidoArray)) {
                        echo "Nenhum pedido registrado.\n";
                        break;
                    }

                    foreach ($this->pedidoArray as $i => $ped) {
                        echo ($i + 1) . "º Pedido:\n";
                        echo "Cliente: " . $ped->getNomeCliente() . "\n";
                        echo "Garçom: " . $ped->getNomeGarcom() . "\n";
                        echo "Caixeiro: " . $ped->getNomeCaixeiro() . "\n";
                        echo "Prato: " . $ped->getPrato()->getNome() . "\n";
                        echo "Valor: R$ " . number_format($ped->getPrato()->getValor(), 2) . "\n";
                        echo "---------------------------\n";
                    }
                    break;

                case 4:
                    echo "\n--- TOTAL DOS PEDIDOS ---\n";

                    $total = 0;
                    foreach ($this->pedidoArray as $ped) {
                        $total += $ped->getPrato()->getValor();
                    }

                    echo "O valor total dos pedidos é: R$ " . number_format($total, 2) . "\n";
                    break;

                case 0:
                    echo "\nEncerrando o serviço...\n";
                    break;

                default:
                    echo "\nOpção inválida. Tente novamente.\n";
                    break;
            }
        } while ($escolha != 0);
    }

    // Método para buscar o pedido pelo nummm
    private function retPrato(array $menuArray, int $id) {
        foreach ($menuArray as $item) {
            if ($item->getId() === $id) {
                return $item;
            }
        }
        return null;
    }

    // GETs e SETs:
    public function getTemperatura() {
        return $this->temperatura;
    }

    public function setTemperatura($temperatura): self {
        $this->temperatura = $temperatura;
        return $this;
    }

    public function getTamanho() {
        return $this->tamanho;
    }

    public function setTamanho($tamanho): self {
        $this->tamanho = $tamanho;
        return $this;
    }
}
