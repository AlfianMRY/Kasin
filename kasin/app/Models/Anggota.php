<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $guarded = ['id'];

    public function absen() {
        return $this->belongsTo(Absen::class);
    }
    public function kas() {
        return $this->belongsTo(Kas::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
