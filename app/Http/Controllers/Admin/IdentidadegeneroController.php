<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIdentidadegeneroRequest;
use App\Http\Requests\StoreIdentidadegeneroRequest;
use App\Http\Requests\UpdateIdentidadegeneroRequest;
use App\Models\Identidadegenero;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentidadegeneroController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('identidadegenero_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $identidadegeneros = Identidadegenero::all();

        return view('admin.identidadegeneros.index', compact('identidadegeneros'));
    }

    public function create()
    {
        abort_if(Gate::denies('identidadegenero_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.identidadegeneros.create');
    }

    public function store(StoreIdentidadegeneroRequest $request)
    {
        $identidadegenero = Identidadegenero::create($request->all());

        return redirect()->route('admin.identidadegeneros.index');
    }

    public function edit(Identidadegenero $identidadegenero)
    {
        abort_if(Gate::denies('identidadegenero_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.identidadegeneros.edit', compact('identidadegenero'));
    }

    public function update(UpdateIdentidadegeneroRequest $request, Identidadegenero $identidadegenero)
    {
        $identidadegenero->update($request->all());

        return redirect()->route('admin.identidadegeneros.index');
    }

    public function show(Identidadegenero $identidadegenero)
    {
        abort_if(Gate::denies('identidadegenero_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.identidadegeneros.show', compact('identidadegenero'));
    }

    public function destroy(Identidadegenero $identidadegenero)
    {
        abort_if(Gate::denies('identidadegenero_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $identidadegenero->delete();

        return back();
    }

    public function massDestroy(MassDestroyIdentidadegeneroRequest $request)
    {
        Identidadegenero::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
