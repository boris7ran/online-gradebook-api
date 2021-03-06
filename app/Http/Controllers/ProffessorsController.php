<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proffessor;

class ProffessorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proffessors = Proffessor::with('gradebook')->get();

        return $proffessors;
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
        // $this->validate($request, Proffessor::STORE_RULES);

        $proffessor = new Proffessor();

        \Log::info($request->input('image_link'));

        $proffessor->first_name = $request->input('first_name');
        $proffessor->last_name = $request->input('last_name');
        $proffessor->image_link = $request->input('image_link');
        $proffessor->user_id = $request->input('user_id');

        $proffessor->save();

        return $proffessor;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proffessor = Proffessor::with('gradebook')->find($id);
        if ($proffessor->gradebook) {
            $proffessor->gradebook->students;
        }

        return $proffessor;
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

    public function showByUser($userId)
    {
        $proffessor = Proffessor::with('gradebook')->where('user_id', $userId)->first();
        if ($proffessor){
            if ($proffessor->gradebook) {
                $proffessor->gradebook->students;
                $proffessor->gradebook->comments;
            }
        }   

        return $proffessor;
    }
}