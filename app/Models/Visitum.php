<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Visitum extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'visita';

    protected $dates = [
        'dataagendamento',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'motivo',
        'dataagendamento',
        'relatorio_observado',
        'status_visita_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const MOTIVO_SELECT = [
        'Inspeção Programada (rotina)' => 'Inspeção Programada (rotina)',
        'Orientação de Licenciamento'  => 'Orientação de Licenciamento',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function estabelecimentos()
    {
        return $this->belongsToMany(Estabelecimento::class);
    }

    public function getDataagendamentoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDataagendamentoAttribute($value)
    {
        $this->attributes['dataagendamento'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function equipes()
    {
        return $this->belongsToMany(Colaboradore::class);
    }

    public function status_visita()
    {
        return $this->belongsTo(Status::class, 'status_visita_id');
    }
}
