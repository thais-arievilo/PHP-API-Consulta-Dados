<?php
    //Arquivo que irá executar o comando de consulta, na hora de executar, será esse arquivo
    include 'AlunosService.php';

    //Serve para retornar os dados em formato JSON
    header("Content-Type: application/json; charset=UTF-8");
    //http://localhost/PROJETO_API_CRUD_FACULDADE/Alunos
    //Variavel $_GET serve para pegar os parametros: api\alunos
    if($_GET['url']) {
        $url = explode('/', $_GET['url']);
        if($url[0]==='api') { //Primeiro parâmetro "api"
            array_shift($url); //Andar uma posição
            $service = ucfirst($url[0]).'Service'; //Pegar o nome "AlunosService"
            array_shift($url);

            $method = strtolower($_SERVER['REQUEST_METHOD']); //Pega o metodo GET do arquivo alunosService

            try {
                //Busca os dados
                $response = call_user_func_array(array(new $service, $method),$url);
                http_response_code(200); //O código 200 quer dizer que esta certo/ok
                //Mostrar os dados em JSON
                echo json_encode(array('status' => 'success', 'data' => $response));
            }
            catch(Exception $e) {
                http_response_code(400); //O código 400 quer dizer que esta deu errado
                //Mostrar os dados em JSON
                echo json_encode(array('status' => 'error', 'data' => $e->getMessage()));
            }
        }
    }
?>