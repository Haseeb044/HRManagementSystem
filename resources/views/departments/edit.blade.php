@extends('layouts.app')

@section('page-title', 'Edit Department')

@section('content')
    <div class="page-head fade-in">
        <div>
            <h2 class="page-title">Edit Department</h2>
            <p class="page-subtitle">Update the details for this department.</p>
        </div>
    </div>

    <div class="card fade-in-1" style="max-width:720px">
        <div class="card-body">
            <form action="{{ route('departments.update', $department) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name" class="form-label">Department Name</label>
                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name', $department->name) }}" required autofocus>
                    @error('name')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-textarea" placeholder="What does this department do?">{{ old('description', $department->description) }}</textarea>
                    @error('description')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex-between" style="justify-content:flex-end">
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        Update Department
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
