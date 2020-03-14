<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;

class FormController extends Controller
{

  public function index()
  {
  	//TODO show list of respondent

  }
  
  public function create()
  {
    return view('form'); 
  }

  public function store(Request $request)
  {
  	$fields = ['firstname'=> $request->input('fname'), 
  			   'lastname' =>$request->input('lname'),
  			   'email' => $request->input('email')];

  	$form = Form::create($fields);

	
	return redirect()->route('form.show', ['id'=>$form->id]);
  	
  } 

  public function show($id)
  {

  	$form = Form::find($id);
  	
  	return view('show', ['firstname' => $form->firstname , 
  						  'lastname' => $form->lastname , 
  						  'email' =>$form->email ]);

  }
}


