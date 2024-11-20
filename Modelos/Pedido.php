<?php

require_once("Produto.php");
require_once("Comida.php");
require_once("Bebida.php");

class Pedido {
    // Atributos
    private string $nomeCliente;
    private string $nomeGarcom;
    private string $nomeCaixeiro;
    private Produto $prato; // Representa o prato ou bebida do pedido.

    // Métodos
    public function menu(): array {
        echo "Bem-vindo à nossa Cafeteria!\n";
        echo "Aqui está o nosso menu:\n";

        $menuArray = [
            // Bebidas Quentes
            new Bebida(1, "Espresso", 8.00),
            new Bebida(2, "Cappuccino", 6.00),
            new Bebida(3, "Latte", 4.00),
            new Bebida(4, "Mocha", 6.00),
            new Bebida(5, "Americano", 6.00),

            // Bebidas Frias
            new Bebida(6, "Café Gelado", 8.00),
            new Bebida(7, "Suco de Laranja", 6.00),
            new Bebida(8, "Smoothie de Morango", 4.00),
            new Bebida(9, "Chá Gelado", 6.00),
            new Bebida(10, "Refrigerante", 6.00),

            // Comidas - Doces
            new Comida(1, "Bolo de Chocolate", 12.00),
            new Comida(2, "Croissant de Chocolate", 7.00),
            new Comida(3, "Muffin de Banana", 6.00),
            new Comida(4, "Torta de Limão", 15.00),

            // Comidas - Salgadas
            new Comida(5, "Sanduíche de Presunto e Queijo", 14.00),
            new Comida(6, "Quiche de Frango com Espinafre", 18.00),
        ];

        foreach ($menuArray as $item) {
            echo $item->getId() . " - " . $item->getNome() . " - R$ " . $item->getValor() . "\n";
        }

        return $menuArray;
    }

    public function __toString(): string {
        $dados = "O Cliente: " . $this->getNomeCliente() . "\n";
        $dados .= "Foi atendido pelo garçom: " . $this->getNomeGarcom() . "\n";
        $dados .= "E pelo caixeiro: " . $this->getNomeCaixeiro() . "\n";
        $dados .= "Pedido: " . $this->getPrato()->getNome() . " - R$ " . $this->getPrato()->getValor() . "\n";

        return $dados;
    }

    public function listarPedido() {
        $pedidoArray = [];
        $menuArray = $this->menu();
        $escolha = 0;

        do {
            echo "\n** -------- MENU ------------**\n";
            echo " 1 -------- ADICIONAR ---------\n";
            echo " 2 -------- CANCELAR ----------\n";
            echo " 3 -------- LISTAR ------------\n";
            echo " 0 -------- SAIR --------------\n";

            $escolha = (int) readline("De qual serviço você precisa? ");

            switch ($escolha) {
                case 1:
                    echo "\n--- ADICIONAR ---\n";

                    $novoPedido = new Pedido();
                    $novoPedido->setNomeCliente(readline("Informe o nome do cliente: "));
                    $novoPedido->setNomeGarcom(readline("Informe o nome do garçom: "));
                    $novoPedido->setNomeCaixeiro(readline("Informe o nome do caixeiro: "));

                    $numero = (int) readline("Informe o número do prato ou bebida: ");
                    $prato = $this->retPrato($menuArray, $numero);

                    if ($prato) {
                        $novoPedido->setPrato($prato);
                        $pedidoArray[] = $novoPedido;
                        echo "Pedido adicionado com sucesso!\n";
                    } else {
                        echo "Prato ou bebida inválido!\n";
                    }
                    break;

                case 2:
                    echo "LISTA DE PEDIDOS\n";
                    foreach ($pedidoArray as $i => $ped) {
                        echo ($i + 1) . "º Pedido: \n" . $ped;
                    }

                    $indiceRemover = (int) readline("Informe o número do pedido que deseja remover: ") - 1;

                    if ($indiceRemover >= 0 && $indiceRemover < count($pedidoArray)) {
                        unset($pedidoArray[$indiceRemover]);
                        $pedidoArray = array_values($pedidoArray); // Reorganizar índices.
                        echo "Pedido removido com sucesso!\n";
                    } else {
                        echo "Pedido inválido!\n";
                    }
                    break;

                case 3:
                    echo "LISTA DE PEDIDOS:\n";
                    if (empty($pedidoArray)) {
                        echo "Nenhum pedido cadastrado.\n";
                    } else {
                        foreach ($pedidoArray as $pedido) {
                            echo $pedido;
                        }
                    }
                    break;

                case 0:
                    echo "Saindo do sistema...\n";
                    break;

                default:
                    echo "Opção inválida!\n";
            }
        } while ($escolha != 0);
    }

    private function retPrato(array $menuArray, int $numero): ?Produto {
        foreach ($menuArray as $item) {
            if ($item->getId() === $numero) {
                return $item;
            }
        }
        return null;
    }

    // GETs e SETs:
    public function getNomeCliente(): string {
        return $this->nomeCliente;
    }

    public function setNomeCliente(string $nomeCliente): self {
        $this->nomeCliente = $nomeCliente;
        return $this;
    }

    public function getNomeGarcom(): string {
        return $this->nomeGarcom;
    }

    public function setNomeGarcom(string $nomeGarcom): self {
        $this->nomeGarcom = $nomeGarcom;
        return $this;
    }

    public function getNomeCaixeiro(): string {
        return $this->nomeCaixeiro;
    }

    public function setNomeCaixeiro(string $nomeCaixeiro): self {
        $this->nomeCaixeiro = $nomeCaixeiro;
        return $this;
    }

    public function getPrato(): Produto {
        return $this->prato;
    }

    public function setPrato(Produto $prato): self {
        $this->prato = $prato;
        return $this;
    }
}
