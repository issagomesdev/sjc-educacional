<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskTag;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::with(['status', 'tags', 'team', 'assinatura', 'media'])->get();

        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TaskTag::get();

        return view('admin.tasks.create', compact('statuses', 'tags'));
    }

    public function store(StoreTaskRequest $request)
    {


        $task = Task::create($request->all());
        $task->tags()->sync($request->input('tags', []));
        foreach ($request->input('attachment', []) as $file) {
            $task->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $task->id]);
        }

        return redirect()->route('admin.tasks.index');
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TaskTag::get();

        $task->load('status', 'tags', 'team', 'assinatura');

        return view('admin.tasks.edit', compact('statuses', 'tags', 'task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());
        $task->tags()->sync($request->input('tags', []));
        if (count($task->attachment) > 0) {
            foreach ($task->attachment as $media) {
                if (!in_array($media->file_name, $request->input('attachment', []))) {
                    $media->delete();
                }
            }
        }
        $media = $task->attachment->pluck('file_name')->toArray();
        foreach ($request->input('attachment', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $task->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachment');
            }
        }

        return redirect()->route('admin.tasks.index');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->load('status', 'tags', 'team', 'assinatura');

        return view('admin.tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskRequest $request)
    {
        Task::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('task_create') && Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Task();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
