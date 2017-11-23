<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 'ab01',
            'name' => 'admin',
            'email' => 'admin@test.com',
            'type' => 'teacher'
        ]);
        DB::table('users')->insert([
            'id' => 'lln',
            'name' => 'Leerling Test',
            'email' => 'lln@test.com',
            'type' => 'student'
        ]);

        DB::table('educations')->insert([
            'title' => 'AMO',
            'duration' => 3,
            'terms_per_year' => 4
        ]);
        DB::table('cohorts')->insert([
            'education_id' => 1,
            'start_year' => '2017',
            'exam_year' => '2020'
        ]);
        DB::table('cohorts')->insert([
            'education_id' => 1,
            'start_year' => '2016',
            'exam_year' => '2019'
        ]);
        
        DB::table('terms')->insert([
            'cohort_id' => 1,
            'order' => 1,
            'duration' => 1
        ]);

        DB::table('lesson_types')->insert([
            'term_id' => 1,
            'title' => 'PGO',
            'order' => 1,
        ]);

        DB::table('lessons')->insert([
            'lesson_type_id' => 1,
            'week_start' => 1,
            'duration' => 1,
            'title' => 'Wat is een PGO?',
        ]);

        DB::table('review_statuses')->insert([
            'title' => 'Concept',
            'context_class' => 'secondary'
        ]);
        DB::table('review_statuses')->insert([
            'title' => 'In-review',
            'context_class' => 'warning'
        ]);
        DB::table('review_statuses')->insert([
            'title' => 'Compleet',
            'context_class' => 'success'
        ]);
    }
}
