<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrigenRequest;
use App\Http\Requests\UpdateOrigenRequest;
use App\Http\Resources\Admin\OrigenResource;
use App\Models\Origen;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrigensApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('origen_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OrigenResource(Origen::all());
    }

    public function store(StoreOrigenRequest $request)
    {
        $origen = Origen::create($request->all());

        return (new OrigenResource($origen))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateOrigenRequest $request, Origen $origen)
    {
        $origen->update($request->all());

        return (new OrigenResource($origen))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Origen $origen)
    {
        abort_if(Gate::denies('origen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $origen->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
