<?php

namespace App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    protected $table = 'panels';

    public function auth(String $email, String $password)
    {
        $panel      = Panel::where('email', $email)->first();

        if( ! $panel ) {
            return [];
        }
        $password   = Hash::check($password, $panel->password);

        if(  $password == false ) {
            return [];
        }
        return ['status' => 'success'];
    }
}
