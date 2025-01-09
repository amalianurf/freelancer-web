<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusOrder extends Model
{
    use SoftDeletes;

    public $table = 'status_order';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // one to many
    public function order()
    {
        return $this->hasMany(Order::class, 'status_order_id', 'id');
    }
}
