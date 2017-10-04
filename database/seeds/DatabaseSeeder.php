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
            'name' => 'admin',
            'email' => 'bartjroos@gmail.com',
            'password' => bcrypt('Test12')
        ]);
        DB::table('users')->insert([
            'name' => 'tester',
            'email' => 'bartjroos@gmail.com',
            'password' => bcrypt('tester')
        ]);

        DB::table('educations')->insert([
            'title' => 'AMO',
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
            'title' => 'p1',
            'year_of_study' => 1
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
            'context_class' => 'danger'
        ]);
        DB::table('review_statuses')->insert([
            'title' => 'Complete',
            'context_class' => 'success'
        ]);
    }
}
