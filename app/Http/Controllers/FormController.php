<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use phpDocumentor\Reflection\Types\Array_;

class FormController extends Controller
{

  public function index()
  {

      $forms = Form::all();


      return view('list', ['list'=>$forms]);
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

  public function format()
  {


    $result = [];
    $result[] = ['name' => 'Allen','age' => 24];
    $result[] = ['name' => 'Kevin','age' => 25];
    $count = count($result);
    $total = 0;
    $average = 0;
    foreach ($result as $sum)
    {

        $total = $total + $sum['age'];
    }

    $average = $total / $count;
    //dd($average);
      $final = ['name' => 'Summary' , 'total' => $count , 'average' => $average , 'data' => $result];


//    $array = ['name' => 'Allen' ,
//              'age' => 24];

    echo json_encode($final);

  }
}


