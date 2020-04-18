<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $surveyList = [
                     [
                         'sequence'=> 1,
                         'title'=> '飲食習慣研究',
                         'created_at'=> '2020-01-02 12:39:49',
                         'updated_at'=> '2020-04-03 18:00:22',
                         'question_count'=> 5,
                         'status'=> '開啟',
                         'response_count'=> 33,
                         'response_time'=> '2020-03-31 14:23:12',
                         'view_link'=> '/admin/survey/1',
                         'edit_link'=> '/admin/survey/edit/1'
                     ],
                     [
                         'sequence'=> 2,
                         'title'=> '大學生打工調查',
                         'created_at'=> '2020-02-22 12:39:49',
                         'updated_at'=> '2020-03-01 18:00:22',
                         'question_count'=> 15,
                         'status'=> '關閉',
                         'response_count'=> 123,
                         'response_time'=> '2020-02-28 14:23:12',
                         'view_link'=> '/admin/survey/1',
                         'edit_link'=> '/admin/survey/edit/1'
                     ]
                 ];
        return view('admin.home', ['list'=>json_encode($surveyList)]);
    }
}
