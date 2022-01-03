<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectLearning extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'video',
        'materi_untuk',
        'cover_materi',
        'link_streaming',
        'audio',
        'view',
    ];

    public function user(){
       return $this->belongsTo(User::class);
    }

}
