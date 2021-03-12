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
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'gerenc_estabelecimento_access',
            ],
            [
                'id'    => 20,
                'title' => 'bairro_create',
            ],
            [
                'id'    => 21,
                'title' => 'bairro_edit',
            ],
            [
                'id'    => 22,
                'title' => 'bairro_show',
            ],
            [
                'id'    => 23,
                'title' => 'bairro_delete',
            ],
            [
                'id'    => 24,
                'title' => 'bairro_access',
            ],
            [
                'id'    => 25,
                'title' => 'gerenciamento_denuncium_access',
            ],
            [
                'id'    => 26,
                'title' => 'denunciacategorium_create',
            ],
            [
                'id'    => 27,
                'title' => 'denunciacategorium_edit',
            ],
            [
                'id'    => 28,
                'title' => 'denunciacategorium_show',
            ],
            [
                'id'    => 29,
                'title' => 'denunciacategorium_delete',
            ],
            [
                'id'    => 30,
                'title' => 'denunciacategorium_access',
            ],
            [
                'id'    => 31,
                'title' => 'tags_denuncium_create',
            ],
            [
                'id'    => 32,
                'title' => 'tags_denuncium_edit',
            ],
            [
                'id'    => 33,
                'title' => 'tags_denuncium_show',
            ],
            [
                'id'    => 34,
                'title' => 'tags_denuncium_delete',
            ],
            [
                'id'    => 35,
                'title' => 'tags_denuncium_access',
            ],
            [
                'id'    => 36,
                'title' => 'denuncium_create',
            ],
            [
                'id'    => 37,
                'title' => 'denuncium_edit',
            ],
            [
                'id'    => 38,
                'title' => 'denuncium_show',
            ],
            [
                'id'    => 39,
                'title' => 'denuncium_delete',
            ],
            [
                'id'    => 40,
                'title' => 'denuncium_access',
            ],
            [
                'id'    => 41,
                'title' => 'estabelecimento_create',
            ],
            [
                'id'    => 42,
                'title' => 'estabelecimento_edit',
            ],
            [
                'id'    => 43,
                'title' => 'estabelecimento_show',
            ],
            [
                'id'    => 44,
                'title' => 'estabelecimento_delete',
            ],
            [
                'id'    => 45,
                'title' => 'estabelecimento_access',
            ],
            [
                'id'    => 46,
                'title' => 'ger_processo_access',
            ],
            [
                'id'    => 47,
                'title' => 'tipo_processo_create',
            ],
            [
                'id'    => 48,
                'title' => 'tipo_processo_edit',
            ],
            [
                'id'    => 49,
                'title' => 'tipo_processo_show',
            ],
            [
                'id'    => 50,
                'title' => 'tipo_processo_delete',
            ],
            [
                'id'    => 51,
                'title' => 'tipo_processo_access',
            ],
            [
                'id'    => 52,
                'title' => 'tagprocesso_create',
            ],
            [
                'id'    => 53,
                'title' => 'tagprocesso_edit',
            ],
            [
                'id'    => 54,
                'title' => 'tagprocesso_show',
            ],
            [
                'id'    => 55,
                'title' => 'tagprocesso_delete',
            ],
            [
                'id'    => 56,
                'title' => 'tagprocesso_access',
            ],
            [
                'id'    => 57,
                'title' => 'tipo_estabelecimento_create',
            ],
            [
                'id'    => 58,
                'title' => 'tipo_estabelecimento_edit',
            ],
            [
                'id'    => 59,
                'title' => 'tipo_estabelecimento_show',
            ],
            [
                'id'    => 60,
                'title' => 'tipo_estabelecimento_delete',
            ],
            [
                'id'    => 61,
                'title' => 'tipo_estabelecimento_access',
            ],
            [
                'id'    => 62,
                'title' => 'processo_create',
            ],
            [
                'id'    => 63,
                'title' => 'processo_edit',
            ],
            [
                'id'    => 64,
                'title' => 'processo_show',
            ],
            [
                'id'    => 65,
                'title' => 'processo_delete',
            ],
            [
                'id'    => 66,
                'title' => 'processo_access',
            ],
            [
                'id'    => 67,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 68,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 69,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 70,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 71,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 72,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 73,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 74,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 75,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 76,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 77,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 78,
                'title' => 'task_create',
            ],
            [
                'id'    => 79,
                'title' => 'task_edit',
            ],
            [
                'id'    => 80,
                'title' => 'task_show',
            ],
            [
                'id'    => 81,
                'title' => 'task_delete',
            ],
            [
                'id'    => 82,
                'title' => 'task_access',
            ],
            [
                'id'    => 83,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 84,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
