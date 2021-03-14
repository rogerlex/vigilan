<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRegDenunciumRequest;
use App\Http\Requests\StoreRegDenunciumRequest;
use App\Http\Requests\UpdateRegDenunciumRequest;
use App\Models\Categorium;
use App\Models\RegDenuncium;
use App\Models\Status;
use App\Models\Tag;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RegDenunciasController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('reg_denuncium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regDenuncia = RegDenuncium::with(['origem', 'categoria', 'status', 'media'])->get();

        return view('admin.regDenuncia.index', compact('regDenuncia'));
    }

    public function create()
    {
        abort_if(Gate::denies('reg_denuncium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $origems = Tag::all()->pluck('tag', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categorias = Categorium::all()->pluck('categoria', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.regDenuncia.create', compact('origems', 'categorias', 'statuses'));
    }

    public function store(StoreRegDenunciumRequest $request)
    {
        $regDenuncium = RegDenuncium::create($request->all());

        if ($request->input('imagens', false)) {
            $regDenuncium->addMedia(storage_path('tmp/uploads/' . basename($request->input('imagens'))))->toMediaCollection('imagens');
        }

        if ($request->input('anexo', false)) {
            $regDenuncium->addMedia(storage_path('tmp/uploads/' . basename($request->input('anexo'))))->toMediaCollection('anexo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $regDenuncium->id]);
        }

        return redirect()->route('admin.reg-denuncia.index');
    }

    public function edit(RegDenuncium $regDenuncium)
    {
        abort_if(Gate::denies('reg_denuncium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $origems = Tag::all()->pluck('tag', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categorias = Categorium::all()->pluck('categoria', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = Status::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $regDenuncium->load('origem', 'categoria', 'status');

        return view('admin.regDenuncia.edit', compact('origems', 'categorias', 'statuses', 'regDenuncium'));
    }

    public function update(UpdateRegDenunciumRequest $request, RegDenuncium $regDenuncium)
    {
        $regDenuncium->update($request->all());

        if ($request->input('imagens', false)) {
            if (!$regDenuncium->imagens || $request->input('imagens') !== $regDenuncium->imagens->file_name) {
                if ($regDenuncium->imagens) {
                    $regDenuncium->imagens->delete();
                }

                $regDenuncium->addMedia(storage_path('tmp/uploads/' . basename($request->input('imagens'))))->toMediaCollection('imagens');
            }
        } elseif ($regDenuncium->imagens) {
            $regDenuncium->imagens->delete();
        }

        if ($request->input('anexo', false)) {
            if (!$regDenuncium->anexo || $request->input('anexo') !== $regDenuncium->anexo->file_name) {
                if ($regDenuncium->anexo) {
                    $regDenuncium->anexo->delete();
                }

                $regDenuncium->addMedia(storage_path('tmp/uploads/' . basename($request->input('anexo'))))->toMediaCollection('anexo');
            }
        } elseif ($regDenuncium->anexo) {
            $regDenuncium->anexo->delete();
        }

        return redirect()->route('admin.reg-denuncia.index');
    }

    public function show(RegDenuncium $regDenuncium)
    {
        abort_if(Gate::denies('reg_denuncium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regDenuncium->load('origem', 'categoria', 'status');

        return view('admin.regDenuncia.show', compact('regDenuncium'));
    }

    public function destroy(RegDenuncium $regDenuncium)
    {
        abort_if(Gate::denies('reg_denuncium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regDenuncium->delete();

        return back();
    }

    public function massDestroy(MassDestroyRegDenunciumRequest $request)
    {
        RegDenuncium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('reg_denuncium_create') && Gate::denies('reg_denuncium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new RegDenuncium();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
