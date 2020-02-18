<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    protected $fillable = ['text_question', 'text_answer', 'status_view', 'user_id','center_type'];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
