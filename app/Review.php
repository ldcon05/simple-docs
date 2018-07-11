<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Document;

class Review extends Model
{
    public function document()
    {
        return $this->belongsTo('App\Document', 'documentId', 'id');
    }
}
