<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $pegawaiRole = Role::firstOrCreate(['name' => 'pegawai']);

        $admin = User::create([
            'name' => 'Admin Dishub',
            'email' => 'admin@dishub.go.id',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole($adminRole);

        $pegawai = User::create([
            'name' => 'Pegawai Dishub',
            'email' => 'pegawai@dishub.go.id',
            'password' => Hash::make('password'),
        ]);
        $pegawai->assignRole($pegawaiRole);
    }
}
