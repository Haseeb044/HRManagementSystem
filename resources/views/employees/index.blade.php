@extends('layouts.app')

@section('page-title', 'Employees')

@section('content')
    <div class="page-head fade-in">
        <div>
            <h2 class="page-title">Employees</h2>
            <p class="page-subtitle">View and manage all employees in your organization.</p>
        </div>
        <div class="page-actions">
            <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">
                <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zm-4 6a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                Add Employee
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="flash flash-success">
            <svg style="width:18px;height:18px;flex-shrink:0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="card fade-in-1 mb-6">
        <div class="card-body">
            <form action="{{ route('employees.index') }}" method="GET" class="form-row" style="grid-template-columns:1fr auto auto;align-items:start">
                <div style="position:relative">
                    <svg style="width:18px;height:18px;position:absolute;left:.875rem;top:50%;transform:translateY(-50%);color:#94a3b8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <input type="text" name="search" class="form-control" style="padding-left:2.5rem" value="{{ request('search') }}" placeholder="Search by name, email, or department...">
                </div>
                <button type="submit" class="btn btn-primary">
                    <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Clear</a>
                @endif
            </form>
        </div>
    </div>

    <div class="card fade-in-2">
        <div class="card-body" style="padding:0">
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>
                                    <div class="flex-center">
                                        @if($employee->profile_image)
                                            <img class="avatar" src="{{ asset('storage/' . $employee->profile_image) }}" alt="">
                                        @else
                                            <div class="avatar avatar-gradient">{{ strtoupper(substr($employee->full_name, 0, 2)) }}</div>
                                        @endif
                                        <div>
                                            <div style="font-weight:600;color:var(--text)">{{ $employee->full_name }}</div>
                                            <div class="text-muted" style="font-size:.75rem">{{ $employee->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($employee->department)
                                        <span class="badge badge-primary">{{ $employee->department->name }}</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td class="text-muted">{{ $employee->designation }}</td>
                                <td>
                                    @if($employee->status === 'active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="page-actions" style="justify-content:flex-end;gap:.5rem">
                                        <a href="{{ route('employees.show', $employee) }}" class="btn btn-secondary btn-sm">
                                            <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                            View
                                        </a>
                                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-secondary btn-sm">
                                            <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');">
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
                                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        <p>No employees found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="padding:0 1.5rem 1.5rem">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
@endsection
