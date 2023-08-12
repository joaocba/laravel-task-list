@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

{{-- @section('styles')
<style>
    .error-message {
        color: red;
        font-size: 0.8rem;
    }
</style>
@endsection --}}



@section('content')
    <!-- Display validation errors -->
    {{-- {{ $errors }} --}}

    <!-- Create new task form -->
    <form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
        <!-- CSRF token allows to protect against XSS attacks on forms -->
        @csrf

        @isset($task)
            @method('PUT')
        @endisset

        <div class="mb-4">
            <label for="title">
                Title
            </label>
            <input text="text" name="title" id="title"
            @class(['rounded', 'border-red-500' => $errors->has('title')])
            value="{{ $task->title ?? old('title') }}" /> {{-- old() allow to keep previous input on field instead of clearing it --}}

            <!-- Show error message related to field -->
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description">Summary</label>
            <textarea name="description" id="description"
            @class(['rounded', 'border-red-500' => $errors->has('description')]) {{-- This allow to apply a style when an error occurs for filed description --}}
            rows="5">{{ $task->description ?? old('description') }}</textarea>

            <!-- Show error message related to field -->
            @error('description')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="long_description">Description</label>
            <textarea name="long_description" id="long_description"
            @class(['rounded', 'border-red-500' => $errors->has('long_description')])
            rows="10">{{ $task->long_description ?? old('long_description') }}</textarea>

            <!-- Show error message related to field -->
            @error('long_description')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="btn-cyan">
                @isset($task)
                    Update Task
                @else
                    Add Task
                @endisset
            </button>
            <a href="{{ route('tasks.index') }}" class="btn-gray">Cancel</a>
        </div>
    </form>
@endsection
