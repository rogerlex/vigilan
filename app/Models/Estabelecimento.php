<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Estabelecimento extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'estabelecimentos';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'cnpj',
        'razaosocial',
        'nomefantasia',
        'natureza_do_estabelecimento',
        'tipo',
        'area',
        'atividade_principal',
        'atividade_secundaria',
        'logradouro',
        'numero',
        'ponto_de_referencia',
        'bairro_id',
        'municipio',
        'uf',
        'responsavel_tecnico',
        'cpf',
        'contato',
        'email',
        'situacao',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function bairro()
    {
        return $this->belongsTo(Bairro::class, 'bairro_id');
    }
}
