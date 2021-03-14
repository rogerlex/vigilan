<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTipoestabelecimentoRequest;
use App\Http\Requests\StoreTipoestabelecimentoRequest;
use App\Http\Requests\UpdateTipoestabelecimentoRequest;
use App\Models\Tipoestabelecimento;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoestabelecimentosController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tipoestabelecimento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoestabelecimentos = Tipoestabelecimento::all();

        return view('admin.tipoestabelecimentos.index', compact('tipoestabelecimentos'));
    }

    public function create()
    {
        abort_if(Gate::denies('tipoestabelecimento_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tipoestabelecimentos.create');
    }

    public function store(StoreTipoestabelecimentoRequest $request)
    {
        $tipoestabelecimento = Tipoestabelecimento::create($request->all());

        return redirect()->route('admin.tipoestabelecimentos.index');
    }

    public function edit(Tipoestabelecimento $tipoestabelecimento)
    {
        abort_if(Gate::denies('tipoestabelecimento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tipoestabelecimentos.edit', compact('tipoestabelecimento'));
    }

    public function update(UpdateTipoestabelecimentoRequest $request, Tipoestabelecimento $tipoestabelecimento)
    {
        $tipoestabelecimento->update($request->all());

        return redirect()->route('admin.tipoestabelecimentos.index');
    }

    public function show(Tipoestabelecimento $tipoestabelecimento)
    {
        abort_if(Gate::denies('tipoestabelecimento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tipoestabelecimentos.show', compact('tipoestabelecimento'));
    }

    public function destroy(Tipoestabelecimento $tipoestabelecimento)
    {
        abort_if(Gate::denies('tipoestabelecimento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoestabelecimento->delete();

        return back();
    }

    public function massDestroy(MassDestroyTipoestabelecimentoRequest $request)
    {
        Tipoestabelecimento::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
