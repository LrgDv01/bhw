<?php

namespace Database\Seeders;

use App\Models\ModuleAccessDetails;
use App\Models\ModuleAccessModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class module_access extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        $moduleAccessOptions = [
            ['code' => 1, 'name' => 'Dashboard', 'description' => 'Display the data in the system.'],
            ['code' => 1000, 'name' => 'User Management', 'description' => 'Manage user accounts and permissions.'],
            ['code' => 2001, 'name' => 'Reports', 'description' => 'Manage applications and reports.'],
            // ['code' => 1001, 'name' => 'Visitation Request', 'description' => 'Manage visitation requests for users.'],
            // ['code' => 1002, 'name' => 'Schedule', 'description' => 'Manage schedules and appointments.'],
            // ['code' => 1003, 'name' => 'Jail Library', 'description' => 'Manage library resources for inmates.'],
            // ['code' => 1004, 'name' => 'Video Call', 'description' => 'Manage video call sessions for users.'],
            ['code' => 1005, 'name' => 'Announcement', 'description' => 'Manage announcements and notifications.'],
            ['code' => 1006, 'name' => 'Audit Trail', 'description' => 'View and manage system audit logs.'],
            ['code' => 1007, 'name' => 'Settings', 'description' => 'Manage application settings and configurations.'],
            // ['code' => 1008, 'name' => 'Feedback', 'description' => 'View visitor feedback'],
            ['code' => 2000, 'name' => 'QR Scanner', 'description' => 'Tool for scanning the custom qr code.'],
        ];
        foreach ($moduleAccessOptions as $option) {
            ModuleAccessDetails::create([
                'code' => $option['code'],
                'name' => $option['name'],
                'description' => $option['description'],
            ]);
        }
    }
    public function down(): void
    {
        // You can optionally delete all records in ModuleAccessModel here
        // Example: ModuleAccessModel::truncate();
    }
}
