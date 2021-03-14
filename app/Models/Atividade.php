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

class Atividade extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'atividades';

    protected $dates = [
        'data_atividade',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'numeroprocesso_id',
        'vista_num_processo',
        'tipo_de_processo_id',
        'relatorio_da_atividade',
        'status_id',
        'data_atividade',
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

    public function numeroprocesso()
    {
        return $this->belongsTo(Processo::class, 'numeroprocesso_id');
    }

    public function tipo_de_processo()
    {
        return $this->belongsTo(TiposProcesso::class, 'tipo_de_processo_id');
    }

    public function equipe_responsavels()
    {
        return $this->belongsToMany(Colaboradore::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function getDataAtividadeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDataAtividadeAttribute($value)
    {
        $this->attributes['data_atividade'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
