<?php

use App\question;
use Illuminate\Database\Seeder;

class createQuestion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        question::create([
            'text_question' => 'show',
            'text_answer' => 'text_answer1',
            'status_view' => '1',
            'center_type' => '2',
            'user_id' => '1',
        ]);
        /*question::create([
            'text_question' => 'it sended',
            'text_answer' => 'text_answer2',
            'status_view' => '0',
            'center_type' => '1',
            'user_id' => '1',
        ]);*/
        question::create([
            'text_question' => 'show',
            'text_answer' => 'text_answer3',
            'status_view' => '1',
            'center_type' => '2',
            'user_id' => '1',
        ]);
       /* question::create([
            'text_question' => 'it sended',
            'text_answer' => 'text_answer4',
            'status_view' => '0',
            'center_type' => '1',
            'user_id' => '1',
        ]);*/
        question::create([
            'text_question' => 'pending',
            'text_answer' => 'text_answer5',
            'status_view' => '2',
            'center_type' => '0',
            'user_id' => '1',
        ]);
    }
}
