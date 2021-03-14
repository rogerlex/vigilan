<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBaixaduamRequest;
use App\Http\Requests\StoreBaixaduamRequest;
use App\Http\Requests\UpdateBaixaduamRequest;
use App\Models\Baixaduam;
use App\Models\Processo;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BaixaduamsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('baixaduam_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baixaduams = Baixaduam::with(['processos', 'media'])->get();

        return view('admin.baixaduams.index', compact('baixaduams'));
    }

    public function create()
    {
        abort_if(Gate::denies('baixaduam_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $processos = Processo::all()->pluck('numero_do_processo', 'id');

        return view('admin.baixaduams.create', compact('processos'));
    }

    public function store(StoreBaixaduamRequest $request)
    {
        $baixaduam = Baixaduam::create($request->all());
        $baixaduam->processos()->sync($request->input('processos', []));

        if ($request->input('comprovante', false)) {
            $baixaduam->addMedia(storage_path('tmp/uploads/' . basename($request->input('comprovante'))))->toMediaCollection('comprovante');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $baixaduam->id]);
        }

        return redirect()->route('admin.baixaduams.index');
    }

    public function edit(Baixaduam $baixaduam)
    {
        abort_if(Gate::denies('baixaduam_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $processos = Processo::all()->pluck('numero_do_processo', 'id');

        $baixaduam->load('processos');

        return view('admin.baixaduams.edit', compact('processos', 'baixaduam'));
    }

    public function update(UpdateBaixaduamRequest $request, Baixaduam $baixaduam)
    {
        $baixaduam->update($request->all());
        $baixaduam->processos()->sync($request->input('processos', []));

        if ($request->input('comprovante', false)) {
            if (!$baixaduam->comprovante || $request->input('comprovante') !== $baixaduam->comprovante->file_name) {
                if ($baixaduam->comprovante) {
                    $baixaduam->comprovante->delete();
                }

                $baixaduam->addMedia(storage_path('tmp/uploads/' . basename($request->input('comprovante'))))->toMediaCollection('comprovante');
            }
        } elseif ($baixaduam->comprovante) {
            $baixaduam->comprovante->delete();
        }

        return redirect()->route('admin.baixaduams.index');
    }

    public function show(Baixaduam $baixaduam)
    {
        abort_if(Gate::denies('baixaduam_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baixaduam->load('processos');

        return view('admin.baixaduams.show', compact('baixaduam'));
    }

    public function destroy(Baixaduam $baixaduam)
    {
        abort_if(Gate::denies('baixaduam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $baixaduam->delete();

        return back();
    }

    public function massDestroy(MassDestroyBaixaduamRequest $request)
    {
        Baixaduam::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('baixaduam_create') && Gate::denies('baixaduam_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Baixaduam();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
