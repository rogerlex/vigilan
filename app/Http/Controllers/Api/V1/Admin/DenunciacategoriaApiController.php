<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDenunciacategoriumRequest;
use App\Http\Requests\UpdateDenunciacategoriumRequest;
use App\Http\Resources\Admin\DenunciacategoriumResource;
use App\Models\Denunciacategorium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DenunciacategoriaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('denunciacategorium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DenunciacategoriumResource(Denunciacategorium::all());
    }

    public function store(StoreDenunciacategoriumRequest $request)
    {
        $denunciacategorium = Denunciacategorium::create($request->all());

        return (new DenunciacategoriumResource($denunciacategorium))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Denunciacategorium $denunciacategorium)
    {
        abort_if(Gate::denies('denunciacategorium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DenunciacategoriumResource($denunciacategorium);
    }

    public function update(UpdateDenunciacategoriumRequest $request, Denunciacategorium $denunciacategorium)
    {
        $denunciacategorium->update($request->all());

        return (new DenunciacategoriumResource($denunciacategorium))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Denunciacategorium $denunciacategorium)
    {
        abort_if(Gate::denies('denunciacategorium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $denunciacategorium->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
