<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    public $table = 'services';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'delivery_time',
        'revision_limit',
        'price',
        'note',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // one to many
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function advantage_service()
    {
        return $this->hasMany(AdvantageService::class, 'service_id', 'id');
    }

    public function advantage_user()
    {
        return $this->hasMany(AdvantageUser::class, 'service_id', 'id');
    }

    public function thumbnail()
    {
        return $this->hasMany(Thumbnail::class, 'service_id', 'id');
    }

    public function tagline()
    {
        return $this->hasMany(Tagline::class, 'service_id', 'id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'service_id', 'id');
    }
}
