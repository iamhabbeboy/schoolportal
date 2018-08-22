<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    protected $table = 'grades';

    public function allSubject()
    {
        return $this->whereNotNull('name')->orderBy('id', 'desc');
    }
}
