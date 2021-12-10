<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;
    protected $table = 'kas';
    protected $guarded = ['id'];

    /**
     * Get the anggota associated with the Kas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function anggota(): HasOne
    {
        return $this->hasOne(Anggota::class);
    }
}
