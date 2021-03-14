<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDepartamentoRequest;
use App\Http\Requests\StoreDepartamentoRequest;
use App\Http\Requests\UpdateDepartamentoRequest;
use App\Models\Departamento;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DepartamentosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('departamento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departamentos = Departamento::all();

        return view('admin.departamentos.index', compact('departamentos'));
    }

    public function create()
    {
        abort_if(Gate::denies('departamento_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.departamentos.create');
    }

    public function store(StoreDepartamentoRequest $request)
    {
        $departamento = Departamento::create($request->all());

        return redirect()->route('admin.departamentos.index');
    }

    public function edit(Departamento $departamento)
    {
        abort_if(Gate::denies('departamento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.departamentos.edit', compact('departamento'));
    }

    public function update(UpdateDepartamentoRequest $request, Departamento $departamento)
    {
        $departamento->update($request->all());

        return redirect()->route('admin.departamentos.index');
    }

    public function show(Departamento $departamento)
    {
        abort_if(Gate::denies('departamento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.departamentos.show', compact('departamento'));
    }

    public function destroy(Departamento $departamento)
    {
        abort_if(Gate::denies('departamento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departamento->delete();

        return back();
    }

    public function massDestroy(MassDestroyDepartamentoRequest $request)
    {
        Departamento::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
