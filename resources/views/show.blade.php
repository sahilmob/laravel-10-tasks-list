@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div>
        <a href="{{ route('tasks.index') }}">Back</a>
    </div>
    <p>{{ $task->description }}</p>
    @isset($task->long_description)
        <p>{{ $task->long_description }}</p>
    @endisset
    <p>{{ $task->created_at }}</p>
    <p>{{ $task->updated_at }}</p>
    <div>
        <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task->id]) }}">
            @csrf
            @method('PUT')
            <button type="submit">{{ $task->completed ? 'Mark Incomplete' : 'Mark Complete' }}</button>
        </form>
    </div>
    <div>
        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">Edit</a>
        <form method="POST" action="{{ route('tasks.destroy', ['task' => $task->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
    </div>
@endsection
