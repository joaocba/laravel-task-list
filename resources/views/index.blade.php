<!-- Show single task info page -->

<!-- Import app.blade.php layout -->
@extends('layouts.app')

<!-- Define title -->
@section('title', 'The list of tasks')

<!-- Define content -->
@section('content')

    {{-- Add button to Add New Task --}}
    <nav class="mb-6">
        <a href="{{ route('tasks.create') }}"
            class="btn-cyan">Add New Task</a>
    </nav>

    <!-- For each existing task -->
    @forelse($tasks as $task)
        {{-- Show each class and apply a style to each completed --}}
        <div class="shadow-sm border mt-4 pt-4 pr-5 pb-4 pl-5 flow-root rounded-lg sm:py-2 hover:bg-gray-100">
            <div class="pt-2 sm:flex sm:items-center sm:justify-between sm:space-x-5">

                {{-- Show task title and status --}}
                <div class="flex items-center flex-1 min-w-0">
                    <div class="mt-0 mr-0 mb-0 ml-0 flex-1 min-w-0">
                        <p @class([
                            'text-lg font-semibold text-gray-800 truncate',
                            'line-through' => $task->completed,
                        ])>{{ $task->title }}</p>

                        {{-- Show task description --}}
                        <p class="text-gray-600 text-sm">
                            {{ Str::limit($task->description, 90) }} {{-- Limit the string to 90 chars --}}
                        </p>

                        {{-- Show task status --}}
                        <p class="text-gray-600 text-sm">
                            @if ($task->completed)
                                <span class="font-semibold text-green-500">Completed</span>
                            @else
                                <span class="font-semibold text-red-500">Not completed</span>
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Button to mark task as completed --}}
                <form method="POST" action="{{ route('tasks.toggle-complete', ['task' => $task]) }}">
                    @csrf
                    @method('PUT')
                    @if (!$task->completed)
                        <button type="submit"
                            class="btn-task-completed">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                            </svg>
                        </button>
                    @endif
                </form>

                {{-- Button to view task details --}}
                <div class="mt-4 mr-0 mb-0 ml-0 pt-0 pr-0 pb-0 pl-14 flex items-center sm:space-x-6 sm:pl-0 sm:mt-0">
                    <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                        class="btn-gray">View</a>
                </div>
            </div>
        </div>

        <!-- If no task (or items) -->
    @empty
        <div>There are no tasks!</div>
    @endforelse

    {{-- Create pagination for tasks --}}
    @if ($tasks->count())
        <nav class="mt-10">
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection
