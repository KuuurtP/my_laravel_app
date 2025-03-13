@extends('notes.layout')

@section('content')
<div class="card">
    <h2 class="card-header">Note Details</h2>
    <div class="card-body">
        <div class="mb-3">
            <strong>Title:</strong>
            <p>{{ $note->title }}</p>
        </div>

        <div class="mb-3">
            <strong>Content:</strong>
            <p>{{ $note->content }}</p>
        </div>

        <div class="mb-3">
            <strong>Description:</strong>
            <p>{{ $note->description }}</p>
        </div>

        <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-secondary">Edit</a>
        <a href="{{ route('notes.index') }}" class="btn btn-primary">Back</a>
    </div>
</div>
@endsection