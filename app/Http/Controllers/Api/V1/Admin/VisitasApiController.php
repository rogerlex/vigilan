<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreVisitumRequest;
use App\Http\Requests\UpdateVisitumRequest;
use App\Http\Resources\Admin\VisitumResource;
use App\Models\Visitum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VisitasApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('visitum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VisitumResource(Visitum::with(['estabelecimentos', 'equipes', 'status_visita'])->get());
    }

    public function store(StoreVisitumRequest $request)
    {
        $visitum = Visitum::create($request->all());
        $visitum->estabelecimentos()->sync($request->input('estabelecimentos', []));
        $visitum->equipes()->sync($request->input('equipes', []));

        return (new VisitumResource($visitum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Visitum $visitum)
    {
        abort_if(Gate::denies('visitum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VisitumResource($visitum->load(['estabelecimentos', 'equipes', 'status_visita']));
    }

    public function update(UpdateVisitumRequest $request, Visitum $visitum)
    {
        $visitum->update($request->all());
        $visitum->estabelecimentos()->sync($request->input('estabelecimentos', []));
        $visitum->equipes()->sync($request->input('equipes', []));

        return (new VisitumResource($visitum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Visitum $visitum)
    {
        abort_if(Gate::denies('visitum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visitum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
