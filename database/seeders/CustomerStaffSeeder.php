<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerStaffSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $customers = [
                ['full_name' => 'Maya Santos', 'email' => 'maya.santos@example.com', 'phone' => '+63 917 321 8042'],
                ['full_name' => 'Carlo Reyes', 'email' => 'carlo.reyes@example.com', 'phone' => '+63 918 442 1190'],
                ['full_name' => 'Alyssa Lim', 'email' => 'alyssa.lim@example.com', 'phone' => '+63 905 667 2301'],
                ['full_name' => 'Nathan Cruz', 'email' => 'nathan.cruz@example.com', 'phone' => '+63 956 108 7745'],
                ['full_name' => 'Bianca Flores', 'email' => 'bianca.flores@example.com', 'phone' => '+63 927 509 3826'],
                ['full_name' => 'Luis Mendoza', 'email' => 'luis.mendoza@example.com', 'phone' => '+63 939 884 0163'],
            ];

            foreach ($customers as $customer) {
                Customer::firstOrCreate(['email' => $customer['email']], $customer);
            }

            $users = [
                ['username' => 'admin.mia', 'full_name' => 'Mia Villanueva', 'created_at' => '2026-07-12 09:00:00'],
                ['username' => 'cashier.jules', 'full_name' => 'Jules Navarro', 'created_at' => '2026-07-18 09:00:00'],
                ['username' => 'stock.ren', 'full_name' => 'Ren Garcia', 'created_at' => '2026-08-03 09:00:00'],
                ['username' => 'cashier.sam', 'full_name' => 'Sam Dela Cruz', 'created_at' => '2026-08-21 09:00:00'],
                ['username' => 'manager.toni', 'full_name' => 'Toni Aquino', 'created_at' => '2026-09-02 09:00:00'],
                ['username' => 'support.lei', 'full_name' => 'Lei Ramos', 'created_at' => '2026-09-15 09:00:00'],
            ];

            foreach ($users as $record) {
                $user = User::firstOrNew(['username' => $record['username']]);

                if (! $user->exists) {
                    $user->full_name = $record['full_name'];
                    $user->created_at = $record['created_at'];
                    $user->save();
                }
            }
        });
    }
}
