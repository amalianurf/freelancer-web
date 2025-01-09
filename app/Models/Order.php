<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'freelancer_id',
        'client_id',
        'service_id',
        'file',
        'note',
        'expired',
        'status_order_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // one to many
    public function client_user()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function freelancer_user()
    {
        return $this->belongsTo(User::class, 'freelancer_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function status_order()
    {
        return $this->belongsTo(StatusOrder::class, 'status_order_id', 'id');
    }
}
