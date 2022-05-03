<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    //
    public function __construct(){
        $this -> middleware('auth:api');
    }


//Read all
    public function index(){
        $todos = Todo::all();
        return response()->json([
            'status' => 'success',
            'todos'=>$todos,
        ]);
    }

//Created all
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);


        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Criado com Sucesso',
            'todo'=> $todo,
        ]);

    }

//Read by Id
    public function shown($id){
        $todo = Todo::find($id);
        return response()->json([
            'status' => 'success',
            'todo' => $todo,
        ]);
    }

// update by id

    public function update(Request $request, $id){
        $request->validate([
            'title'=> 'required|string|max:255',
            'description'=>'required|string|max:255',
        ]);

        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->save();


        return response()->json([
            'status' => 'success',
            'message' =>'Atualizado com sucesso',
            'todo' =>$todo,
        ]);
    }

}
