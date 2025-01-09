<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvantageService extends Model
{
    use SoftDeletes;

    public $table = 'advantage_service';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'service_id',
        'advantage',
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
