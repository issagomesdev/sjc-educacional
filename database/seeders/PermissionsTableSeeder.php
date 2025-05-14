<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [

                'title' => 'almoxarifado_access',
            ],
            [

                'title' => 'fornecedore_create',
            ],
            [

                'title' => 'fornecedore_edit',
            ],
            [

                'title' => 'fornecedore_show',
            ],
            [

                'title' => 'fornecedore_delete',
            ],
            [

                'title' => 'fornecedore_access',
            ],
            [

                'title' => 'cadastros_do_almoxarifado_access',
            ],
            [

                'title' => 'categorias_de_produto_create',
            ],
            [

                'title' => 'categorias_de_produto_edit',
            ],
            [

                'title' => 'categorias_de_produto_show',
            ],
            [

                'title' => 'categorias_de_produto_delete',
            ],
            [

                'title' => 'categorias_de_produto_access',
            ],
            [

                'title' => 'produto_create',
            ],
            [

                'title' => 'produto_edit',
            ],
            [

                'title' => 'produto_show',
            ],
            [

                'title' => 'produto_delete',
            ],
            [

                'title' => 'produto_access',
            ],
            [

                'title' => 'requisitante_create',
            ],
            [

                'title' => 'requisitante_edit',
            ],
            [

                'title' => 'requisitante_show',
            ],
            [

                'title' => 'requisitante_delete',
            ],
            [

                'title' => 'requisitante_access',
            ],
            [

                'title' => 'estoque_create',
            ],
            [

                'title' => 'estoque_edit',
            ],
            [

                'title' => 'estoque_show',
            ],
            [

                'title' => 'estoque_delete',
            ],
            [

                'title' => 'estoque_access',
            ],
            [

                'title' => 'movimentacao_do_estoque_access',
            ],
            [

                'title' => 'entrada_no_estoque_create',
            ],
            [

                'title' => 'entrada_no_estoque_edit',
            ],
            [

                'title' => 'entrada_no_estoque_show',
            ],
            [

                'title' => 'entrada_no_estoque_delete',
            ],
            [

                'title' => 'entrada_no_estoque_access',
            ],
            [

                'title' => 'saida_no_estoque_create',
            ],
            [

                'title' => 'saida_no_estoque_edit',
            ],
            [

                'title' => 'saida_no_estoque_show',
            ],
            [

                'title' => 'saida_no_estoque_delete',
            ],
            [

                'title' => 'saida_no_estoque_access',
            ],
            [

                'title' => 'requisico_create',
            ],
            [

                'title' => 'requisico_edit',
            ],
            [

                'title' => 'requisico_show',
            ],
            [

                'title' => 'requisico_delete',
            ],
            [

                'title' => 'requisico_access',
            ],
            [

                'title' => 'pedidos_de_compra_create',
            ],
            [

                'title' => 'pedidos_de_compra_edit',
            ],
            [

                'title' => 'pedidos_de_compra_show',
            ],
            [

                'title' => 'pedidos_de_compra_delete',
            ],
            [

                'title' => 'pedidos_de_compra_access',
            ],
            [

                'title' => 'relatorios_do_almoxarifado_access',
            ],
            [

                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
