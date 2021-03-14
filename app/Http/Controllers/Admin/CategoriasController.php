<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCategoriumRequest;
use App\Http\Requests\StoreCategoriumRequest;
use App\Http\Requests\UpdateCategoriumRequest;
use App\Models\Categorium;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CategoriasController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('categorium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categoria = Categorium::all();

        return view('admin.categoria.index', compact('categoria'));
    }

    public function create()
    {
        abort_if(Gate::denies('categorium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoria.create');
    }

    public function store(StoreCategoriumRequest $request)
    {
        $categorium = Categorium::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $categorium->id]);
        }

        return redirect()->route('admin.categoria.index');
    }

    public function edit(Categorium $categorium)
    {
        abort_if(Gate::denies('categorium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoria.edit', compact('categorium'));
    }

    public function update(UpdateCategoriumRequest $request, Categorium $categorium)
    {
        $categorium->update($request->all());

        return redirect()->route('admin.categoria.index');
    }

    public function destroy(Categorium $categorium)
    {
        abort_if(Gate::denies('categorium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categorium->delete();

        return back();
    }

    public function massDestroy(MassDestroyCategoriumRequest $request)
    {
        Categorium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('categorium_create') && Gate::denies('categorium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Categorium();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
