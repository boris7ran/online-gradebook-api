<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gradebook;
use App\Comment;
use Illuminate\Support\Facades\DB;

class GradebooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gradebooks = Gradebook::with('proffessor')->get();

        return $gradebooks;
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
        $gradebook = new Gradebook();

        $gradebook->name = $request->input('name');
        $gradebook->proffessor_id = $request->input('proffessor_id');

        $gradebook->save();

        return $gradebook;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $comments = DB::table('gradebooks')
        // ->where('gradebooks.id', '=', $id)
        // ->leftJoin('comments', 'comments.gradebook_id', '=', 'gradebooks.id')
        // ->leftJoin('users', 'comments.user_id', '=', 'users.id')
        // ->leftJoin('proffessors', 'proffessors.id', '=', 'gradebooks.proffessor_id')
        // ->select('gradebooks.name', 'users.first_name', 'users.last_name', 'proffessors.first_name', 'proffessors.last_name', 'proffessors.id', 'comments.text', 'comments.created_at')
        // ->get();
        
        $gradebook = Gradebook::with('proffessor', 'comments')->find($id);

        return $gradebook;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function commentStore(Request $request, $id)
    {
        \Log::info($request);
        $comment = new Comment();

        $comment->text = $request->input('text');
        $comment->user_id = $request->input('user_id');
        $comment->gradebook_id = $id;

        $comment->save();

        return $comment;
    }
}
