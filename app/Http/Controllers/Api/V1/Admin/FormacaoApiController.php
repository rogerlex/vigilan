<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormacaoRequest;
use App\Http\Requests\UpdateFormacaoRequest;
use App\Http\Resources\Admin\FormacaoResource;
use App\Models\Formacao;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormacaoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('formacao_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FormacaoResource(Formacao::all());
    }

    public function store(StoreFormacaoRequest $request)
    {
        $formacao = Formacao::create($request->all());

        return (new FormacaoResource($formacao))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Formacao $formacao)
    {
        abort_if(Gate::denies('formacao_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FormacaoResource($formacao);
    }

    public function update(UpdateFormacaoRequest $request, Formacao $formacao)
    {
        $formacao->update($request->all());

        return (new FormacaoResource($formacao))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Formacao $formacao)
    {
        abort_if(Gate::denies('formacao_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $formacao->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
