<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTipoEstabelecimentoRequest;
use App\Http\Requests\UpdateTipoEstabelecimentoRequest;
use App\Http\Resources\Admin\TipoEstabelecimentoResource;
use App\Models\TipoEstabelecimento;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoEstabelecimentoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tipo_estabelecimento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TipoEstabelecimentoResource(TipoEstabelecimento::all());
    }

    public function store(StoreTipoEstabelecimentoRequest $request)
    {
        $tipoEstabelecimento = TipoEstabelecimento::create($request->all());

        return (new TipoEstabelecimentoResource($tipoEstabelecimento))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TipoEstabelecimento $tipoEstabelecimento)
    {
        abort_if(Gate::denies('tipo_estabelecimento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TipoEstabelecimentoResource($tipoEstabelecimento);
    }

    public function update(UpdateTipoEstabelecimentoRequest $request, TipoEstabelecimento $tipoEstabelecimento)
    {
        $tipoEstabelecimento->update($request->all());

        return (new TipoEstabelecimentoResource($tipoEstabelecimento))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TipoEstabelecimento $tipoEstabelecimento)
    {
        abort_if(Gate::denies('tipo_estabelecimento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoEstabelecimento->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
