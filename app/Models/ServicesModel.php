<?php

namespace App\Models;

use App\Models\User;
use App\Models\Farm\FarmModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesModel extends Model
{
    use HasFactory;
    
    public $table = "services";
    protected $fillable = [
        'user_id',
        'technician_id',
        'farmer_name',
        'request_id',
        'status',
    ];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function farms()
    {
        return $this->belongsTo(FarmModel::class, 'user_id', 'user_id');
    }

    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_DECLINED = 'declined';

    // Accessor for formatted status
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case self::STATUS_ACCEPTED:
                return 'Accepted';
            case self::STATUS_DECLINED:
                return 'Declined';
            case self::STATUS_PENDING:
                return 'Pending';
            default:
                return 'Pending'; 
        }
    }

    public function userFarms() {
        return $this->hasMany(FarmModel::class, 'user_id', 'user_id');
    }

}
