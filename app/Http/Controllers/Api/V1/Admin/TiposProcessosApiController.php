<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTiposProcessoRequest;
use App\Http\Requests\UpdateTiposProcessoRequest;
use App\Http\Resources\Admin\TiposProcessoResource;
use App\Models\TiposProcesso;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TiposProcessosApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tipos_processo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TiposProcessoResource(TiposProcesso::all());
    }

    public function store(StoreTiposProcessoRequest $request)
    {
        $tiposProcesso = TiposProcesso::create($request->all());

        return (new TiposProcessoResource($tiposProcesso))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TiposProcesso $tiposProcesso)
    {
        abort_if(Gate::denies('tipos_processo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TiposProcessoResource($tiposProcesso);
    }

    public function update(UpdateTiposProcessoRequest $request, TiposProcesso $tiposProcesso)
    {
        $tiposProcesso->update($request->all());

        return (new TiposProcessoResource($tiposProcesso))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TiposProcesso $tiposProcesso)
    {
        abort_if(Gate::denies('tipos_processo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tiposProcesso->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
