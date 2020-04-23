<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Content;
use App\Master;
use App\Type;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $masterFields = ['name'=> $request->input('name'),
                         'start_text'=>$request->input('start_text'),
                         'end_text'=>$request->input('end_text'),
                         'status'=>Master::STATUS_ACTIVE];
        $questions = $request->input('questions');

        $seq = 1;
        $questionFields = [];
        foreach ($questions as $question) {
            $ansSeq = 1;
            $answers = [];
            foreach ($question['answers'] as $answer) {
                $answers[] = [
                    'text'=>$answer,
                    'seq'=>$ansSeq++
                    //'content_id'
                ];
            }

            $questionFields[] = [
                'seq'=>$seq++,
                'title'=>$question['title'],
                'required' => (int) $question['required'],
                'type_id' =>$question['type'],
                'answers' => $answers
                //'master_id'
            ];
        }
        $master = Master::create($masterFields);
        foreach ($questionFields as $fields) {
            $attrs = $fields;
            unset($attrs['answers']);
            $content = $master->content()->create($attrs);
            foreach ($fields['answers'] as $answer) {
                $content->answer()->create($answer);
            }
        }
        return response()->json(['url'=> route('dashboard')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //TODO: Get whole survey object from the database
        $survey = Master::find($id);
        return view('admin.edit', ['survey'=>json_encode($survey)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //TODO handle request, updating survey data from user to the database
        return response()->json($request->toArray(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
