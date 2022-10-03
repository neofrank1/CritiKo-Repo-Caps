<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Block;
use App\Models\QType;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Question;
use App\Models\QCategory;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
/*         Department::create([
            'name' => 'College of ICT',
            'abbre' => 'CCICT'
        ]);

        Department::create([
            'name' => 'College of Technology',
            'abbre' => 'CoT'
        ]);

        Department::create([
            'name' => 'College of Engineering',
            'abbre' => 'CoE'
        ]);

        Department::create([
            'name' => 'College of Education',
            'abbre' => 'CoEd'
        ]); */
        //create one department
        $dept = Department::factory()->create([
            'name' => 'College of Communication and Internet Computing Technology',
            'abbre' => 'CCICT'
        ]);
        //create five users only faculty
        $users = User::factory(random_int(3, 4))->create([
            'type' => 3
        ]);
        //create faculty based on how much user type 3 was created
        foreach($users as $user)
        {
            if($user->type == 3)
            {
                Faculty::factory()->create([
                    'user_id' => $user->id,
                    'department_id' => $dept->id
                ]);
            }
        }
        //create four courses in one department
        $course = Course::factory(random_int(1, 4))->create([
            'department_id' => $dept->id
        ]);
        //create random 1-3 subjects on each courses create
        foreach($course as $c)
        {
            Subject::factory(random_int(1, 3))->create([
                'course_id' => $c->id
            ]);
        }

        //Factory question types
        $qtype = [
            [
                'name' => 'Quantitative'
            ],
            [
                'name' => 'Qualitative'
            ]
        ];
        foreach($qtype as $type)
            QType::create($type);

        $qcat = [
            [
                'name' => 'Management'
            ],
            [
                'name' => 'Performance'
            ]
        ];
        foreach($qcat as $cat)
            QCategory::create($cat);

        //factory management questions
        $qmanagement = [
            [
                'q_type_id' => 1,
                'q_category_id' => 1,
                'sentence' => 'gives reasonable course/subject assignments',
                'keyword' => 'reasonable',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 1,
                'sentence' => 'earns appreciation and kind attention from the students',
                'keyword' => 'appreciative',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 1,
                'sentence' => 'gives orientation about the subject and how the students are evaluated',
                'keyword' => 'briefs subject',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 1,
                'sentence' => 'gives test and/or projects which are within the objectives of the course',
                'keyword' => 'test/projects given was discussed',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 1,
                'sentence' => 'shows concern in assisting the students',
                'keyword' => 'helps students',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 1,
                'sentence' => 'shows sympathetic insight into students’ feelings',
                'keyword' => 'sympathetic',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 1,
                'sentence' => 'checks and records test papers/term papers promptly',
                'keyword' => 'dili tingubon check',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 1,
                'sentence' => 'is on time and regular in meeting the class',
                'keyword' => 'punctual',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 1,
                'sentence' => 'assigns fair subject/course requirements',
                'keyword' => 'fair subject/course requirements',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 1,
                'sentence' => 'sustains the attention of the class for the whole period',
                'keyword' => 'class is listening',
                'type' => 4
            ]
        ];
        foreach($qmanagement as $m)
            Question::create($m);

        //Factory performance questions
        $qperf = [
            [
                'q_type_id' => 1,
                'q_category_id' => 2,
                'sentence' => 'presents lesson clearly, methodically, and substantially',
                'keyword' => 'clear presentation of lessons',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 2,
                'sentence' => 'motivates the students to learn',
                'keyword' => 'motivator',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 2,
                'sentence' => 'facilitates learning with the application of appropriate educational methods and techniques',
                'keyword' => 'teaching strategy',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 2,
                'sentence' => 'shows mastery of the lesson',
                'keyword' => 'mastery of lesson',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 2,
                'sentence' => 'is prepared for the class',
                'keyword' => 'prepared',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 2,
                'sentence' => 'inspires students’ self-reliance in their quest for knowledge',
                'keyword' => 'make students eager to learn',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 2,
                'sentence' => 'knows when the students have difficulty understanding the lesson and finds ways to make it easy',
                'keyword' => 'knows the limit of students understanding',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 2,
                'sentence' => 'integrates values into the lesson',
                'keyword' => 'values oriented',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 2,
                'sentence' => 'Speaks the language of instruction (English or Filipino) clearly and fluently',
                'keyword' => 'speaks language beingu used clearly',
                'type' => 4
            ],
            [
                'q_type_id' => 1,
                'q_category_id' => 2,
                'sentence' => 'delivers thought provoking questions',
                'keyword' => 'makes student think more',
                'type' => 4
            ]
        ];
        foreach($qperf as $p)
            Question::create($p);
    }
}