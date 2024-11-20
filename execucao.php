<?php 

require_once("Modelo/Bebida.php");
require_once("Modelo/Comida.php");
require_once("Modelo/IPedido.php");
require_once("Modelo/Pedido.php");
require_once("Modelo/Produto.php");

$escolha = 0;
        do {
            "** -------- MENU ------------**  " . "\n";
            " 1 -------- ADCIONAR ---------* " . "\n";
            " 2 -------- CANCELAR ----------* " . "\n";
            " 3 -------- LISTAR ------------* " . "\n";
            " 0 -------- SAIR --------------* " . "\n";

            $escolha = readline("De qual serviço você precisa? ");

            switch ($escolha) {
    
                case 1:
                    echo "\nVocê escolheu a opção de adicionar um produto.\n";


                }
                
            }while ($escola != 0);

        
