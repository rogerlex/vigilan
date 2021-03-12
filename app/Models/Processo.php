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
        'anexos',
    ];

    protected $dates = [
        'inicio',
        'fim',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tipoprocesso_id',
        'inicio',
        'fim',
        'solicitante',
        'emailprocesso',
        'descricao',
        'tipoestabelecimento_id',
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
        return $this->belongsTo(TipoProcesso::class, 'tipoprocesso_id');
    }

    public function getInicioAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setInicioAttribute($value)
    {
        $this->attributes['inicio'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFimAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFimAttribute($value)
    {
        $this->attributes['fim'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function tipoestabelecimento()
    {
        return $this->belongsTo(TipoEstabelecimento::class, 'tipoestabelecimento_id');
    }

    public function getAnexosAttribute()
    {
        $files = $this->getMedia('anexos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }
}
