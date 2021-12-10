<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $table = 'absen';
    protected $guarded = ['id'];

    /**
     * Get all of the anggota for the Absen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function anggota()
    {
        return $this->hasMany(anggota::class);
    }
}
