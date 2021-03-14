<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTipoestabelecimentoRequest;
use App\Http\Requests\UpdateTipoestabelecimentoRequest;
use App\Http\Resources\Admin\TipoestabelecimentoResource;
use App\Models\Tipoestabelecimento;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoestabelecimentosApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tipoestabelecimento_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TipoestabelecimentoResource(Tipoestabelecimento::all());
    }

    public function store(StoreTipoestabelecimentoRequest $request)
    {
        $tipoestabelecimento = Tipoestabelecimento::create($request->all());

        return (new TipoestabelecimentoResource($tipoestabelecimento))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Tipoestabelecimento $tipoestabelecimento)
    {
        abort_if(Gate::denies('tipoestabelecimento_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TipoestabelecimentoResource($tipoestabelecimento);
    }

    public function update(UpdateTipoestabelecimentoRequest $request, Tipoestabelecimento $tipoestabelecimento)
    {
        $tipoestabelecimento->update($request->all());

        return (new TipoestabelecimentoResource($tipoestabelecimento))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Tipoestabelecimento $tipoestabelecimento)
    {
        abort_if(Gate::denies('tipoestabelecimento_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoestabelecimento->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
