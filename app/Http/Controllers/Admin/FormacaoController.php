<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFormacaoRequest;
use App\Http\Requests\StoreFormacaoRequest;
use App\Http\Requests\UpdateFormacaoRequest;
use App\Models\Formacao;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormacaoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('formacao_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formacaos = Formacao::all();

        return view('admin.formacaos.index', compact('formacaos'));
    }

    public function create()
    {
        abort_if(Gate::denies('formacao_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.formacaos.create');
    }

    public function store(StoreFormacaoRequest $request)
    {
        $formacao = Formacao::create($request->all());

        return redirect()->route('admin.formacaos.index');
    }

    public function edit(Formacao $formacao)
    {
        abort_if(Gate::denies('formacao_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.formacaos.edit', compact('formacao'));
    }

    public function update(UpdateFormacaoRequest $request, Formacao $formacao)
    {
        $formacao->update($request->all());

        return redirect()->route('admin.formacaos.index');
    }

    public function show(Formacao $formacao)
    {
        abort_if(Gate::denies('formacao_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.formacaos.show', compact('formacao'));
    }

    public function destroy(Formacao $formacao)
    {
        abort_if(Gate::denies('formacao_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formacao->delete();

        return back();
    }

    public function massDestroy(MassDestroyFormacaoRequest $request)
    {
        Formacao::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
