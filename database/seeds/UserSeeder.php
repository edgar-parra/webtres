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
                'names' => 'Juan Andrés',
                'father_surname' => 'Soto',
                'mother_surname' => 'Álvarez',
                'email' => 'jsoto@gmail.com',
                'date_birth' => '1984-06-22',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'picture' => 'img/pictures/1.jpg'
            ],
            [
                'rut' => '14567890-5',
                'names' => 'Mariana Andrea',
                'father_surname' => 'Ramirez',
                'mother_surname' => 'Duran',
                'email' => 'mramirez@gmail.com',
                'date_birth' => '1994-01-30',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'picture' => 'img/pictures/2.jpg'
            ],
            [
                'rut' => '13567890-5',
                'names' => 'Cristian',
                'father_surname' => 'Zamora',
                'mother_surname' => 'Vargas',
                'email' => 'czamo@gmail.com',
                'date_birth' => '1974-12-16',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'picture' => 'img/pictures/3.jpg'
            ],
            [
                'rut' => '12567890-5',
                'names' => 'Alberto Carlos',
                'father_surname' => 'Fuentes',
                'mother_surname' => 'Gonzalez',
                'email' => 'afuentes@gmail.com',
                'date_birth' => '1989-11-03',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'picture' => 'img/pictures/4.jpg'
            ],
            [
                'rut' => '11567890-5',
                'names' => 'Carlos',
                'father_surname' => 'Barrera',
                'mother_surname' => 'Nuñez',
                'email' => 'carlosb@gmail.com',
                'date_birth' => '1954-08-11',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'picture' => 'img/pictures/5.jpg'
            ],
        ];

        foreach ($data as $user) {
            User::create([
                'rut' => $user['rut'],
                'names' => $user['names'],
                'father_surname' => $user['father_surname'],
                'mother_surname' => $user['mother_surname'],
                'email' => $user['email'],
                'date_birth' => $user['date_birth'],
                'password' => $user['password'],
                'picture' => $user['picture'],
            ]);
        }
    }
}
