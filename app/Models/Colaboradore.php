<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Colaboradore extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'colaboradores';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        'Ativo'   => 'Ativo',
        'Inativo' => 'Inativo',
    ];

    protected $fillable = [
        'nome',
        'cpf',
        'genero_id',
        'telefone',
        'email',
        'formacao_id',
        'cargo_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function genero()
    {
        return $this->belongsTo(Identidadegenero::class, 'genero_id');
    }

    public function formacao()
    {
        return $this->belongsTo(Formacao::class, 'formacao_id');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class);
    }
}
