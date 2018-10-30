<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = ['name', 'body', 'img', 'user_id'];

    /**
     * @name:versions 项目的版本信息
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function versions() {
        return $this->hasMany(Version::class);
    }
    /**
     * @name:records 该项目下所有的日志信息
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function records() {
        return $this->hasMany(Record::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
