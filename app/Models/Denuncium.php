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

class Denuncium extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'denuncia';

    protected $appends = [
        'photo',
    ];

    const STATUS_SELECT = [
        'Aberta'    => 'Aberta',
        'Cancelada' => 'Cancelada',
        'Concluida' => 'Concluída',
    ];

    protected $dates = [
        'data_denuncia',
        'data_conclusao',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'data_denuncia',
        'denunciante',
        'contato_denunciante',
        'description',
        'tratativa',
        'status',
        'data_conclusao',
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

    public function categories()
    {
        return $this->belongsToMany(Denunciacategorium::class);
    }

    public function tags()
    {
        return $this->belongsToMany(TagsDenuncium::class);
    }

    public function getPhotoAttribute()
    {
        $files = $this->getMedia('photo');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function getDataConclusaoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDataConclusaoAttribute($value)
    {
        $this->attributes['data_conclusao'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
