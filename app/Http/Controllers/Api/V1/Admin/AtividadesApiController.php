<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAtividadeRequest;
use App\Http\Requests\UpdateAtividadeRequest;
use App\Http\Resources\Admin\AtividadeResource;
use App\Models\Atividade;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AtividadesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('atividade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AtividadeResource(Atividade::with(['numeroprocesso', 'tipo_de_processo', 'equipe_responsavels', 'status'])->get());
    }

    public function store(StoreAtividadeRequest $request)
    {
        $atividade = Atividade::create($request->all());
        $atividade->equipe_responsavels()->sync($request->input('equipe_responsavels', []));

        return (new AtividadeResource($atividade))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Atividade $atividade)
    {
        abort_if(Gate::denies('atividade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AtividadeResource($atividade->load(['numeroprocesso', 'tipo_de_processo', 'equipe_responsavels', 'status']));
    }

    public function update(UpdateAtividadeRequest $request, Atividade $atividade)
    {
        $atividade->update($request->all());
        $atividade->equipe_responsavels()->sync($request->input('equipe_responsavels', []));

        return (new AtividadeResource($atividade))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Atividade $atividade)
    {
        abort_if(Gate::denies('atividade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atividade->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
