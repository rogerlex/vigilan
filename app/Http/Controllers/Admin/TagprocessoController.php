<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTagprocessoRequest;
use App\Http\Requests\StoreTagprocessoRequest;
use App\Http\Requests\UpdateTagprocessoRequest;
use App\Models\Tagprocesso;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TagprocessoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tagprocesso_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tagprocessos = Tagprocesso::all();

        return view('admin.tagprocessos.index', compact('tagprocessos'));
    }

    public function create()
    {
        abort_if(Gate::denies('tagprocesso_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tagprocessos.create');
    }

    public function store(StoreTagprocessoRequest $request)
    {
        $tagprocesso = Tagprocesso::create($request->all());

        return redirect()->route('admin.tagprocessos.index');
    }

    public function edit(Tagprocesso $tagprocesso)
    {
        abort_if(Gate::denies('tagprocesso_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tagprocessos.edit', compact('tagprocesso'));
    }

    public function update(UpdateTagprocessoRequest $request, Tagprocesso $tagprocesso)
    {
        $tagprocesso->update($request->all());

        return redirect()->route('admin.tagprocessos.index');
    }

    public function show(Tagprocesso $tagprocesso)
    {
        abort_if(Gate::denies('tagprocesso_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tagprocessos.show', compact('tagprocesso'));
    }

    public function destroy(Tagprocesso $tagprocesso)
    {
        abort_if(Gate::denies('tagprocesso_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tagprocesso->delete();

        return back();
    }

    public function massDestroy(MassDestroyTagprocessoRequest $request)
    {
        Tagprocesso::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
