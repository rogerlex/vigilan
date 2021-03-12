<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTipoProcessoRequest;
use App\Http\Requests\UpdateTipoProcessoRequest;
use App\Http\Resources\Admin\TipoProcessoResource;
use App\Models\TipoProcesso;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoProcessoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tipo_processo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TipoProcessoResource(TipoProcesso::all());
    }

    public function store(StoreTipoProcessoRequest $request)
    {
        $tipoProcesso = TipoProcesso::create($request->all());

        return (new TipoProcessoResource($tipoProcesso))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TipoProcesso $tipoProcesso)
    {
        abort_if(Gate::denies('tipo_processo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TipoProcessoResource($tipoProcesso);
    }

    public function update(UpdateTipoProcessoRequest $request, TipoProcesso $tipoProcesso)
    {
        $tipoProcesso->update($request->all());

        return (new TipoProcessoResource($tipoProcesso))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TipoProcesso $tipoProcesso)
    {
        abort_if(Gate::denies('tipo_processo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoProcesso->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
