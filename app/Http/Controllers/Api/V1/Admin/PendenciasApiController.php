<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePendenciumRequest;
use App\Http\Requests\UpdatePendenciumRequest;
use App\Http\Resources\Admin\PendenciumResource;
use App\Models\Pendencium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PendenciasApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pendencium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PendenciumResource(Pendencium::with(['idestabelecimento'])->get());
    }

    public function store(StorePendenciumRequest $request)
    {
        $pendencium = Pendencium::create($request->all());

        return (new PendenciumResource($pendencium))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pendencium $pendencium)
    {
        abort_if(Gate::denies('pendencium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PendenciumResource($pendencium->load(['idestabelecimento']));
    }

    public function update(UpdatePendenciumRequest $request, Pendencium $pendencium)
    {
        $pendencium->update($request->all());

        return (new PendenciumResource($pendencium))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pendencium $pendencium)
    {
        abort_if(Gate::denies('pendencium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pendencium->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
