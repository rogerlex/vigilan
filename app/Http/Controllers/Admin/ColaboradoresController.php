<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyColaboradoreRequest;
use App\Http\Requests\StoreColaboradoreRequest;
use App\Http\Requests\UpdateColaboradoreRequest;
use App\Models\Cargo;
use App\Models\Colaboradore;
use App\Models\Departamento;
use App\Models\Formacao;
use App\Models\Identidadegenero;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ColaboradoresController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('colaboradore_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $colaboradores = Colaboradore::with(['genero', 'formacao', 'cargo', 'departamentos'])->get();

        return view('admin.colaboradores.index', compact('colaboradores'));
    }

    public function create()
    {
        abort_if(Gate::denies('colaboradore_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $generos = Identidadegenero::all()->pluck('genero', 'id')->prepend(trans('global.pleaseSelect'), '');

        $formacaos = Formacao::all()->pluck('formacao', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cargos = Cargo::all()->pluck('gargo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departamentos = Departamento::all()->pluck('departamento', 'id');

        return view('admin.colaboradores.create', compact('generos', 'formacaos', 'cargos', 'departamentos'));
    }

    public function store(StoreColaboradoreRequest $request)
    {
        $colaboradore = Colaboradore::create($request->all());
        $colaboradore->departamentos()->sync($request->input('departamentos', []));

        return redirect()->route('admin.colaboradores.index');
    }

    public function edit(Colaboradore $colaboradore)
    {
        abort_if(Gate::denies('colaboradore_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $generos = Identidadegenero::all()->pluck('genero', 'id')->prepend(trans('global.pleaseSelect'), '');

        $formacaos = Formacao::all()->pluck('formacao', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cargos = Cargo::all()->pluck('gargo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $departamentos = Departamento::all()->pluck('departamento', 'id');

        $colaboradore->load('genero', 'formacao', 'cargo', 'departamentos');

        return view('admin.colaboradores.edit', compact('generos', 'formacaos', 'cargos', 'departamentos', 'colaboradore'));
    }

    public function update(UpdateColaboradoreRequest $request, Colaboradore $colaboradore)
    {
        $colaboradore->update($request->all());
        $colaboradore->departamentos()->sync($request->input('departamentos', []));

        return redirect()->route('admin.colaboradores.index');
    }

    public function show(Colaboradore $colaboradore)
    {
        abort_if(Gate::denies('colaboradore_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $colaboradore->load('genero', 'formacao', 'cargo', 'departamentos');

        return view('admin.colaboradores.show', compact('colaboradore'));
    }

    public function destroy(Colaboradore $colaboradore)
    {
        abort_if(Gate::denies('colaboradore_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $colaboradore->delete();

        return back();
    }

    public function massDestroy(MassDestroyColaboradoreRequest $request)
    {
        Colaboradore::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
