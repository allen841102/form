<?php

namespace App\Http\Controllers;

use App\Master;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $lists = Master::where('user_id', Auth::id())
                       ->with('contents', 'replymasters')
                        ->get();
        //dd($lists);
        $surveylist = [];
        foreach ($lists as $list) {
            $surveylist[] = [
                'sequence'=> $list->id,
                'title'=> $list->name,
                'created_at'=> $this->getDateTime($list->created_at),
                'updated_at'=> $this->getDateTime($list->updated_at),
                'question_count'=> count($list->Contents),
                'status'=> $list->status,
                'response_count'=> count($list->replymasters),
                'response_time'=> $this->getDateTime($list->replymasters->max('updated_at')),
                'view_link'=> '/admin/survey/'.$list->id,
                'edit_link'=> '/admin/survey/edit/'.$list->id,];
        }
        return view('admin.home', ['list'=>json_encode($surveylist)]);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $list
     * @return string
     */
    private function getDateTime(?Carbon $time): string
    {
        return $time ? $time->format('Y-m-d H:i:s') : 'N/A';
    }
}
