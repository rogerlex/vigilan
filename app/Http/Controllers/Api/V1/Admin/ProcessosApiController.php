<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProcessoRequest;
use App\Http\Requests\UpdateProcessoRequest;
use App\Http\Resources\Admin\ProcessoResource;
use App\Models\Processo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProcessosApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('processo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProcessoResource(Processo::with(['tipoprocesso', 'estabelecimentos', 'status_processo'])->get());
    }

    public function store(StoreProcessoRequest $request)
    {
        $processo = Processo::create($request->all());
        $processo->estabelecimentos()->sync($request->input('estabelecimentos', []));

        if ($request->input('anexo_processo', false)) {
            $processo->addMedia(storage_path('tmp/uploads/' . basename($request->input('anexo_processo'))))->toMediaCollection('anexo_processo');
        }

        return (new ProcessoResource($processo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Processo $processo)
    {
        abort_if(Gate::denies('processo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProcessoResource($processo->load(['tipoprocesso', 'estabelecimentos', 'status_processo']));
    }

    public function update(UpdateProcessoRequest $request, Processo $processo)
    {
        $processo->update($request->all());
        $processo->estabelecimentos()->sync($request->input('estabelecimentos', []));

        if ($request->input('anexo_processo', false)) {
            if (!$processo->anexo_processo || $request->input('anexo_processo') !== $processo->anexo_processo->file_name) {
                if ($processo->anexo_processo) {
                    $processo->anexo_processo->delete();
                }

                $processo->addMedia(storage_path('tmp/uploads/' . basename($request->input('anexo_processo'))))->toMediaCollection('anexo_processo');
            }
        } elseif ($processo->anexo_processo) {
            $processo->anexo_processo->delete();
        }

        return (new ProcessoResource($processo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Processo $processo)
    {
        abort_if(Gate::denies('processo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $processo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
