<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVisitumRequest;
use App\Http\Requests\StoreVisitumRequest;
use App\Http\Requests\UpdateVisitumRequest;
use App\Models\Colaboradore;
use App\Models\Estabelecimento;
use App\Models\Status;
use App\Models\Visitum;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VisitasController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('visitum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visita = Visitum::with(['estabelecimentos', 'equipes', 'status_visita'])->get();

        return view('admin.visita.index', compact('visita'));
    }

    public function create()
    {
        abort_if(Gate::denies('visitum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estabelecimentos = Estabelecimento::all()->pluck('razaosocial', 'id');

        $equipes = Colaboradore::all()->pluck('nome', 'id');

        $status_visitas = Status::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.visita.create', compact('estabelecimentos', 'equipes', 'status_visitas'));
    }

    public function store(StoreVisitumRequest $request)
    {
        $visitum = Visitum::create($request->all());
        $visitum->estabelecimentos()->sync($request->input('estabelecimentos', []));
        $visitum->equipes()->sync($request->input('equipes', []));

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $visitum->id]);
        }

        return redirect()->route('admin.visita.index');
    }

    public function edit(Visitum $visitum)
    {
        abort_if(Gate::denies('visitum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estabelecimentos = Estabelecimento::all()->pluck('razaosocial', 'id');

        $equipes = Colaboradore::all()->pluck('nome', 'id');

        $status_visitas = Status::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $visitum->load('estabelecimentos', 'equipes', 'status_visita');

        return view('admin.visita.edit', compact('estabelecimentos', 'equipes', 'status_visitas', 'visitum'));
    }

    public function update(UpdateVisitumRequest $request, Visitum $visitum)
    {
        $visitum->update($request->all());
        $visitum->estabelecimentos()->sync($request->input('estabelecimentos', []));
        $visitum->equipes()->sync($request->input('equipes', []));

        return redirect()->route('admin.visita.index');
    }

    public function show(Visitum $visitum)
    {
        abort_if(Gate::denies('visitum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visitum->load('estabelecimentos', 'equipes', 'status_visita');

        return view('admin.visita.show', compact('visitum'));
    }

    public function destroy(Visitum $visitum)
    {
        abort_if(Gate::denies('visitum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visitum->delete();

        return back();
    }

    public function massDestroy(MassDestroyVisitumRequest $request)
    {
        Visitum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('visitum_create') && Gate::denies('visitum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Visitum();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
