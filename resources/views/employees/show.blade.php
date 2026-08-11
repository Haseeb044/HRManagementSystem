@extends('layouts.app')

@section('page-title', 'Employee Details')

@section('content')
    <div class="page-head fade-in">
        <div>
            <h2 class="page-title">Employee Details</h2>
            <p class="page-subtitle">Full profile of {{ $employee->full_name }}.</p>
        </div>
        <div class="page-actions">
            <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary btn-sm">
                <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                Edit Profile
            </a>
        </div>
    </div>

    <div class="grid-2 fade-in-1" style="align-items:start">
        <div class="card" style="overflow:hidden">
            <div style="height:90px;background:var(--gradient)"></div>
            <div class="card-body" style="text-align:center;margin-top:-70px">
                @if($employee->profile_image)
                    <img src="{{ asset('storage/' . $employee->profile_image) }}" alt="{{ $employee->full_name }}" class="avatar avatar-lg" style="border:5px solid #fff;box-shadow:var(--shadow)">
                @else
                    <div class="avatar avatar-lg avatar-gradient" style="border:5px solid #fff;box-shadow:var(--shadow)">{{ strtoupper(substr($employee->full_name, 0, 2)) }}</div>
                @endif

                <h3 style="margin-top:1rem;font-size:1.25rem">{{ $employee->full_name }}</h3>
                <p class="text-muted" style="margin:0 0 .75rem">{{ $employee->designation }}</p>

                <div style="display:flex;justify-content:center;gap:.5rem;flex-wrap:wrap">
                    @if($employee->status === 'active')
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                    @if($employee->department)
                        <span class="badge badge-primary">{{ $employee->department->name }}</span>
                    @endif
                </div>

                @if($employee->salary)
                    <div class="divider"></div>
                    <div class="flex-between">
                        <span class="text-muted" style="font-size:.8125rem">Monthly Salary</span>
                        <strong style="font-size:1.125rem">{{ '$' . number_format($employee->salary, 2) }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="card fade-in-2">
            <div class="card-header">
                <h3>Personal Information</h3>
            </div>
            <div class="card-body" style="padding-top:1.25rem">
                <div class="form-row" style="row-gap:1.5rem">
                    <div>
                        <div class="form-label mb-0" style="font-size:.75rem">Email Address</div>
                        <a href="mailto:{{ $employee->email }}" class="link-primary" style="font-size:.875rem">{{ $employee->email }}</a>
                    </div>
                    <div>
                        <div class="form-label mb-0" style="font-size:.75rem">Phone Number</div>
                        <div style="font-size:.875rem">{{ $employee->phone ?: 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="form-label mb-0" style="font-size:.75rem">Department</div>
                        <div style="font-size:.875rem">{{ $employee->department ? $employee->department->name : 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="form-label mb-0" style="font-size:.75rem">Joining Date</div>
                        <div style="font-size:.875rem">{{ \Carbon\Carbon::parse($employee->joining_date)->format('F d, Y') }}</div>
                    </div>
                </div>

                <div class="divider"></div>

                <div>
                    <div class="form-label" style="font-size:.75rem">CV / Document</div>
                    @if($employee->cv_document)
                        <a href="{{ asset('storage/' . $employee->cv_document) }}" target="_blank" class="btn btn-secondary btn-sm">
                            <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            View / Download CV
                        </a>
                    @else
                        <span class="text-muted" style="font-size:.875rem;font-style:italic">No CV uploaded</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
