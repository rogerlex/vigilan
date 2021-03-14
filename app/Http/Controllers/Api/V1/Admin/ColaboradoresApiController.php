<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreColaboradoreRequest;
use App\Http\Requests\UpdateColaboradoreRequest;
use App\Http\Resources\Admin\ColaboradoreResource;
use App\Models\Colaboradore;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ColaboradoresApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('colaboradore_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ColaboradoreResource(Colaboradore::with(['genero', 'formacao', 'cargo', 'departamentos'])->get());
    }

    public function store(StoreColaboradoreRequest $request)
    {
        $colaboradore = Colaboradore::create($request->all());
        $colaboradore->departamentos()->sync($request->input('departamentos', []));

        return (new ColaboradoreResource($colaboradore))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Colaboradore $colaboradore)
    {
        abort_if(Gate::denies('colaboradore_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ColaboradoreResource($colaboradore->load(['genero', 'formacao', 'cargo', 'departamentos']));
    }

    public function update(UpdateColaboradoreRequest $request, Colaboradore $colaboradore)
    {
        $colaboradore->update($request->all());
        $colaboradore->departamentos()->sync($request->input('departamentos', []));

        return (new ColaboradoreResource($colaboradore))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Colaboradore $colaboradore)
    {
        abort_if(Gate::denies('colaboradore_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $colaboradore->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
