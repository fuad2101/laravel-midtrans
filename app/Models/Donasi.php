<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function setStatusPending(){
        $this->attributes['status'] = 'Pending';
        self::save() ;
    }
    public function setStatusSuccess(){
        $this->attributes['status'] = 'Success';
        self::save() ;
    }
    public function setStatusSuccess(){
        $this->attributes['status'] = 'Failed';
        self::save() ;
    }
}
