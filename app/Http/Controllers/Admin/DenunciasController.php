<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDenunciumRequest;
use App\Http\Requests\StoreDenunciumRequest;
use App\Http\Requests\UpdateDenunciumRequest;
use App\Models\Denunciacategorium;
use App\Models\Denuncium;
use App\Models\TagsDenuncium;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DenunciasController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('denuncium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $denuncia = Denuncium::with(['categories', 'tags', 'media'])->get();

        return view('admin.denuncia.index', compact('denuncia'));
    }

    public function create()
    {
        abort_if(Gate::denies('denuncium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Denunciacategorium::all()->pluck('name', 'id');

        $tags = TagsDenuncium::all()->pluck('name', 'id');

        return view('admin.denuncia.create', compact('categories', 'tags'));
    }

    public function store(StoreDenunciumRequest $request)
    {
        $denuncium = Denuncium::create($request->all());
        $denuncium->categories()->sync($request->input('categories', []));
        $denuncium->tags()->sync($request->input('tags', []));

        foreach ($request->input('photo', []) as $file) {
            $denuncium->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $denuncium->id]);
        }

        return redirect()->route('admin.denuncia.index');
    }

    public function edit(Denuncium $denuncium)
    {
        abort_if(Gate::denies('denuncium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Denunciacategorium::all()->pluck('name', 'id');

        $tags = TagsDenuncium::all()->pluck('name', 'id');

        $denuncium->load('categories', 'tags');

        return view('admin.denuncia.edit', compact('categories', 'tags', 'denuncium'));
    }

    public function update(UpdateDenunciumRequest $request, Denuncium $denuncium)
    {
        $denuncium->update($request->all());
        $denuncium->categories()->sync($request->input('categories', []));
        $denuncium->tags()->sync($request->input('tags', []));

        if (count($denuncium->photo) > 0) {
            foreach ($denuncium->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $denuncium->photo->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $denuncium->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
            }
        }

        return redirect()->route('admin.denuncia.index');
    }

    public function show(Denuncium $denuncium)
    {
        abort_if(Gate::denies('denuncium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $denuncium->load('categories', 'tags');

        return view('admin.denuncia.show', compact('denuncium'));
    }

    public function destroy(Denuncium $denuncium)
    {
        abort_if(Gate::denies('denuncium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $denuncium->delete();

        return back();
    }

    public function massDestroy(MassDestroyDenunciumRequest $request)
    {
        Denuncium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('denuncium_create') && Gate::denies('denuncium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Denuncium();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
