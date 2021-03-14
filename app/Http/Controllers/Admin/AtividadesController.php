<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAtividadeRequest;
use App\Http\Requests\StoreAtividadeRequest;
use App\Http\Requests\UpdateAtividadeRequest;
use App\Models\Atividade;
use App\Models\Colaboradore;
use App\Models\Processo;
use App\Models\Status;
use App\Models\TiposProcesso;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AtividadesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('atividade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atividades = Atividade::with(['numeroprocesso', 'tipo_de_processo', 'equipe_responsavels', 'status'])->get();

        return view('admin.atividades.index', compact('atividades'));
    }

    public function create()
    {
        abort_if(Gate::denies('atividade_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $numeroprocessos = Processo::all()->pluck('numero_do_processo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tipo_de_processos = TiposProcesso::all()->pluck('tipoprocesso', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipe_responsavels = Colaboradore::all()->pluck('nome', 'id');

        $statuses = Status::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.atividades.create', compact('numeroprocessos', 'tipo_de_processos', 'equipe_responsavels', 'statuses'));
    }

    public function store(StoreAtividadeRequest $request)
    {
        $atividade = Atividade::create($request->all());
        $atividade->equipe_responsavels()->sync($request->input('equipe_responsavels', []));

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $atividade->id]);
        }

        return redirect()->route('admin.atividades.index');
    }

    public function edit(Atividade $atividade)
    {
        abort_if(Gate::denies('atividade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $numeroprocessos = Processo::all()->pluck('numero_do_processo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tipo_de_processos = TiposProcesso::all()->pluck('tipoprocesso', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipe_responsavels = Colaboradore::all()->pluck('nome', 'id');

        $statuses = Status::all()->pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $atividade->load('numeroprocesso', 'tipo_de_processo', 'equipe_responsavels', 'status');

        return view('admin.atividades.edit', compact('numeroprocessos', 'tipo_de_processos', 'equipe_responsavels', 'statuses', 'atividade'));
    }

    public function update(UpdateAtividadeRequest $request, Atividade $atividade)
    {
        $atividade->update($request->all());
        $atividade->equipe_responsavels()->sync($request->input('equipe_responsavels', []));

        return redirect()->route('admin.atividades.index');
    }

    public function show(Atividade $atividade)
    {
        abort_if(Gate::denies('atividade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atividade->load('numeroprocesso', 'tipo_de_processo', 'equipe_responsavels', 'status');

        return view('admin.atividades.show', compact('atividade'));
    }

    public function destroy(Atividade $atividade)
    {
        abort_if(Gate::denies('atividade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $atividade->delete();

        return back();
    }

    public function massDestroy(MassDestroyAtividadeRequest $request)
    {
        Atividade::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('atividade_create') && Gate::denies('atividade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Atividade();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
