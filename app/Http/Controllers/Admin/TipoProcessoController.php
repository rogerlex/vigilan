<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTipoProcessoRequest;
use App\Http\Requests\StoreTipoProcessoRequest;
use App\Http\Requests\UpdateTipoProcessoRequest;
use App\Models\TipoProcesso;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoProcessoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tipo_processo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoProcessos = TipoProcesso::all();

        return view('admin.tipoProcessos.index', compact('tipoProcessos'));
    }

    public function create()
    {
        abort_if(Gate::denies('tipo_processo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tipoProcessos.create');
    }

    public function store(StoreTipoProcessoRequest $request)
    {
        $tipoProcesso = TipoProcesso::create($request->all());

        return redirect()->route('admin.tipo-processos.index');
    }

    public function edit(TipoProcesso $tipoProcesso)
    {
        abort_if(Gate::denies('tipo_processo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tipoProcessos.edit', compact('tipoProcesso'));
    }

    public function update(UpdateTipoProcessoRequest $request, TipoProcesso $tipoProcesso)
    {
        $tipoProcesso->update($request->all());

        return redirect()->route('admin.tipo-processos.index');
    }

    public function show(TipoProcesso $tipoProcesso)
    {
        abort_if(Gate::denies('tipo_processo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tipoProcessos.show', compact('tipoProcesso'));
    }

    public function destroy(TipoProcesso $tipoProcesso)
    {
        abort_if(Gate::denies('tipo_processo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoProcesso->delete();

        return back();
    }

    public function massDestroy(MassDestroyTipoProcessoRequest $request)
    {
        TipoProcesso::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
