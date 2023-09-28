<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'identifier',
        'default_version_id',
        'description',
        'is_public',
        'parent_id'
    ];

    public function version()
    {
        return $this->belongsTo(Version::class, 'default_version_id', 'id');
    }
}
