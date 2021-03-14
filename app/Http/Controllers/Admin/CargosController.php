<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCargoRequest;
use App\Http\Requests\StoreCargoRequest;
use App\Http\Requests\UpdateCargoRequest;
use App\Models\Cargo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CargosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cargo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cargos = Cargo::all();

        return view('admin.cargos.index', compact('cargos'));
    }

    public function create()
    {
        abort_if(Gate::denies('cargo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cargos.create');
    }

    public function store(StoreCargoRequest $request)
    {
        $cargo = Cargo::create($request->all());

        return redirect()->route('admin.cargos.index');
    }

    public function edit(Cargo $cargo)
    {
        abort_if(Gate::denies('cargo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cargos.edit', compact('cargo'));
    }

    public function update(UpdateCargoRequest $request, Cargo $cargo)
    {
        $cargo->update($request->all());

        return redirect()->route('admin.cargos.index');
    }

    public function show(Cargo $cargo)
    {
        abort_if(Gate::denies('cargo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cargos.show', compact('cargo'));
    }

    public function destroy(Cargo $cargo)
    {
        abort_if(Gate::denies('cargo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cargo->delete();

        return back();
    }

    public function massDestroy(MassDestroyCargoRequest $request)
    {
        Cargo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
