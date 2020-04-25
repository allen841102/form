<?php

namespace App\Http\Controllers;

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
            foreach ($question['answers'] as $value) {
                $answers[] = [
                    'text' => $value,
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
                        ->first();
        //update master
        $master->update([
                            'name'       => $request->input('name', '沒有主題'),
                            'start_text' => $request->input('start_text', '沒有開頭'),
                            'end_text'   => $request->input('end_text', '沒有結尾')
                        ]);
        //delete master's relations
        foreach ($master->contents as $content) {
            foreach ($content->answers as $answer) {
                $answer->delete();
            }
            $content->delete();
        }
        //create new relations
        $questions = $request->input('questions');
        $seq = 1;
        foreach ($questions as $question) {
            $content = $master->contents()->create(
                [
                    'seq'      => $seq++,
                    'title'    => $question['title'],
                    'required' => (int)$question['required'],
                    'type_id'  => $question['type']
                ]
            );
            $ansSeq = 1;
            foreach ($question['answers'] as $value) {
                if (!empty($value)) {
                    $content->answers()->create(
                        [
                            'seq'  => $ansSeq++,
                            'text' => $value,
                        ]
                    );
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
