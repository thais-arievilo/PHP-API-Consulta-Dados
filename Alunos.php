<?php
//Arquivo de regra de negócios
//Incluir o arquivo config que criamos para utilizar as const
//Outro comando para incluir: require_once 'config.php'; - Verifica primeiro se já foi incluido, caso não, inclui.
require_once 'config.php';
    //Arquivo de regra de négocio - Operações da API - CRUD
    class Alunos {
        //Método consulta através de um parâmetro $id
        //Geralmente quando consultamos, seriam todos ou filtra por uma chave
        public static function select(int $id) {
            $tabela = "alunos"; //Nome da tabela
            $coluna = "codigo"; //A chave primária

            //Conexão com o Banco de Dados
            $connPdo = new PDO(dbDrive.':host='.dbHost.';dbname='.dbName,dbUser,dbPass); //
           // $connPdo = new PDO('mysql:dbname=projeto_web;host=localhost','root',''); variavel name minu

            //Comando para consultar 
            $sql = "select * from $tabela where $coluna = :id";

            //Prepara o comando Select, para ser executado usando o metoto prepare()
            $stmt = $connPdo->prepare($sql);

            //Mapeando o parametro de busca, que no nosso caso, seria o id
            $stmt->bindValue(':id', $id);

            //Comando para executar o comando no banco de dados
            $stmt->execute();

            //Comando para validar se os dados foram registrados ou não
            if($stmt->rowCount() > 0) {
                //Caso tiver registros, irá retornar os dados através do FETCH
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            else {
                throw new Exception("Sem registro do aluno!");
            }
        }
    }
?>