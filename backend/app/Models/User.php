<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Decorators\BaseUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = ['description'];

    public function getDescriptionAttribute()
    {
        $user = new BaseUser();
        $skills = ['PhpSkill', 'JsSkill', 'GolangSkill', 'JavaSkill'];
        $description = [];

        foreach ($skills as $skill) {
            if (rand(1, 2)) {
                $class = "App\\Decorators\\{$skill}";
                $user = new $class($user);
                $description[] = $skill;
            }
        }
        return $description;
    }
}
