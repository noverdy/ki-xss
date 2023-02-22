<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function visibility()
    {
        if ($this->visibility === 0) return 'Public';
        if ($this->visibility === 1) return 'Unlisted';
        return 'Private';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
