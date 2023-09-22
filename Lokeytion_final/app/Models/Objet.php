<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class objet extends Model
{
    use HasFactory;

    protected $table = 'objets';

    protected $fillable = ['id_user','nom','categorie','discription','image1','image2','image3'];
}
