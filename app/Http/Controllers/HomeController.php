<?php

namespace App\Http\Controllers;

use App\Master;
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

        $lists = Master::with('Content')->get();
        $surveylist = [];
        foreach ($lists as $list)
        {

            $surveylist[] = [
                'sequence'=> $list->id,
                'title'=> $list->name,
                'created_at'=> $list->created_at,
                'updated_at'=> $list->update_at,
                'question_count'=> count($list->Content),
                'status'=> $list->status,
                'response_count'=> 33,
                'response_time'=> '2020-03-31 14:23:12',
                'view_link'=> '/admin/survey/'.$list->id,
                'edit_link'=> '/admin/survey/edit/'.$list->id,];
        }
        return view('admin.home', ['list'=>json_encode($surveylist)]);

    }
}
