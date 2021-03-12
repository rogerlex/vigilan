<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBairroRequest;
use App\Http\Requests\UpdateBairroRequest;
use App\Http\Resources\Admin\BairroResource;
use App\Models\Bairro;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BairroApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bairro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BairroResource(Bairro::all());
    }

    public function store(StoreBairroRequest $request)
    {
        $bairro = Bairro::create($request->all());

        return (new BairroResource($bairro))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bairro $bairro)
    {
        abort_if(Gate::denies('bairro_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BairroResource($bairro);
    }

    public function update(UpdateBairroRequest $request, Bairro $bairro)
    {
        $bairro->update($request->all());

        return (new BairroResource($bairro))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bairro $bairro)
    {
        abort_if(Gate::denies('bairro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bairro->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
