<?php

namespace App\Http\Controllers;

use App\Models\Migrations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MigrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //index
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Migrations  $migrations
     * @return \Illuminate\Http\Response
     */
    public function show(Migrations $migrations)
    {
        //show
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Migrations  $migrations
     * @return \Illuminate\Http\Response
     */
    public function edit(Migrations $migrations)
    {
        //edit
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Migrations  $migrations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Migrations $migrations)
    {
        //update
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Migrations  $migrations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Migrations $migrations)
    {
        //destroy
    }
}
