<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBaixaduamRequest;
use App\Http\Requests\UpdateBaixaduamRequest;
use App\Http\Resources\Admin\BaixaduamResource;
use App\Models\Baixaduam;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BaixaduamsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('baixaduam_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BaixaduamResource(Baixaduam::with(['processos'])->get());
    }

    public function store(StoreBaixaduamRequest $request)
    {
        $baixaduam = Baixaduam::create($request->all());
        $baixaduam->processos()->sync($request->input('processos', []));

        if ($request->input('comprovante', false)) {
            $baixaduam->addMedia(storage_path('tmp/uploads/' . basename($request->input('comprovante'))))->toMediaCollection('comprovante');
        }

        return (new BaixaduamResource($baixaduam))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Baixaduam $baixaduam)
    {
        abort_if(Gate::denies('baixaduam_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BaixaduamResource($baixaduam->load(['processos']));
    }

    public function update(UpdateBaixaduamRequest $request, Baixaduam $baixaduam)
    {
        $baixaduam->update($request->all());
        $baixaduam->processos()->sync($request->input('processos', []));

        if ($request->input('comprovante', false)) {
            if (!$baixaduam->comprovante || $request->input('comprovante') !== $baixaduam->comprovante->file_name) {
                if ($baixaduam->comprovante) {
                    $baixaduam->comprovante->delete();
                }

                $baixaduam->addMedia(storage_path('tmp/uploads/' . basename($request->input('comprovante'))))->toMediaCollection('comprovante');
            }
        } elseif ($baixaduam->comprovante) {
            $baixaduam->comprovante->delete();
        }

        return (new BaixaduamResource($baixaduam))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Baixaduam $baixaduam)
    {
        abort_if(Gate::denies('baixaduam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baixaduam->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
