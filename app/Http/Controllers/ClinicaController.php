<?php

namespace App\Http\Controllers;

use App\Models\Clinica;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;


class ClinicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinicas = Clinica::all();
        return Inertia::render('Clinica/Index', 
        [
            "clinicas" => $clinicas
        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Clinica/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.Clinica::class,
            'telefono' => 'nullable|numeric|digits:9',
        ]);

        $clinica = Clinica::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
        ]);

        return redirect(route('clinica.index', absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $clinica = Clinica::find($id);

        return Inertia::render('Clinica/Show',[ 'clinica' => $clinica, 'editMode'=>false]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $clinica = Clinica::find($id);

        return Inertia::render('Clinica/Show',[ 'clinica' => $clinica, 'editMode'=> true]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) : RedirectResponse
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => ['required','string','lowercase','email','max:255', Rule::unique('clinicas','email')->ignore($request->id)],
            'telefono' => 'nullable|numeric|digits:9',
        ]);

        $clinica = Clinica::find($request->id);

        $clinica->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
        ]);

        return redirect(route('clinica.index', absolute: false));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $clinica = Clinica::find($id);
        $clinica->delete();

        return $this->index();

    }
}
