<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class IncluirImagem extends BaseController
{
    public function index()
    {
        /*
        print_r($this->request->getFiles());
        die();
       
        if($this->request->getFile('image_name')->isValid()){
            dd($this->request->getFile('image_name'));
        } else {
            dd('Erro');
        }

 */
        $arquivo = $this->request->getFile('image_name');
        $arquivo_nome = $arquivo->getName('image_name');

        //dd($arquivo->getClientName());
        //dd($arquivo->getName()); nome original do arquivo

        //MOVE PARA O DIRETORIO RAIZ DA APLICACAO, NA PASTA imagens
        //$arquivo->move('imagens');

        //MOVE PARA O DIRETORIO writable, NA PASTA imagens
        //$arquivo->move(WRITEPATH . 'imagens');

        //MOVE PARA O DIRETORIO writable, NA PASTA uploads/imagens
        //$arquivo->move(WRITEPATH . 'uploads/imagens');

        //MOVE PARA O DIRETORIO writable, NA PASTA imagens
        //$arquivo->move(WRITEPATH . 'public/imagens');

        //MOVE PARA O DIRETORIO public, NA PASTA imagens
        //$arquivo->move('public/imagens');

        //MOVE PARA O DIRETORIO raiz, NA PASTA public/imagens
        //$arquivo->move(ROOTPATH . 'public/imagens');

        //criando um nome único para o arquivo
        $nome_unico_imagem = uniqid() . '_' . $arquivo_nome;
        $nome_randomico = $arquivo->getRandomName();

        //MOVE PARA O DIRETORIO public, NA PASTA imagens, com o nome único
        $arquivo->move('public/imagens', $nome_unico_imagem);
       // $arquivo->move('public/imagens', $nome_randomico);


        $db = \Config\Database::connect();
        $sql = "INSERT INTO imagens (nome) VALUES ('$nome_unico_imagem')";
        $db->query($sql);


        return redirect()->to('');
    }
}
