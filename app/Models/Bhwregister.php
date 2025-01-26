<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bhwregister extends Model
{
    use HasFactory;

    protected $table = "bhwregisters";
    protected $fillable = [
        'bhw_id',
        'cover_type',
        'catchment_area',
        'accreditation_count',
        'household_covered',   
        'accreditation_date',
        'service_start_date',
        'date_of_registration',
   
    ];

    public function user() {
        return $this->belongsTo(User::class, 'bhw_id');
    }

}
