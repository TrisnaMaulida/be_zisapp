<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CobaEnkripsi extends Controller
{
    //hash untuk pengamanan password
    public function hash()
    {
        $hash_password_saya = Hash::make('halo123');
        echo $hash_password_saya;
    }
}
