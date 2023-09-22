<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentUser extends Model
{
    use HasFactory;

    protected $table = 'comments_users';
    protected $fillable = ['id_annonce', 'id_commenter', 'note', 'comment', 'likes','role','id_demande'];
}
