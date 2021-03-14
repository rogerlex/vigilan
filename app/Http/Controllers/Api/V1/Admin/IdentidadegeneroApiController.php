<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIdentidadegeneroRequest;
use App\Http\Requests\UpdateIdentidadegeneroRequest;
use App\Http\Resources\Admin\IdentidadegeneroResource;
use App\Models\Identidadegenero;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentidadegeneroApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('identidadegenero_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IdentidadegeneroResource(Identidadegenero::all());
    }

    public function store(StoreIdentidadegeneroRequest $request)
    {
        $identidadegenero = Identidadegenero::create($request->all());

        return (new IdentidadegeneroResource($identidadegenero))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Identidadegenero $identidadegenero)
    {
        abort_if(Gate::denies('identidadegenero_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IdentidadegeneroResource($identidadegenero);
    }

    public function update(UpdateIdentidadegeneroRequest $request, Identidadegenero $identidadegenero)
    {
        $identidadegenero->update($request->all());

        return (new IdentidadegeneroResource($identidadegenero))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Identidadegenero $identidadegenero)
    {
        abort_if(Gate::denies('identidadegenero_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $identidadegenero->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
