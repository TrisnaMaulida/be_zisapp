<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $date = ['tgl_donasi', 'timestamp'];
    protected $primarykey = ['no_donasi', 'id_detaildonasi'];
}
