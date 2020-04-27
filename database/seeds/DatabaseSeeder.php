<?php

   use App\Joke;
   use App\User;
   use Illuminate\Database\Seeder;

   class DatabaseSeeder extends Seeder
   {
       public function run()
       {
           factory(User::class, 10)->create();
           factory(Joke::class, 30)->create();
       }
   }
