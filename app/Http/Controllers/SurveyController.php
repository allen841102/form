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
        $count_question = 0;

        //TODO handle request, creating survey data from user to the database
        return response()->json($request->toArray(), 200);
        $fields = ['name'=> $request->input('name'),
                   'start_text'=>$request->input('start_text'),
                   'end_text'=>$request->input('end_text')];

        foreach($questions as $request->input('questions'))
        {   $count_question= $count_question + 1;
            $count_answer = 0;

            $fields2[] = [
                'seq'=>$count_question,
                'title'=>$request->input('questions.title'),
                'required'=>$request->input('questions.required'),
                'type_id'=>$request->input('questions.type')];

            foreach ($answers as $questions->input('answers'))
            {
                $count_answer = $count_answer + 1;
                $field3[] = [
                    'text1'=>$request->input('answers.value'),
                     'seq'=>$count_answer];
;
            }
        }
        /*
        $fields2 = [
            'seq'=>1,
            'title'=>'test',
            'required'=>false,
            'type_id'=>1];

        $field3 = [
            'text'=>'answer1',
            'seq'=>1];
        */
        $master = Master::create($fields);
        $content = $master->content()->create($fields2);
        $answer = $content->answer()->create($field3);
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
