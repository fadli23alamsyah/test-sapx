<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
    ];

    public function pinjams() {
        return $this->hasMany(Pinjam::class, "book_id");
    }
}
