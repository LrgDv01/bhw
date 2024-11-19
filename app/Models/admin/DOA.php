<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DOA extends Model
{
    use HasFactory;

    protected $table = 'pca';
    protected $fillable = [
        'municipality',
        'District',
        'total_cost',
    ];

}
