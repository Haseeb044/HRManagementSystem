@extends('layouts.app')

@section('page-title', 'Departments')

@section('content')
    <div class="page-head fade-in">
        <div>
            <h2 class="page-title">Departments</h2>
            <p class="page-subtitle">Manage the departments in your organization.</p>
        </div>
        <div class="page-actions">
            <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm">
                <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                Add Department
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="flash flash-success">
            <svg style="width:18px;height:18px;flex-shrink:0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="card fade-in-1">
        <div class="card-body" style="padding:0">
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Employees</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $department)
                            <tr>
                                <td class="text-muted">{{ $department->id }}</td>
                                <td>
                                    <div class="flex-center">
                                        <div class="avatar avatar-sm avatar-gradient">{{ strtoupper(substr($department->name, 0, 1)) }}</div>
                                        <strong style="font-weight:600">{{ $department->name }}</strong>
                                    </div>
                                </td>
                                <td class="text-muted">{{ $department->description ?: 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $department->employees_count }}</span>
                                </td>
                                <td class="text-right">
                                    <div class="page-actions" style="justify-content:flex-end;gap:.5rem">
                                        <a href="{{ route('departments.edit', $department) }}" class="btn btn-secondary btn-sm">
                                            <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('departments.destroy', $department) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this department?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                        <p>No departments found yet.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="padding:0 1.5rem 1.5rem">
                {{ $departments->links() }}
            </div>
        </div>
    </div>
@endsection
