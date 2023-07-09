<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionalidade;

class FuncionalidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Funcionalidade::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Funcionalidade::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Funcionalidade::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $func =  Funcionalidade::findOrFail($id);
        $func->update($request->all());
        return $func;
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Funcionalidade::destroy($id);
    }
}
