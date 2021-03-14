<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class RegDenuncium extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    public $table = 'reg_denuncia';

    protected $appends = [
        'imagens',
        'anexo',
    ];

    protected $dates = [
        'data_denuncia',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'data_denuncia',
        'denunciante',
        'contato',
        'descricao',
        'origem_id',
        'categoria_id',
        'status_id',
        'feedback',
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

    public function getDataDenunciaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDataDenunciaAttribute($value)
    {
        $this->attributes['data_denuncia'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function origem()
    {
        return $this->belongsTo(Tag::class, 'origem_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categorium::class, 'categoria_id');
    }

    public function getImagensAttribute()
    {
        $file = $this->getMedia('imagens')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getAnexoAttribute()
    {
        return $this->getMedia('anexo')->last();
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
