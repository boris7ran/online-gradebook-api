<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gradebook;
use App\Comment;
use App\Student;
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
        
        $gradebook = Gradebook::with('proffessor', 'comments', 'students')->find($id);
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
        $gradebook = Gradebook::with('students')->find($id);

        $gradebook->name = $request->input('name');
        if($gradebook->proffessor->id !== $request->input('proffessor_id')) {
            \Log::info($request->input('proffessor_id'));
            $gradebook->proffessor_id = $request->input('proffessor_id');
        }
        $newStudents = $request->input('students');
        
        foreach ($gradebook->students as $oldStudent) {
            $found = false;
            foreach ($newStudents as $newStudentKey => $newStudent) {
                if (!array_key_exists('id', $newStudent)){
                    $tempName = $newStudent['name'];
                    unset($newStudents[$newStudentKey]);

                    $newStudent = new Student();
                    $newStudent->name = $tempName;
                    $newStudent->image_link = 'randomlink.jpg';
                    $newStudent->gradebook_id = $id;
    
                    $newStudent->save();
                }
                else if ($oldStudent->id === $newStudent['id']){
                    $found = true;
                }
            }

            if(!$found) {
                $oldStudent->delete();
            }
        }

        $gradebook->save();

        return $gradebook;
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
        $comment = new Comment();

        $comment->text = $request->input('text');
        $comment->user_id = $request->input('user_id');
        $comment->gradebook_id = $id;

        $comment->save();

        return $comment;
    }

    public function studentStore(Request $request, $id)
    {
        $student = new Student();

        $student->name = $request->input('name');
        $student->image_link = $request->input('image_link');
        $student->gradebook_id = $id;

        $student->save();

        return $student;
    }
}
