<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Document;

class Shared extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'userId', 'id');
    }

    public function document()
    {
        return $this->belongsTo('App\Document', 'documentId', 'id');
    }
}
