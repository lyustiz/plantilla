<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Status::with([])
                    ->get();
        
        return $status;
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
        $validate = request()->validate([
            'nb_status'         => 	'required|alpha_num|max:30',
			'in_grupo_status'   => 	'required|alpha_num|max:3',
			'nb_grupo_status'   => 	'required|alpha_num|max:30',
			'nb_status2'        => 	'required|alpha_num|max:30',
			'nu_orden'          => 	'required|integer|max:10',
			'nu_orden2'         => 	'required|integer|max:10',
			'id_usuario'        => 	'required|alpha_num|max:',
        ]);

        $status = status::create($request->all());

        return [ 'msj' => 'Registro Agregado Correctamente', compact('status') ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        return $status;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $validate = request()->validate([
            'id_status'         => 	'required|integer|max:10',
			'nb_status'         => 	'required|alpha_num|max:30',
			'in_grupo_status'   => 	'required|alpha_num|max:3',
			'nb_grupo_status'   => 	'required|alpha_num|max:30',
			'nb_status2'        => 	'required|alpha_num|max:30',
			'nu_orden'          => 	'required|integer|max:10',
			'nu_orden2'         => 	'required|integer|max:10',
			'id_usuario'        => 	'required|alpha_num|max:',
        ]);

        $status = $status->update($request->all());

        return [ 'msj' => 'Registro Editado' , compact('status')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status = $status->delete();
 
        return [ 'msj' => 'Registro Eliminado' , compact('status')];
    }
}
