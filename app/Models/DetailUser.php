<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailUser extends Model
{
    use SoftDeletes;

    public $table = 'detail_user';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'user_id',
        'photo',
        'role',
        'contact_number',
        'biography',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // one to one 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // one to many
    public function experience_user()
    {
        return $this->hasMany(ExperienceUser::class, 'detail_user_id', 'id');
    }
}
