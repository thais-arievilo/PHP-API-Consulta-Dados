<?php
    //Esse arquivo tem a finalidade de mostrar o tipo de serviço que oferece
    include 'Alunos.php';

    class AlunosService {
                            //O null quer dizer que pode ou não ter parametros
        public function get($id = null) {
            if($id) {
                //Retorna os dados que foi identificado atraves do parametro
                return Alunos::select($id);
            }
            else {
                //Caso não for encontrato pelo id, significa que esse dado ainda não existe
                return Alunos::selectAll();
            }
        }
    }
?>