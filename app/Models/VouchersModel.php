<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VouchersModel extends Model
{
    use HasFactory;

    protected $table = 'vouchers';

    static public function getAll(){
        return self::select('vouchers.*')->get();
    }
    static public function getAllClient(){
        return self::select('vouchers.*')->where('display_status','=',1)->get();
    }

    static public function getSingle($id){
        return self::find($id);
    }
}
