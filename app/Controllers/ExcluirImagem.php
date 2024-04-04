<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ExcluirImagem extends BaseController
{
    public function index($id)
    {
        $db = \Config\Database::connect();

        // SELECIONA O NOME DO ARQUIVO PARA EXCLUIR
        //$sql = "SELECT nome FROM imagens WHERE id = " . $id;
        $sql = "SELECT nome FROM imagens WHERE id = $id";

       // dd($sql);
        $query = $db->query($sql);
        $result = $query->getResult();
        $file = $result[0]->nome;
        //dd($file);

        // EXCLUIR ARQUIVO DA PASTA IMAGENS
        unlink('public/imagens/' . $file);

        // EXCLUIR DA TABELA IMAGENS

        $sql = "DELETE FROM imagens WHERE id = $id";
        $db->query($sql);

        return redirect()->to('');
    }
}
