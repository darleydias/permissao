<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permissao;

class PermissaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Permissao::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Permissao::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Permissao::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permissao =  Permissao::findOrFail($id);
        $permissao->update($request->all());
        return $permissao;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Permissao::destroy($id);
    }
}
