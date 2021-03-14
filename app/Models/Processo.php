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

class Processo extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'processos';

    protected $appends = [
        'anexo_processo',
    ];

    protected $dates = [
        'inicio_processo',
        'final_processo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'numero_do_processo',
        'tipoprocesso_id',
        'inicio_processo',
        'final_processo',
        'solicitante',
        'email',
        'descricao',
        'status_processo_id',
        'created_at',
        'updated_at',
        'deleted_at',
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

    public function tipoprocesso()
    {
        return $this->belongsTo(TiposProcesso::class, 'tipoprocesso_id');
    }

    public function getInicioProcessoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setInicioProcessoAttribute($value)
    {
        $this->attributes['inicio_processo'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFinalProcessoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFinalProcessoAttribute($value)
    {
        $this->attributes['final_processo'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getAnexoProcessoAttribute()
    {
        return $this->getMedia('anexo_processo');
    }

    public function estabelecimentos()
    {
        return $this->belongsToMany(Estabelecimento::class);
    }

    public function status_processo()
    {
        return $this->belongsTo(Status::class, 'status_processo_id');
    }
}
