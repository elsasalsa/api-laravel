<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory, HasUuids;
    //mendefinisikan bahwa id tdk auto increments
    public $incrementing = false;

    //fillable : menyimpan column yg bkl diisi bkn dari sistem -> kalo fillable harus ditulis satu2
    // guarded : menyimpan column yg bkal diisi dr sistem -> pnggil id nya aja
    protected $guarded = ['id'];

    // generate data id ketika menginput data baru
    protected static function booted() {
        // booted = const di oop
        static::creating(function($model) {
            $model->id = Str::uuid();
            // id -> sesuaikan dgn nama primary key masing2 yg ada dimigrations
        });
    }

    //tergantung versi laravel support : untuk boot() digunakan di laravel versi lama
    // public static function boot() {
    //     parent::boot();
    //     static::creating(function($model) {
    //         $model->id = Str::uuid();
    //     });
    // }
}
