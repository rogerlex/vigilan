<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagprocessoRequest;
use App\Http\Requests\UpdateTagprocessoRequest;
use App\Http\Resources\Admin\TagprocessoResource;
use App\Models\Tagprocesso;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TagprocessoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tagprocesso_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagprocessoResource(Tagprocesso::all());
    }

    public function store(StoreTagprocessoRequest $request)
    {
        $tagprocesso = Tagprocesso::create($request->all());

        return (new TagprocessoResource($tagprocesso))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Tagprocesso $tagprocesso)
    {
        abort_if(Gate::denies('tagprocesso_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagprocessoResource($tagprocesso);
    }

    public function update(UpdateTagprocessoRequest $request, Tagprocesso $tagprocesso)
    {
        $tagprocesso->update($request->all());

        return (new TagprocessoResource($tagprocesso))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Tagprocesso $tagprocesso)
    {
        abort_if(Gate::denies('tagprocesso_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tagprocesso->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
