<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDenunciumRequest;
use App\Http\Requests\UpdateDenunciumRequest;
use App\Http\Resources\Admin\DenunciumResource;
use App\Models\Denuncium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DenunciasApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('denuncium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DenunciumResource(Denuncium::with(['categories', 'tags'])->get());
    }

    public function store(StoreDenunciumRequest $request)
    {
        $denuncium = Denuncium::create($request->all());
        $denuncium->categories()->sync($request->input('categories', []));
        $denuncium->tags()->sync($request->input('tags', []));

        if ($request->input('photo', false)) {
            $denuncium->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new DenunciumResource($denuncium))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Denuncium $denuncium)
    {
        abort_if(Gate::denies('denuncium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DenunciumResource($denuncium->load(['categories', 'tags']));
    }

    public function update(UpdateDenunciumRequest $request, Denuncium $denuncium)
    {
        $denuncium->update($request->all());
        $denuncium->categories()->sync($request->input('categories', []));
        $denuncium->tags()->sync($request->input('tags', []));

        if ($request->input('photo', false)) {
            if (!$denuncium->photo || $request->input('photo') !== $denuncium->photo->file_name) {
                if ($denuncium->photo) {
                    $denuncium->photo->delete();
                }

                $denuncium->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($denuncium->photo) {
            $denuncium->photo->delete();
        }

        return (new DenunciumResource($denuncium))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Denuncium $denuncium)
    {
        abort_if(Gate::denies('denuncium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $denuncium->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
