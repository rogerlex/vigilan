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
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'cadastro_access',
            ],
            [
                'id'    => 18,
                'title' => 'categorium_create',
            ],
            [
                'id'    => 19,
                'title' => 'categorium_edit',
            ],
            [
                'id'    => 20,
                'title' => 'categorium_delete',
            ],
            [
                'id'    => 21,
                'title' => 'categorium_access',
            ],
            [
                'id'    => 22,
                'title' => 'tag_create',
            ],
            [
                'id'    => 23,
                'title' => 'tag_edit',
            ],
            [
                'id'    => 24,
                'title' => 'tag_delete',
            ],
            [
                'id'    => 25,
                'title' => 'tag_access',
            ],
            [
                'id'    => 26,
                'title' => 'bairro_create',
            ],
            [
                'id'    => 27,
                'title' => 'bairro_edit',
            ],
            [
                'id'    => 28,
                'title' => 'bairro_show',
            ],
            [
                'id'    => 29,
                'title' => 'bairro_delete',
            ],
            [
                'id'    => 30,
                'title' => 'bairro_access',
            ],
            [
                'id'    => 31,
                'title' => 'tipoestabelecimento_create',
            ],
            [
                'id'    => 32,
                'title' => 'tipoestabelecimento_edit',
            ],
            [
                'id'    => 33,
                'title' => 'tipoestabelecimento_show',
            ],
            [
                'id'    => 34,
                'title' => 'tipoestabelecimento_delete',
            ],
            [
                'id'    => 35,
                'title' => 'tipoestabelecimento_access',
            ],
            [
                'id'    => 36,
                'title' => 'tipos_processo_create',
            ],
            [
                'id'    => 37,
                'title' => 'tipos_processo_edit',
            ],
            [
                'id'    => 38,
                'title' => 'tipos_processo_show',
            ],
            [
                'id'    => 39,
                'title' => 'tipos_processo_delete',
            ],
            [
                'id'    => 40,
                'title' => 'tipos_processo_access',
            ],
            [
                'id'    => 41,
                'title' => 'reg_denuncium_create',
            ],
            [
                'id'    => 42,
                'title' => 'reg_denuncium_edit',
            ],
            [
                'id'    => 43,
                'title' => 'reg_denuncium_show',
            ],
            [
                'id'    => 44,
                'title' => 'reg_denuncium_delete',
            ],
            [
                'id'    => 45,
                'title' => 'reg_denuncium_access',
            ],
            [
                'id'    => 46,
                'title' => 'status_create',
            ],
            [
                'id'    => 47,
                'title' => 'status_edit',
            ],
            [
                'id'    => 48,
                'title' => 'status_show',
            ],
            [
                'id'    => 49,
                'title' => 'status_delete',
            ],
            [
                'id'    => 50,
                'title' => 'status_access',
            ],
            [
                'id'    => 51,
                'title' => 'origen_create',
            ],
            [
                'id'    => 52,
                'title' => 'origen_edit',
            ],
            [
                'id'    => 53,
                'title' => 'origen_delete',
            ],
            [
                'id'    => 54,
                'title' => 'origen_access',
            ],
            [
                'id'    => 55,
                'title' => 'processo_create',
            ],
            [
                'id'    => 56,
                'title' => 'processo_edit',
            ],
            [
                'id'    => 57,
                'title' => 'processo_show',
            ],
            [
                'id'    => 58,
                'title' => 'processo_delete',
            ],
            [
                'id'    => 59,
                'title' => 'processo_access',
            ],
            [
                'id'    => 60,
                'title' => 'estabelecimento_create',
            ],
            [
                'id'    => 61,
                'title' => 'estabelecimento_edit',
            ],
            [
                'id'    => 62,
                'title' => 'estabelecimento_show',
            ],
            [
                'id'    => 63,
                'title' => 'estabelecimento_delete',
            ],
            [
                'id'    => 64,
                'title' => 'estabelecimento_access',
            ],
            [
                'id'    => 65,
                'title' => 'formacao_create',
            ],
            [
                'id'    => 66,
                'title' => 'formacao_edit',
            ],
            [
                'id'    => 67,
                'title' => 'formacao_show',
            ],
            [
                'id'    => 68,
                'title' => 'formacao_delete',
            ],
            [
                'id'    => 69,
                'title' => 'formacao_access',
            ],
            [
                'id'    => 70,
                'title' => 'cargo_create',
            ],
            [
                'id'    => 71,
                'title' => 'cargo_edit',
            ],
            [
                'id'    => 72,
                'title' => 'cargo_show',
            ],
            [
                'id'    => 73,
                'title' => 'cargo_delete',
            ],
            [
                'id'    => 74,
                'title' => 'cargo_access',
            ],
            [
                'id'    => 75,
                'title' => 'colaboradore_create',
            ],
            [
                'id'    => 76,
                'title' => 'colaboradore_edit',
            ],
            [
                'id'    => 77,
                'title' => 'colaboradore_show',
            ],
            [
                'id'    => 78,
                'title' => 'colaboradore_delete',
            ],
            [
                'id'    => 79,
                'title' => 'colaboradore_access',
            ],
            [
                'id'    => 80,
                'title' => 'identidadegenero_create',
            ],
            [
                'id'    => 81,
                'title' => 'identidadegenero_edit',
            ],
            [
                'id'    => 82,
                'title' => 'identidadegenero_show',
            ],
            [
                'id'    => 83,
                'title' => 'identidadegenero_delete',
            ],
            [
                'id'    => 84,
                'title' => 'identidadegenero_access',
            ],
            [
                'id'    => 85,
                'title' => 'departamento_create',
            ],
            [
                'id'    => 86,
                'title' => 'departamento_edit',
            ],
            [
                'id'    => 87,
                'title' => 'departamento_show',
            ],
            [
                'id'    => 88,
                'title' => 'departamento_delete',
            ],
            [
                'id'    => 89,
                'title' => 'departamento_access',
            ],
            [
                'id'    => 90,
                'title' => 'atividade_create',
            ],
            [
                'id'    => 91,
                'title' => 'atividade_edit',
            ],
            [
                'id'    => 92,
                'title' => 'atividade_show',
            ],
            [
                'id'    => 93,
                'title' => 'atividade_delete',
            ],
            [
                'id'    => 94,
                'title' => 'atividade_access',
            ],
            [
                'id'    => 95,
                'title' => 'visitum_create',
            ],
            [
                'id'    => 96,
                'title' => 'visitum_edit',
            ],
            [
                'id'    => 97,
                'title' => 'visitum_show',
            ],
            [
                'id'    => 98,
                'title' => 'visitum_delete',
            ],
            [
                'id'    => 99,
                'title' => 'visitum_access',
            ],
            [
                'id'    => 100,
                'title' => 'pendencium_create',
            ],
            [
                'id'    => 101,
                'title' => 'pendencium_edit',
            ],
            [
                'id'    => 102,
                'title' => 'pendencium_show',
            ],
            [
                'id'    => 103,
                'title' => 'pendencium_delete',
            ],
            [
                'id'    => 104,
                'title' => 'pendencium_access',
            ],
            [
                'id'    => 105,
                'title' => 'baixaduam_create',
            ],
            [
                'id'    => 106,
                'title' => 'baixaduam_edit',
            ],
            [
                'id'    => 107,
                'title' => 'baixaduam_show',
            ],
            [
                'id'    => 108,
                'title' => 'baixaduam_delete',
            ],
            [
                'id'    => 109,
                'title' => 'baixaduam_access',
            ],
            [
                'id'    => 110,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
