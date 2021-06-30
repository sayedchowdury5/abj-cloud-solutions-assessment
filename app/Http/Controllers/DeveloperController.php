<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Developer;
use App\Http\Resources\DeveloperResource;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $developers = Developer::orderBy('id', 'desc')->get();
        return new DeveloperResource($developers);
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
        $developer = new Developer();
        //$developer->image = $request->file('image')->store('developer_images');
        $developer->first_name = $request->first_name;
        $developer->last_name = $request->last_name;
        $developer->email = $request->email;
        $developer->phone_no = $request->phone_no;
        $developer->address = $request->address;

        if($developer->save()){
            return new DeveloperResource($developer);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $developer = Developer::findOrFail($id);
        return new DeveloperResource($developer);
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
        $developer = Developer::findOrFail($id);
        $developer->first_name = $request->first_name;
        $developer->last_name = $request->last_name;
        $developer->email = $request->email;
        $developer->phone_no = $request->phone_no;
        $developer->address = $request->address;

        if($developer->save()){
            return new DeveloperResource($developer);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $developer = Developer::findOrFail($id);
        if($developer->delete()){
            return new DeveloperResource($developer);
        }
    }
}
