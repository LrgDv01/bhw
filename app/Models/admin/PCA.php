<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PCA extends Model
{
    use HasFactory;

    protected $table = 'pca';
    protected $fillable = [
        'coco_seed',
        'fertilizer',
        'total_cost',
    ];
}
