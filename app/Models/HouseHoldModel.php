<?php

namespace App\Models;

use App\Models\FamilyMemberModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseHoldModel extends Model
{
    use HasFactory;
        
    protected $table = 'households'; 
    protected $fillable = ['house_no', 'head_of_fam', 'toilet_facility', 'water_source'];

    public function familyMembers()
    {
        return $this->hasMany(FamilyMemberModel::class, 'household_id');
    }

}
