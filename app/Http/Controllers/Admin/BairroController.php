<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBairroRequest;
use App\Http\Requests\StoreBairroRequest;
use App\Http\Requests\UpdateBairroRequest;
use App\Models\Bairro;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BairroController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bairro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bairros = Bairro::all();

        return view('admin.bairros.index', compact('bairros'));
    }

    public function create()
    {
        abort_if(Gate::denies('bairro_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bairros.create');
    }

    public function store(StoreBairroRequest $request)
    {
        $bairro = Bairro::create($request->all());

        return redirect()->route('admin.bairros.index');
    }

    public function edit(Bairro $bairro)
    {
        abort_if(Gate::denies('bairro_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bairros.edit', compact('bairro'));
    }

    public function update(UpdateBairroRequest $request, Bairro $bairro)
    {
        $bairro->update($request->all());

        return redirect()->route('admin.bairros.index');
    }

    public function show(Bairro $bairro)
    {
        abort_if(Gate::denies('bairro_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bairros.show', compact('bairro'));
    }

    public function destroy(Bairro $bairro)
    {
        abort_if(Gate::denies('bairro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bairro->delete();

        return back();
    }

    public function massDestroy(MassDestroyBairroRequest $request)
    {
        Bairro::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
