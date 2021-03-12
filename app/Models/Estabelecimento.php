<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Estabelecimento extends Model
{
    use SoftDeletes, Auditable, HasFactory;

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
        'natureza',
        'tipo',
        'area',
        'atvprincipal',
        'atvsecundaria',
        'logradouro',
        'numero',
        'referencia',
        'bairro_id',
        'uf',
        'municipio',
        'responsavel',
        'foneresponsavel',
        'cpfresponsavel',
        'wattsapp',
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
