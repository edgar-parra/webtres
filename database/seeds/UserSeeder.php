<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'rut' => '15567890-5',
                'first_name' => 'Juan Andrés',
                'last_name' => 'Soto Álvarez',
                'email' => 'jsoto@gmail.com',
                'date_birth' => '1984-06-22',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'picture' => 'img/pictures/1.jpg'
            ],
            [
                'rut' => '14567890-5',
                'first_name' => 'Mariana Andrea',
                'last_name' => 'Ramirez Duran',
                'email' => 'mramirez@gmail.com',
                'date_birth' => '1994-01-30',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'picture' => 'img/pictures/2.jpg'
            ],
            [
                'rut' => '13567890-5',
                'first_name' => 'Cristian',
                'last_name' => 'Zamora Vargas',
                'email' => 'czamo@gmail.com',
                'date_birth' => '1974-12-16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'picture' => 'img/pictures/3.jpg'
            ],
            [
                'rut' => '12567890-5',
                'first_name' => 'Alberto Carlos',
                'last_name' => 'Fuentes Gonzalez',
                'email' => 'afuentes@gmail.com',
                'date_birth' => '1989-11-03',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'picture' => 'img/pictures/4.jpg'
            ],
            [
                'rut' => '11567890-5',
                'first_name' => 'Carlos',
                'last_name' => 'Barrera Nuñez',
                'email' => 'carlosb@gmail.com',
                'date_birth' => '1954-08-11',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'picture' => 'img/pictures/5.jpg'
            ],
        ];

        foreach ($data as $user) {
            User::create([
                'rut' => $user['rut'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'date_birth' => $user['date_birth'],
                'password' => $user['password'],
                'picture' => $user['picture'],
            ]);
        }
    }
}
