<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'duty_id', 'type','status'
    ];
    const MANAGE_TYPE = [1, 2];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @name:records
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function records() {
        return $this->hasMany(Record::class);
    }

    /**
     * @name:versions 我加入的项目（针对版本）
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function versions() {
        return $this->hasMany(Version::class);
    }

    /**
     * @name:duty
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function duty() {
        return $this->hasOne(Duty::class, 'id', 'duty_id');
    }

    /**
     * @name:projects 我管理的项目
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function projects() {
        return $this->hasMany(Project::class);
    }


    public function scopeActiveStatus($query) {
        $query->whereStatus(1);
    }
}
