<?php

namespace App\Http\Controllers;

use App\Models\Coa; // akses ke model coa
use App\Http\Requests\StoreCoaControllerRequest;
use App\Http\Requests\UpdateCoaControllerRequest;

class CoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ambil data dari obyek model coa
        $coa = Coa::all();
        return view('coa.view',
            [
                'coa' => $coa,
                'title' => 'Contoh M2',
                'nama' => 'Farel Prayoga'
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoaControllerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Coa $coa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coa $coa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoaControllerRequest $request, Coa $coa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coa $coa)
    {
        //
    }
}