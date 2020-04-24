<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Master;

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
        return view('frontend.show', ['survey'=>$survey]);
    }
}
