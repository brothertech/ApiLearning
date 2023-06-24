<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $users=   [ 
                    [
                        'name' => 'John Doe',
                        'email' => 'example@gmail.co',
                        'password' =>bcrypt('12345678'),
                        'created_at' =>now(),
                        'updated_at' =>now()
                    ],

                    [
                        'name' => 'John',
                        'email' => 'example2@gmail.comm',
                        'password' =>bcrypt('12345678'),
                        'created_at' =>now(),
                        'updated_at' =>now()

                    ],
                    [
                        'name' => 'John Doe',
                        'email' => 'example8@gmail.com',
                        'password' =>bcrypt('12345678'),
                        'created_at' =>now(),
                        'updated_at' =>now()
                    ],
                    [
                        'name' => 'John Doe',
                        'email' => 'example7@gmail.com',
                        'password' =>bcrypt('12345678'),
                        'created_at' =>now(),
                        'updated_at' =>now()
                    ],
                    [
                        'name' => 'John Doe',
                        'email' => 'example1@gmail.com',
                        'password' =>bcrypt('12345678'),
                        'created_at' =>now(),
                        'updated_at' =>now()
                    ],
                    [
                        'name' => 'John Doe',
                        'email' => 'example21@gmail.com',
                        'password' =>bcrypt('12345678'),
                        'created_at' =>now(),
                        'updated_at' =>now()  
                    ],
                    [
                        'name' => 'John Doe',
                        'email' => 'example3@gmail.com',
                        'password' =>bcrypt('12345678'),
                        'created_at' =>now(),
                        'updated_at' =>now()  
                    ],
                    [
                        'name' => 'John Doe',
                        'email' => 'example4@gmail.com',
                        'password' =>bcrypt('12345678'),
                        'created_at' =>now(),
                        'updated_at' =>now() 
                    ],
                    [
                        'name' => 'John Doe',
                        'email' => 'example6@gmail.com',
                        'password' =>bcrypt('12345678') ,
                        'created_at' =>now(),
                        'updated_at' =>now()
                    ]

                    
            
       

      ];


    User::insert($users);
    }
    
}
