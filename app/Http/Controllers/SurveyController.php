<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Content;
use App\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $masterFields = [
            'name'       => $request->input('name'),
            'start_text' => $request->input('start_text'),
            'end_text'   => $request->input('end_text'),
            'user_id'    => Auth::user()->id,
            'status'     => Master::STATUS_ACTIVE
        ];
        $questions = $request->input('questions');
        $seq = 1;
        $questionFields = [];
        foreach ($questions as $question) {
            $ansSeq = 1;
            $answers = [];
            foreach ($question['answers'] as $answer) {
                $answers[] = [
                    'text' => $answer['text'],
                    'seq'  => $ansSeq++
                    //'content_id'
                ];
            }
            $questionFields[] = [
                'seq'      => $seq++,
                'title'    => $question['title'],
                'required' => (int)$question['required'],
                'type_id'  => $question['type'],
                'answers'  => $answers
                //'master_id'
            ];
        }
        $master = Master::create($masterFields);
        foreach ($questionFields as $fields) {
            $attrs = $fields;
            unset($attrs['answers']);
            $content = $master->contents()->create($attrs);
            foreach ($fields['answers'] as $answer) {
                if (!empty($answer['text'])) {
                    $content->answers()->create($answer);
                }
            }
        }

        return response()->json(['url' => route('dashboard')]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $survey = Master::find($id)->load('contents.answers');
        foreach ($survey->contents as $content) {
            $content['type'] = $content->type_id;
            unset($content->type_id);
//            foreach ($content->answers as $key => $answerModel) {
//                $content->answers[$key] = $answerModel->text;
//            }
        }

        return view('admin.edit', ['survey' => json_encode($survey)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $master = Master::where('user_id', Auth::id())
                        ->where('id', $id)
                        ->with('contents')
                        ->first();
        //update master
        $master->update([
                            'name'       => $request->input('name', '沒有主題'),
                            'start_text' => $request->input('start_text', '沒有開頭'),
                            'end_text'   => $request->input('end_text', '沒有結尾')
                        ]);
        //update or create relations
        $questions = $request->input('questions');
        $contentSeq = 1;
        foreach ($questions as $question) {
            $attrs = [
                'seq'      => $contentSeq++,
                'title'    => $question['title'],
                'required' => (int)$question['required'],
                'type_id'  => $question['type'],
            ];
            if (is_null($question['id'])) {
                $content = $master->contents()->create($attrs);
            } else {
                $content = Content::where('id', $question['id'])->first();
                $content->update($attrs);
            }
            $ansSeq = 1;
            foreach ($question['answers'] as $newAnswer) {
                $ansAttrs = [
                        'seq'  => $ansSeq++,
                        'text' => $newAnswer['text'],
                    ];
                if (empty($newAnswer['id'])) {
                    $content->answers()->create($ansAttrs);
                } else {
                    Answer::where('id', $newAnswer['id'])->update($ansAttrs);
                }
            }
        }

        return response()->json(['url' => route('dashboard')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $master = Master::where('user_id', Auth::id())
                        ->where('id', $id)
                        ->first();
        //delete master's relations
        foreach ($master->contents as $content) {
            foreach ($content->answers as $answer) {
                $answer->delete();
            }
            $content->delete();
        }
        $master->delete();

        return response()->json();
    }
}
