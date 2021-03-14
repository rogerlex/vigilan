<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTiposProcessoRequest;
use App\Http\Requests\StoreTiposProcessoRequest;
use App\Http\Requests\UpdateTiposProcessoRequest;
use App\Models\TiposProcesso;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TiposProcessosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tipos_processo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tiposProcessos = TiposProcesso::all();

        return view('admin.tiposProcessos.index', compact('tiposProcessos'));
    }

    public function create()
    {
        abort_if(Gate::denies('tipos_processo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tiposProcessos.create');
    }

    public function store(StoreTiposProcessoRequest $request)
    {
        $tiposProcesso = TiposProcesso::create($request->all());

        return redirect()->route('admin.tipos-processos.index');
    }

    public function edit(TiposProcesso $tiposProcesso)
    {
        abort_if(Gate::denies('tipos_processo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tiposProcessos.edit', compact('tiposProcesso'));
    }

    public function update(UpdateTiposProcessoRequest $request, TiposProcesso $tiposProcesso)
    {
        $tiposProcesso->update($request->all());

        return redirect()->route('admin.tipos-processos.index');
    }

    public function show(TiposProcesso $tiposProcesso)
    {
        abort_if(Gate::denies('tipos_processo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tiposProcessos.show', compact('tiposProcesso'));
    }

    public function destroy(TiposProcesso $tiposProcesso)
    {
        abort_if(Gate::denies('tipos_processo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tiposProcesso->delete();

        return back();
    }

    public function massDestroy(MassDestroyTiposProcessoRequest $request)
    {
        TiposProcesso::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
