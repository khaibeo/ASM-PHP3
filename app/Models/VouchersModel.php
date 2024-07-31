<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VouchersModel extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

    static public function getAll(){
        return self::all();
    }

    static public function getSingle($id){
        return self::find($id);
    }
}
