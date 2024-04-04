<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Imagens extends Seeder
{
    public function run()
    {
        $imagens = [
            [

                'nome' => 'imagem1.jpg',
            ],
            [

                'nome' => 'imagem2.jpg',
            ],
            [

                'nome' => 'imagem3.jpg',
            ],
            [

                'nome' => 'imagem4.jpg',
            ],  
        ];

        $this->db->table('imagens')->insertBatch($imagens);
    }
}
