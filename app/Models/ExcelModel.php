<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelModel extends Model
{
    use HasFactory;

    protected $table = 'excel';
    public $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'id',
        'no_polisi',
        'no_hp',
        'tgl_akhir_pkb',
        'njkb',
    ];
}
