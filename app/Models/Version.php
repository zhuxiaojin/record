<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    //
    /**
     * @var array
     */
    protected $fillable = ['project_id', 'user_id', 'name', 'body', 'end_time', 'is_end'];
    protected $dates = ['end_time'];

    public function scopeEnd($query) {
        $query->where('end_time', '<=', Carbon::now())->where('is_end', 0);
    }

    public function scopeActive($query) {
        $query->where('end_time', '>', Carbon::now())->where('is_end', 0);
    }

    public function scopeNotClose($query) {
        $query->where('is_end',0);
    }

    /**
     * @name:project
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function project() {
        return $this->belongsTo(Project::class);
    }

    /**
     * @name:records
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function records() {
        return $this->hasMany(Record::class);
    }

    /**
     * @name:user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

}
