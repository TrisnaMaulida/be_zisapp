<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $date = ['tgl_donasi', 'timestamp'];
    protected $primarykey = ['id_donasi', 'id_detaildonasi'];
}
