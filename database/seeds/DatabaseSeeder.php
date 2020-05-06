<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //roles
        DB::table('roles')->insert([
            'name' => 'user',
        ]);
        DB::table('roles')->insert([
            'name' => 'admin',
        ]);

        //semester

        DB::table('semesters')->insert([
            'name' => 'semester 1',
        ]);

        DB::table('semesters')->insert([
            'name' => 'semester 2',
        ]);

        //blocks
        DB::table('blocks')->insert([
            'name' => 'block 1',
            'semester_name' => 'semester 1',
        ]);
        DB::table('blocks')->insert([
            'name' => 'block 2',
            'semester_name' => 'semester 1',
        ]);
        DB::table('blocks')->insert([
            'name' => 'block 3',
            'semester_name' => 'semester 1',
        ]);
        DB::table('blocks')->insert([
            'name' => 'block 4',
            'semester_name' => 'semester 1',
        ]);
        DB::table('blocks')->insert([
            'name' => 'block 5',
            'semester_name' => 'semester 2',
        ]);
        DB::table('blocks')->insert([
            'name' => 'block 6',
            'semester_name' => 'semester 2',
        ]);
        DB::table('blocks')->insert([
            'name' => 'block 7',
            'semester_name' => 'semester 2',
        ]);
        DB::table('blocks')->insert([
            'name' => 'block 8',
            'semester_name' => 'semester 2',
        ]);

        //teachers
        DB::table('teachers')->insert([
            'name' => Crypt::encryptString('Jasper van Rosmalen'),
        ]);
        DB::table('teachers')->insert([
            'name' => Crypt::encryptString('Stefan van Dockum'),
        ]);
        DB::table('teachers')->insert([
            'name' => Crypt::encryptString('Dirk Pesman'),
        ]);
        DB::table('teachers')->insert([
            'name' => Crypt::encryptString('Suzan van Rietschoten'),
        ]);

        //modules
        DB::table('modules')->insert([
            'name' => 'WEBSPHP',
            'coordinator' => 2,
            'block_name' => 'block 1',
            'EC' => 6
        ]);
        DB::table('modules')->insert([
            'name' => 'WEBSJS',
            'coordinator' => 2,
            'block_name' => 'block 1',
            'EC' => 6
            ]);

        DB::table('modules')->insert([
            'name' => 'EPRES',
            'coordinator' => 2,
            'block_name' => 'block 1',
            'EC' => 1
        ]);

        DB::table('modules')->insert([
            'name' => 'SOLLI',
            'coordinator' => 1,
            'block_name' => 'block 1',
            'EC' => 3
        ]);
        DB::table('modules')->insert([
            'name' => 'PYTHON',
            'coordinator' => 3,
            'block_name' => 'block 1',
            'EC' => 4
        ]);

        //teachermodule
        DB::table('teacher_has_module')->insert([
            'teacher_id' => 1,
            'module_id' => 1
        ]);
        DB::table('teacher_has_module')->insert([
            'teacher_id' => 1,
            'module_id' => 2
        ]);
        DB::table('teacher_has_module')->insert([
            'teacher_id' => 1,
            'module_id' => 3
        ]);
        DB::table('teacher_has_module')->insert([
            'teacher_id' => 1,
            'module_id' => 4
        ]);
        DB::table('teacher_has_module')->insert([
            'teacher_id' => 1,
            'module_id' => 5
        ]);
        DB::table('teacher_has_module')->insert([
            'teacher_id' => 2,
            'module_id' => 1
        ]);
        DB::table('teacher_has_module')->insert([
            'teacher_id' => 2,
            'module_id' => 2
        ]);
        DB::table('teacher_has_module')->insert([
            'teacher_id' => 3,
            'module_id' => 3
        ]);

        //categories
        DB::table('categories')->insert([
            'name' => 'Assessment',
            'description' => 'Doorbeunen'
        ]);
        DB::table('categories')->insert([
            'name' => 'Test',
            'description' => 'Multiple choice'
        ]);
        DB::table('categories')->insert([
            'name' => 'Homework',
            'description' => 'Work work work'
        ]);

        //assignments
        DB::table('assignments')->insert([
            'name' => 'Laravel Studymate',
            'description' => 'Laravel Studymate met je mate',
            'category_id' => 1,
            'teacher_id' => 2,
            'module_id' => 1,
            'grade' => 8,
        ]);

        DB::table('assignments')->insert([
            'name' => 'Monster Zoo',
            'description' => 'Snoeihard aan het Javascripten',
            'category_id' => 1,
            'teacher_id' => 2,
            'module_id' => 2,
            'grade' => 8,
        ]);

        DB::table('assignments')->insert([
            'name' => 'TEDxTalk',
            'description' => 'Presentatie in het Engels',
            'category_id' => 1,
            'teacher_id' => 2,
            'module_id' => 3,
            'grade' => 8,
        ]);


        //user
        DB::table('users')->insert([
            'id' => '1', 'name' => 'admin', 'email' => 'eyJpdiI6ImRjbVpNTkh0NENXSktBVDZVV0NNYmc9PSIsInZhbHVlIjoiRUdSVmZpOVlqVGg1YWcvWEQzZnNDc2ZhYlRHM0NsL3VQdkZ4Q3hzaWNrdz0iLCJtYWMiOiIyYWE1MmE5Yjg4MzJmNDM3M2VjMDZkYjk0OGNhZTQ2YjhmNTVhOGUwMWI4N2I2NjZmOGQ5MTZlNzUzOTIzZmYxIn0=', 'email_verified_at' => NULL, 'password' => '$2y$10$hHe8SqW7Y/ngQ3iiYxpHbOcsjHKOVcLfSErpFeXBMxj6K1.CrxUGG', 'remember_token' => NULL, 'created_at' => '2020-03-24 18:38:06', 'updated_at' => '2020-03-24 18:38:06'
        ]);

        DB::table('role_user')->insert([
            'id' => '1', 'role_id' => '2', 'user_id' => '1'
        ]);

        DB::table('role_user')->insert([
            'id' => '2', 'role_id' => '1', 'user_id' => '1'
        ]);

        //tags
        DB::table('tags')->insert([
            'name' => 'fun',
        ]);

        DB::table('tags')->insert([
            'name' => 'difficult',
        ]);

        DB::table('tags')->insert([
            'name' => 'easy',
        ]);

        DB::table('tags')->insert([
            'name' => 'boring',
        ]);

    }
}
