<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagsDenunciumRequest;
use App\Http\Requests\UpdateTagsDenunciumRequest;
use App\Http\Resources\Admin\TagsDenunciumResource;
use App\Models\TagsDenuncium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TagsDenunciasApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tags_denuncium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagsDenunciumResource(TagsDenuncium::all());
    }

    public function store(StoreTagsDenunciumRequest $request)
    {
        $tagsDenuncium = TagsDenuncium::create($request->all());

        return (new TagsDenunciumResource($tagsDenuncium))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TagsDenuncium $tagsDenuncium)
    {
        abort_if(Gate::denies('tags_denuncium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TagsDenunciumResource($tagsDenuncium);
    }

    public function update(UpdateTagsDenunciumRequest $request, TagsDenuncium $tagsDenuncium)
    {
        $tagsDenuncium->update($request->all());

        return (new TagsDenunciumResource($tagsDenuncium))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TagsDenuncium $tagsDenuncium)
    {
        abort_if(Gate::denies('tags_denuncium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tagsDenuncium->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
