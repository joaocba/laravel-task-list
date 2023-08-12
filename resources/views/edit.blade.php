@extends('layouts.app')

@section('content')
    {{-- ['task' => $task] means it is showing data related --}}
    @include('form', ['task' => $task])
@endsection
