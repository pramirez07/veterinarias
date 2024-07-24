<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Clinica;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::with('clinica')->get();
        return Inertia::render('Empleado/Index', 
        [
            "empleados" => $empleados,
        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clinicas = Clinica::select('id','nombre')->get();
        return Inertia::render('Empleado/Create', ['clinicas'=>$clinicas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => ['required','alpha_num:ascii','min:9','min:9', Rule::unique('empleados','dni')],
            'clinica' => 'required|numeric',
            'email' => ['required','string','lowercase','email','max:255', Rule::unique('empleados','email')],
            'telefono' => 'nullable|numeric|digits:9',
        ]);

        $empleado = Empleado::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'clinica_id' => $request->clinica,
            'email' => $request->email,
            'telefono' => $request->telefono,
        ]);

        return redirect(route('empleado.index', absolute: false));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);
        $clinicas = Clinica::select('id','nombre')->get();
        return Inertia::render('Empleado/Show',[ 
            'empleado' => $empleado,
            'clinicas' => $clinicas,
             'editMode'=>false
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $empleado = Empleado::find($id);
        $clinicas = Clinica::select('id','nombre')->get();
        return Inertia::render('Empleado/Show',[ 
            'empleado' => $empleado,
            'clinicas' => $clinicas,
            'editMode'=> true
        ]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) : RedirectResponse
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => ['required','alpha_num:ascii','min:9','min:9', Rule::unique('empleados','dni')->ignore($request->id)],
            'clinica' => 'required|numeric',
            'email' => ['required','string','lowercase','email','max:255', Rule::unique('empleados','email')->ignore($request->id)],
            'telefono' => 'nullable|numeric|digits:9',
        ]);

        $empleado = Empleado::find($request->id);

        $empleado->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'clinica_id' => $request->clinica,
            'email' => $request->email,
            'telefono' => $request->telefono,
        ]);

        return redirect(route('empleado.index', absolute: false));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        $empleado->delete();

        return $this->index();

    }
}
