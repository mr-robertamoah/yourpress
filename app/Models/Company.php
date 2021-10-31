<?php

namespace App\Models;

use App\Traits\AddProductTrait;
use App\Traits\AddSizeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory,
        AddProductTrait,
        AddSizeTrait;

    protected $fillable = [
        'name',
        'description',
        'location',
        'user_id',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admins()
    {
        return $this->morphMany(Admin::class, 'adminable');
    }

    public function isOwnedBy($user)
    {
        return $this->user->is($user);
    }

    public function hasUserAsAdmin($user)
    {
        return $this->admins()
            ->where('adminable_type', $user::class)
            ->where('adminable_id', $user->id)
            ->exists();
    }
}
