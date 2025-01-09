<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thumbnail extends Model
{
    use SoftDeletes;

    public $table = 'thumbnail';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'service_id',
        'thumbnail',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // one to many
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
