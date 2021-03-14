<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEstabelecimentoRequest;
use App\Http\Requests\UpdateEstabelecimentoRequest;
use App\Http\Resources\Admin\EstabelecimentoResource;
use App\Models\Estabelecimento;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EstabelecimentosApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('estabelecimento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EstabelecimentoResource(Estabelecimento::with(['bairro'])->get());
    }

    public function store(StoreEstabelecimentoRequest $request)
    {
        $estabelecimento = Estabelecimento::create($request->all());

        return (new EstabelecimentoResource($estabelecimento))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Estabelecimento $estabelecimento)
    {
        abort_if(Gate::denies('estabelecimento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EstabelecimentoResource($estabelecimento->load(['bairro']));
    }

    public function update(UpdateEstabelecimentoRequest $request, Estabelecimento $estabelecimento)
    {
        $estabelecimento->update($request->all());

        return (new EstabelecimentoResource($estabelecimento))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Estabelecimento $estabelecimento)
    {
        abort_if(Gate::denies('estabelecimento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estabelecimento->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
