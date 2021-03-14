<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProcessoRequest;
use App\Http\Requests\StoreProcessoRequest;
use App\Http\Requests\UpdateProcessoRequest;
use App\Models\Estabelecimento;
use App\Models\Processo;
use App\Models\Status;
use App\Models\TiposProcesso;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProcessosController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('processo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $processos = Processo::with(['tipoprocesso', 'estabelecimentos', 'status_processo', 'media'])->get();

        return view('admin.processos.index', compact('processos'));
    }

    public function create()
    {
        abort_if(Gate::denies('processo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoprocessos = TiposProcesso::all()->pluck('tipoprocesso', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estabelecimentos = Estabelecimento::all()->pluck('cnpj', 'id');

        $status_processos = Status::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.processos.create', compact('tipoprocessos', 'estabelecimentos', 'status_processos'));
    }

    public function store(StoreProcessoRequest $request)
    {
        $processo = Processo::create($request->all());
        $processo->estabelecimentos()->sync($request->input('estabelecimentos', []));

        foreach ($request->input('anexo_processo', []) as $file) {
            $processo->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('anexo_processo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $processo->id]);
        }

        return redirect()->route('admin.processos.index');
    }

    public function edit(Processo $processo)
    {
        abort_if(Gate::denies('processo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoprocessos = TiposProcesso::all()->pluck('tipoprocesso', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estabelecimentos = Estabelecimento::all()->pluck('cnpj', 'id');

        $status_processos = Status::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $processo->load('tipoprocesso', 'estabelecimentos', 'status_processo');

        return view('admin.processos.edit', compact('tipoprocessos', 'estabelecimentos', 'status_processos', 'processo'));
    }

    public function update(UpdateProcessoRequest $request, Processo $processo)
    {
        $processo->update($request->all());
        $processo->estabelecimentos()->sync($request->input('estabelecimentos', []));

        if (count($processo->anexo_processo) > 0) {
            foreach ($processo->anexo_processo as $media) {
                if (!in_array($media->file_name, $request->input('anexo_processo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $processo->anexo_processo->pluck('file_name')->toArray();

        foreach ($request->input('anexo_processo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $processo->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('anexo_processo');
            }
        }

        return redirect()->route('admin.processos.index');
    }

    public function show(Processo $processo)
    {
        abort_if(Gate::denies('processo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $processo->load('tipoprocesso', 'estabelecimentos', 'status_processo');

        return view('admin.processos.show', compact('processo'));
    }

    public function destroy(Processo $processo)
    {
        abort_if(Gate::denies('processo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $processo->delete();

        return back();
    }

    public function massDestroy(MassDestroyProcessoRequest $request)
    {
        Processo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('processo_create') && Gate::denies('processo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Processo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
