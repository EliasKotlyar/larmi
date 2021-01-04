<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}