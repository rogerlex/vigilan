<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEstabelecimentoRequest;
use App\Http\Requests\StoreEstabelecimentoRequest;
use App\Http\Requests\UpdateEstabelecimentoRequest;
use App\Models\Bairro;
use App\Models\Estabelecimento;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EstabelecimentoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('estabelecimento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estabelecimentos = Estabelecimento::with(['bairro'])->get();

        return view('admin.estabelecimentos.index', compact('estabelecimentos'));
    }

    public function create()
    {
        abort_if(Gate::denies('estabelecimento_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bairros = Bairro::all()->pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.estabelecimentos.create', compact('bairros'));
    }

    public function store(StoreEstabelecimentoRequest $request)
    {
        $estabelecimento = Estabelecimento::create($request->all());

        return redirect()->route('admin.estabelecimentos.index');
    }

    public function edit(Estabelecimento $estabelecimento)
    {
        abort_if(Gate::denies('estabelecimento_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bairros = Bairro::all()->pluck('nome', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estabelecimento->load('bairro');

        return view('admin.estabelecimentos.edit', compact('bairros', 'estabelecimento'));
    }

    public function update(UpdateEstabelecimentoRequest $request, Estabelecimento $estabelecimento)
    {
        $estabelecimento->update($request->all());

        return redirect()->route('admin.estabelecimentos.index');
    }

    public function show(Estabelecimento $estabelecimento)
    {
        abort_if(Gate::denies('estabelecimento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estabelecimento->load('bairro');

        return view('admin.estabelecimentos.show', compact('estabelecimento'));
    }

    public function destroy(Estabelecimento $estabelecimento)
    {
        abort_if(Gate::denies('estabelecimento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estabelecimento->delete();

        return back();
    }

    public function massDestroy(MassDestroyEstabelecimentoRequest $request)
    {
        Estabelecimento::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
