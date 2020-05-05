<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Content;
use App\Master;
use App\ReplyMaster;
use App\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Master::where('user_id', Auth::id())
                       ->with('contents', 'replymasters')
                       ->get();
        $surveylist = [];
        foreach ($lists as $list) {
            $surveylist[] = [
                'sequence' => $list->id,
                'title' => $list->name,
                'created_at' => $this->getDateTime($list->created_at),
                'updated_at' => $this->getDateTime($list->updated_at),
                'question_count' => count($list->Contents),
                'status' => $list->status,
                'response_count' => count($list->replymasters),
                'response_time' => $this->getDateTime($list->replymasters->max('updated_at')),
                'view_link' => '/admin/survey/' . $list->id,
                'edit_link' => '/admin/survey/edit/' . $list->id,
            ];
        }

        return view('admin.home', ['list' => json_encode($surveylist)]);
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
            'name' => $request->input('name'),
            'start_text' => $request->input('start_text'),
            'end_text' => $request->input('end_text'),
            'user_id' => Auth::user()->id,
            'status' => Master::STATUS_ACTIVE
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
                    'seq' => $ansSeq++
                    //'content_id'
                ];
            }
            $questionFields[] = [
                'seq' => $seq++,
                'title' => $question['title'],
                'required' => (int)$question['required'],
                'type_id' => $question['type'],
                'answers' => $answers
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
        $survey = Master::with('contents.answers')
                        ->where([
                            'id' => $id,
                            'user_id' => Auth::id()
                        ])
                        ->first();
        if (is_null($survey)) {
            abort(404);
        }

        return view('admin.show', ['survey' => $survey]);
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
        $survey = Master::with([
            'contents' => function ($query) {
                $query->orderBy('seq')
                      ->with([
                          'answers' => function ($query) {
                              $query->orderBy('seq');
                          }
                      ]);
            }
        ])->find($id);
        foreach ($survey->contents as $content) {
            $content['type'] = $content->type_id;
            unset($content->type_id);
        }

        return view('admin.edit', ['survey' => $survey->toJson()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $master = Master::where('user_id', Auth::id())
                            ->where('id', $id)
                            ->with('contents')
                            ->first();
            //update master
            $master->update([
                'name' => $request->input('name', '沒有主題'),
                'start_text' => $request->input('start_text', '沒有開頭'),
                'end_text' => $request->input('end_text', '沒有結尾')
            ]);
            $questions = $request->input('questions');
            // 刪除題目
            foreach ($master->contents as $content) {
                $found = false;
                foreach ($questions as $question) {
                    if ($content->id == $question['id']) {
                        $found = true;
                        break;
                    }
                }
                if ($found == false) {
                    $content->answers()->delete();
                    $content->delete();
                }
            }
            //更新 或 建立 題目與答案
            $contentSeq = 1;
            foreach ($questions as $question) {
                $attrs = [
                    'seq' => $contentSeq++,
                    'title' => $question['title'],
                    'required' => (int)$question['required'],
                    'type_id' => $question['type'],
                ];
                if (is_null($question['id'])) {
                    $content = $master->contents()->create($attrs);
                } else {
                    $content = Content::where('id', $question['id'])->first();
                    $content->update($attrs);
                }
                if ($question['type'] == '3') {
                    continue;
                }
                //刪除答案
                foreach ($content->answers as $answer) {
                    $found = false;
                    foreach ($question['answers'] as $userAnswer) {
                        if ($answer->id == $userAnswer['id']) {
                            $found = true;
                            break;
                        }
                    }
                    if ($found == false) {
                        $answer->delete();
                    }
                }
                $ansSeq = 1;
                foreach ($question['answers'] as $userAnswer) {
                    $ansAttrs = [
                        'seq' => $ansSeq++,
                        'text' => $userAnswer['text'],
                    ];
                    if (empty($userAnswer['id'])) {
                        $content->answers()->create($ansAttrs);
                    } else {
                        Answer::where('id', $userAnswer['id'])->update($ansAttrs);
                    }
                }
            }
            DB::commit();

            return response()->json(['url' => route('dashboard')]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
        }
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

    public function chart($id)
    {
        $master = Master::where('user_id', Auth::id())
                        ->where('id', $id)
                        ->with('contents.replyContents', 'contents.answers')
                        ->first();
        $results = [];
        foreach ($master->contents as $content) {
            $results[] = [
                'name' => $content->title,
                'type_id' => $content->type_id,
                'details' => $content->getDetails(),
            ];
        }

        return response()->json($results);
    }

    public function review($id)
    {
        $master = Master::where('user_id', Auth::id())
                        ->where('id', $id)
                        ->with('replyMasters.replyContent', 'contents')
                        ->first();
        $contents = $master->contents->all();
        $questions = [];
        foreach ($contents as $content) {
            $questions[] = [
                'title' => $content->title,
                'key' => $content->id,
            ];
        }

        $replyMasters = $master->replyMasters()
                               ->paginate(5);

        $data = [];
        foreach ($replyMasters as $replyMaster) {
            $created_at = $replyMaster->created_at->format('Y-m-d H:i:s');
            $ip = '123.111.231.231';
            $response_time = '103';
            $key = [
                'created_at' => $created_at,
                'ip' => $ip,
                'response_time' => $response_time
            ];

            foreach ($replyMaster->replyContent as $replyContents) {
                $id = $replyContents->content_id;
                $answers = $replyContents->answer;
                if (array_key_exists('ids', $answers)) {
                    $key[$id] = reset($answers);
                } else {
                    $key[$id] = reset($answers);
                    $key[$id] = (array)$key[$id];
                }
                if (array_key_exists('text', $answers) == false) {

                    foreach ($key[$id] as $idx => $value) {
                        $answerName = Answer::where('id', $value)
                                            ->first();
                        $key[$id][$idx] = $answerName ? $answerName->text : 'NA';
                    }

                }

            }
            $data[] = $key;

        }

        $results = [
            'data' => $data,
            'questions' => $questions,
            'per_page' => $replyMasters->perPage(),
            'current_page' => $replyMasters->currentPage(),
            'total' => $replyMasters->total()
        ];
        return response()->json($results);

    }

    public function share($id)
    {
    }

    private function getDateTime(?Carbon $time): string
    {
        return $time ? $time->format('Y-m-d H:i:s') : 'N/A';
    }

    private function getDetail($replyMaster)
    {
        //$replyContent = $replyMaster->
    }
}
