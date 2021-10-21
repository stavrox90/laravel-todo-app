<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodosController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $todos = Todo::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $todos = Todo::all();
        return response()->json([
            'data' => $todos,
            'success' => false,
            'status' => 200,
            'message' => 'Success'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable',
        ]);

        $todo = new Todo;
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');

        if($request->has('completed'))
        {
            $todo->completed = true;
        }

        $todo->user_id = Auth::user()->id;
        $todo->save();

        return response()->json([
            'data' => [],
            'success' => true,
            'status' => 200,
            'message' => 'Success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        return response()->json([
            'data' => $todo,
            'success' => true,
            'status' => 200,
            'message' => 'Success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $todo = Todo::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        // return response()->json([
        //     'data' => $todo,
        //     'success' => true,
        //     'status' => 200,
        //     'message' => 'Success'
        // ]);
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
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable',
        ]);

        $todo = Todo::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');

        if($request->has('completed')) {
            $todo->completed = true;
        } else {
            $todo->completed = false;
        }

        $todo->save();

        return response()->json([
            // 'data' => $todo,
            'success' => true,
            'status' => 200,
            'message' => 'Item has been updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $todo->delete();
        // return redirect()->route('todo.index')->with('success', 'Item deleted successfully!');
        return response()->json([
            // 'data' => $todo,
            'success' => true,
            'status' => 200,
            'message' => 'Item deleted successfully!'
        ]);
    }
}
