<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    public function findById(int $id = 0)
    {
        if( $id == 0) {
            return 'N/A';
        }
        return $this->where('state_id', $id)->first()->name;
    }
}
