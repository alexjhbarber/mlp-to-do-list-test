@extends('layouts.app')

@section('title', 'To Do Tasks')

@section('content')
<div class="row">
    <div class="col-sm-4">
        <form method="POST" action="{{ route('store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Insert Task Name" required />
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add</button>
        </form>
    </div>
    <div class="col-sm-8">
        <table class="table">
            <thead>
                <tr>
                    <th class="index-column">#</th>
                    <th class="task-column">Task</th>
                    <th class="actions-column"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td class="index">{{ $loop->index + 1 }}</td>
                        <td class="task">
                            <span class="task-name @if ($task->completed) strike-through @endif">
                                {{ $task->title }}
                            </span>
                        </td>
                        <td class="actions">
                            @unless ($task->completed)
                                <form method="POST" class="button" action="{{ route('update', $task) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="completed" value="1" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i></button>
                                </form>
                                <form method="POST" class="button" action="{{ route('destroy', $task) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                                </form>
                            @endunless
                        <td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
