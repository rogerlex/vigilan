<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrigenRequest;
use App\Http\Requests\StoreOrigenRequest;
use App\Http\Requests\UpdateOrigenRequest;
use App\Models\Origen;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrigensController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('origen_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $origens = Origen::all();

        return view('admin.origens.index', compact('origens'));
    }

    public function create()
    {
        abort_if(Gate::denies('origen_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.origens.create');
    }

    public function store(StoreOrigenRequest $request)
    {
        $origen = Origen::create($request->all());

        return redirect()->route('admin.origens.index');
    }

    public function edit(Origen $origen)
    {
        abort_if(Gate::denies('origen_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.origens.edit', compact('origen'));
    }

    public function update(UpdateOrigenRequest $request, Origen $origen)
    {
        $origen->update($request->all());

        return redirect()->route('admin.origens.index');
    }

    public function destroy(Origen $origen)
    {
        abort_if(Gate::denies('origen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $origen->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrigenRequest $request)
    {
        Origen::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
