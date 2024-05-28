<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

// az image modell osztaly, amely a HasMedia interfeszt importalja
class Image extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'type'
    ];
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('kicsi') // itt hozzaadunk egy uj media conversiont, hogy a kis kepeket tudjuk megjeleniteni
            ->fit(Manipulations::FIT_CROP, 320, 320)
            ->nonQueued();
    }
}
