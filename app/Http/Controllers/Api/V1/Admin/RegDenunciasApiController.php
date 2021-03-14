<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreRegDenunciumRequest;
use App\Http\Requests\UpdateRegDenunciumRequest;
use App\Http\Resources\Admin\RegDenunciumResource;
use App\Models\RegDenuncium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegDenunciasApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('reg_denuncium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RegDenunciumResource(RegDenuncium::with(['origem', 'categoria', 'status'])->get());
    }

    public function store(StoreRegDenunciumRequest $request)
    {
        $regDenuncium = RegDenuncium::create($request->all());

        if ($request->input('imagens', false)) {
            $regDenuncium->addMedia(storage_path('tmp/uploads/' . basename($request->input('imagens'))))->toMediaCollection('imagens');
        }

        if ($request->input('anexo', false)) {
            $regDenuncium->addMedia(storage_path('tmp/uploads/' . basename($request->input('anexo'))))->toMediaCollection('anexo');
        }

        return (new RegDenunciumResource($regDenuncium))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RegDenuncium $regDenuncium)
    {
        abort_if(Gate::denies('reg_denuncium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RegDenunciumResource($regDenuncium->load(['origem', 'categoria', 'status']));
    }

    public function update(UpdateRegDenunciumRequest $request, RegDenuncium $regDenuncium)
    {
        $regDenuncium->update($request->all());

        if ($request->input('imagens', false)) {
            if (!$regDenuncium->imagens || $request->input('imagens') !== $regDenuncium->imagens->file_name) {
                if ($regDenuncium->imagens) {
                    $regDenuncium->imagens->delete();
                }

                $regDenuncium->addMedia(storage_path('tmp/uploads/' . basename($request->input('imagens'))))->toMediaCollection('imagens');
            }
        } elseif ($regDenuncium->imagens) {
            $regDenuncium->imagens->delete();
        }

        if ($request->input('anexo', false)) {
            if (!$regDenuncium->anexo || $request->input('anexo') !== $regDenuncium->anexo->file_name) {
                if ($regDenuncium->anexo) {
                    $regDenuncium->anexo->delete();
                }

                $regDenuncium->addMedia(storage_path('tmp/uploads/' . basename($request->input('anexo'))))->toMediaCollection('anexo');
            }
        } elseif ($regDenuncium->anexo) {
            $regDenuncium->anexo->delete();
        }

        return (new RegDenunciumResource($regDenuncium))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RegDenuncium $regDenuncium)
    {
        abort_if(Gate::denies('reg_denuncium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regDenuncium->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
