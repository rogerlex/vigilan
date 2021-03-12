<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDenunciacategoriumRequest;
use App\Http\Requests\StoreDenunciacategoriumRequest;
use App\Http\Requests\UpdateDenunciacategoriumRequest;
use App\Models\Denunciacategorium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DenunciacategoriaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('denunciacategorium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $denunciacategoria = Denunciacategorium::all();

        return view('admin.denunciacategoria.index', compact('denunciacategoria'));
    }

    public function create()
    {
        abort_if(Gate::denies('denunciacategorium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.denunciacategoria.create');
    }

    public function store(StoreDenunciacategoriumRequest $request)
    {
        $denunciacategorium = Denunciacategorium::create($request->all());

        return redirect()->route('admin.denunciacategoria.index');
    }

    public function edit(Denunciacategorium $denunciacategorium)
    {
        abort_if(Gate::denies('denunciacategorium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.denunciacategoria.edit', compact('denunciacategorium'));
    }

    public function update(UpdateDenunciacategoriumRequest $request, Denunciacategorium $denunciacategorium)
    {
        $denunciacategorium->update($request->all());

        return redirect()->route('admin.denunciacategoria.index');
    }

    public function show(Denunciacategorium $denunciacategorium)
    {
        abort_if(Gate::denies('denunciacategorium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.denunciacategoria.show', compact('denunciacategorium'));
    }

    public function destroy(Denunciacategorium $denunciacategorium)
    {
        abort_if(Gate::denies('denunciacategorium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $denunciacategorium->delete();

        return back();
    }

    public function massDestroy(MassDestroyDenunciacategoriumRequest $request)
    {
        Denunciacategorium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
