<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTipoEstabelecimentoRequest;
use App\Http\Requests\StoreTipoEstabelecimentoRequest;
use App\Http\Requests\UpdateTipoEstabelecimentoRequest;
use App\Models\TipoEstabelecimento;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoEstabelecimentoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tipo_estabelecimento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoEstabelecimentos = TipoEstabelecimento::all();

        return view('admin.tipoEstabelecimentos.index', compact('tipoEstabelecimentos'));
    }

    public function create()
    {
        abort_if(Gate::denies('tipo_estabelecimento_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tipoEstabelecimentos.create');
    }

    public function store(StoreTipoEstabelecimentoRequest $request)
    {
        $tipoEstabelecimento = TipoEstabelecimento::create($request->all());

        return redirect()->route('admin.tipo-estabelecimentos.index');
    }

    public function edit(TipoEstabelecimento $tipoEstabelecimento)
    {
        abort_if(Gate::denies('tipo_estabelecimento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tipoEstabelecimentos.edit', compact('tipoEstabelecimento'));
    }

    public function update(UpdateTipoEstabelecimentoRequest $request, TipoEstabelecimento $tipoEstabelecimento)
    {
        $tipoEstabelecimento->update($request->all());

        return redirect()->route('admin.tipo-estabelecimentos.index');
    }

    public function show(TipoEstabelecimento $tipoEstabelecimento)
    {
        abort_if(Gate::denies('tipo_estabelecimento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tipoEstabelecimentos.show', compact('tipoEstabelecimento'));
    }

    public function destroy(TipoEstabelecimento $tipoEstabelecimento)
    {
        abort_if(Gate::denies('tipo_estabelecimento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoEstabelecimento->delete();

        return back();
    }

    public function massDestroy(MassDestroyTipoEstabelecimentoRequest $request)
    {
        TipoEstabelecimento::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
