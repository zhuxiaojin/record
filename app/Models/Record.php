<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'project_id', 'version_id', 'current_time', 'body', 'step_id', 'work_time'];
    /**
     * @var array
     */
    protected $dates = ['current_time'];


    /**
     * @name:project
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function project() {
     return   $this->belongsTo(Project::class);
    }

    /**
     * @name:version
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function version() {
        return    $this->belongsTo(Version::class);
    }

    /**
     * @name:user
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function user() {
        return   $this->belongsTo(User::class);
    }

    /**
     * @name:step
     * @author:Storm 朱晓进 <qhj1989@qq.com>
     */
    public function step() {
        return   $this->belongsTo(Step::class);
    }
}
