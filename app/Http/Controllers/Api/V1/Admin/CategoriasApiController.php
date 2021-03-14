<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCategoriumRequest;
use App\Http\Requests\UpdateCategoriumRequest;
use App\Http\Resources\Admin\CategoriumResource;
use App\Models\Categorium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriasApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('categorium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CategoriumResource(Categorium::all());
    }

    public function store(StoreCategoriumRequest $request)
    {
        $categorium = Categorium::create($request->all());

        return (new CategoriumResource($categorium))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateCategoriumRequest $request, Categorium $categorium)
    {
        $categorium->update($request->all());

        return (new CategoriumResource($categorium))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Categorium $categorium)
    {
        abort_if(Gate::denies('categorium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categorium->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
