<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_path'
    ];

    /**
     * Get the comments for the blog post.
     */
    public function slides()
    {
        return $this->hasMany(Slide::class);
    }

    public function slidesCount()
    {
        return count($this->slides);
    }

    public function getPath()
    {
        return Storage::path($this->file_path);
    }

    public function getUrl(){
        return route('admonitor/show', ['file' => $this->id]);
    }

}
