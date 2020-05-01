<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Master;
use App\ReplyMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public function show($id)
    {
        $survey = Master::with('contents.answers')
            ->where('id', $id)
            ->first();
        if (is_null($survey)) {
            abort(404);
        }
        return view('frontend.show', ['survey' => $survey]);
    }

    public function post(Request $request)
    {
        $masterFields = [
            'master_id' => $request->input('master_id'),
        ];
        $contents = $request->input('reply_contents');

        $contentFields = [];
        foreach ($contents as $content) {
            $contentFields[] = [
                'content_id' => $content['content_id'],
                'answer' => $content['answer']
            ];
        }
        DB::transaction(function () use ($masterFields, $contentFields) {
            $reply_master = ReplyMaster::create($masterFields);
            foreach ($contentFields as $fields) {
                $reply_master->replyContent()->create($fields);
            }
        });
    }
}
