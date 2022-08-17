<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;


class  User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, Sortable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'birth_date',
        'sex',
        'icon',
        'password',
        'email_verified_at',
    ];

    public $sortable = [
        'name',
        'email',
        'birth_date',
        'sex',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getGenderAttribute() {
        return strtolower(Gender::getKey($this->sex));
    }
}
