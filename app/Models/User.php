<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class  User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, SoftDeletes, Sortable, InteractsWithMedia;
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

    protected $appends = ['media_image'];

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

    public function getMediaImageAttribute()
    {
        $image = $this->getFirstMediaUrl('user');
        if (!empty($image)) {
            return $image;
        }
        return '/images/user/default-avatar.png';
    }
}
