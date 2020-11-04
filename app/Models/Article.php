<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasFactory;
    use HasSlug;

    protected $casts = [
        'is_published' => 'boolean'
    ];

    public function author() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
        
    public function getLeadAttribute() {
        $data = Str::words($this->description, 30);
        $data = Strip_tags($data);
        return $data;
    }
    
    public function getCreateTimeAttribute() {
        return $this->created_at->format('M d, Y');
    }

    public function getLastUpdateAttribute() {
        return $this->updated_at->format('M d, Y');
    }

    public function getStatusAttribute() {
        return $this->is_published ? 'Published' : 'Drafted';
    }

    public function getSlugOptions() : SlugOptions {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}