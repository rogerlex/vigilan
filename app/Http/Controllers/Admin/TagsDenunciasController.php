<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTagsDenunciumRequest;
use App\Http\Requests\StoreTagsDenunciumRequest;
use App\Http\Requests\UpdateTagsDenunciumRequest;
use App\Models\TagsDenuncium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TagsDenunciasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tags_denuncium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tagsDenuncia = TagsDenuncium::all();

        return view('admin.tagsDenuncia.index', compact('tagsDenuncia'));
    }

    public function create()
    {
        abort_if(Gate::denies('tags_denuncium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tagsDenuncia.create');
    }

    public function store(StoreTagsDenunciumRequest $request)
    {
        $tagsDenuncium = TagsDenuncium::create($request->all());

        return redirect()->route('admin.tags-denuncia.index');
    }

    public function edit(TagsDenuncium $tagsDenuncium)
    {
        abort_if(Gate::denies('tags_denuncium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tagsDenuncia.edit', compact('tagsDenuncium'));
    }

    public function update(UpdateTagsDenunciumRequest $request, TagsDenuncium $tagsDenuncium)
    {
        $tagsDenuncium->update($request->all());

        return redirect()->route('admin.tags-denuncia.index');
    }

    public function show(TagsDenuncium $tagsDenuncium)
    {
        abort_if(Gate::denies('tags_denuncium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tagsDenuncia.show', compact('tagsDenuncium'));
    }

    public function destroy(TagsDenuncium $tagsDenuncium)
    {
        abort_if(Gate::denies('tags_denuncium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tagsDenuncium->delete();

        return back();
    }

    public function massDestroy(MassDestroyTagsDenunciumRequest $request)
    {
        TagsDenuncium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
