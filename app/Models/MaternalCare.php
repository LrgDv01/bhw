<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaternalCare extends Model
{
    use HasFactory;

    protected $table = 'maternal_cares';
    protected $fillable = [
        'serial_no',
        'full_name',
        'address',
        'se_status',
        'age',
        'lmp',
        'edc',
        'first_tri',
        'second_tri',
        'third_tri',
        'td1',
        'td2',
        'td3',
        'td4',
        'td5',
        'iron_visit1',
        'iron_tablets_1',
        'iron_visit2',
        'iron_tablets_2',
        'iron_visit3',
        'iron_tablets_3',
        'iron_visit4',
        'iron_tablets_4',
        'cal_visit2',
        'cal_tablets_2',
        'cal_visit3',
        'cal_tablets_3',
        'cal_visit4',
        'cal_tablets_4',
        'iodine_visit1',
        'bmi',
        'deworming_tablet',
        'syph',
        'hepa',
        'hiv',
        'rpr_or_rdt',
        'hbsag',
    ];

}
