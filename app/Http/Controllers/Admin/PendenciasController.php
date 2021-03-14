<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPendenciumRequest;
use App\Http\Requests\StorePendenciumRequest;
use App\Http\Requests\UpdatePendenciumRequest;
use App\Models\Estabelecimento;
use App\Models\Pendencium;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PendenciasController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pendencium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pendencia = Pendencium::with(['idestabelecimento'])->get();

        return view('admin.pendencia.index', compact('pendencia'));
    }

    public function create()
    {
        abort_if(Gate::denies('pendencium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $idestabelecimentos = Estabelecimento::all()->pluck('razaosocial', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pendencia.create', compact('idestabelecimentos'));
    }

    public function store(StorePendenciumRequest $request)
    {
        $pendencium = Pendencium::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pendencium->id]);
        }

        return redirect()->route('admin.pendencia.index');
    }

    public function edit(Pendencium $pendencium)
    {
        abort_if(Gate::denies('pendencium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $idestabelecimentos = Estabelecimento::all()->pluck('razaosocial', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pendencium->load('idestabelecimento');

        return view('admin.pendencia.edit', compact('idestabelecimentos', 'pendencium'));
    }

    public function update(UpdatePendenciumRequest $request, Pendencium $pendencium)
    {
        $pendencium->update($request->all());

        return redirect()->route('admin.pendencia.index');
    }

    public function show(Pendencium $pendencium)
    {
        abort_if(Gate::denies('pendencium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pendencium->load('idestabelecimento');

        return view('admin.pendencia.show', compact('pendencium'));
    }

    public function destroy(Pendencium $pendencium)
    {
        abort_if(Gate::denies('pendencium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pendencium->delete();

        return back();
    }

    public function massDestroy(MassDestroyPendenciumRequest $request)
    {
        Pendencium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('pendencium_create') && Gate::denies('pendencium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Pendencium();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
