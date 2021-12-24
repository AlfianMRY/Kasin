<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $guarded = ['id'];
    // protected $fillable = ['nama','tgl-lahir','jk'];

    public function absen() {
        return $this->hasMany(Absen::class);
    }
    /**
     * Get all of the comments for the Anggota
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kas()
    {
        return $this->hasMany(Kas::class, 'anggota_id', 'id');
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
