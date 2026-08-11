@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
    <div class="page-head fade-in">
        <div>
            <h2 class="page-title">Welcome back, {{ Auth::user()->name }}</h2>
            <p class="page-subtitle">Here's an overview of your organization today.</p>
        </div>
    </div>

    <div class="grid-4 fade-in-1">
        <div class="stat-card">
            <div class="stat-icon indigo">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            </div>
            <div>
                <p class="stat-value">{{ $totalEmployees }}</p>
                <p class="stat-label">Total Employees</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
            </div>
            <div>
                <p class="stat-value">{{ $totalDepartments }}</p>
                <p class="stat-label">Departments</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon amber">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </div>
            <div>
                <p class="stat-value">{{ $employeesPerDepartment->count() }}</p>
                <p class="stat-label">Active Departments</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon rose">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="stat-value">{{ $recentEmployees->count() }}</p>
                <p class="stat-label">Recently Added</p>
            </div>
        </div>
    </div>

    <div class="grid-2" style="margin-top:1.5rem">
        <div class="card fade-in-2">
            <div class="card-header">
                <h3>Employees by Department</h3>
                <span class="badge badge-primary">Live</span>
            </div>
            <div class="card-body">
                <div style="position:relative;height:300px">
                    <canvas id="departmentChart"></canvas>
                </div>
            </div>
        </div>

        <div class="card fade-in-3">
            <div class="card-header">
                <h3>Recently Added Employees</h3>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm">View All</a>
            </div>
            <div class="card-body" style="padding:0">
                @if($recentEmployees->count() > 0)
                    <div class="table-wrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentEmployees as $employee)
                                    <tr>
                                        <td>
                                            <div class="flex-center">
                                                @if($employee->profile_image)
                                                    <img class="avatar avatar-sm" src="{{ asset('storage/' . $employee->profile_image) }}" alt="">
                                                @else
                                                    <div class="avatar avatar-sm avatar-gradient">{{ strtoupper(substr($employee->full_name, 0, 2)) }}</div>
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
                                                <span class="text-muted">None</span>
                                            @endif
                                        </td>
                                        <td class="text-muted" style="white-space:nowrap">{{ \Carbon\Carbon::parse($employee->joining_date)->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <p>No employees added yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var canvas = document.getElementById('departmentChart');
            if (!canvas) return;

            var labels = [
                @foreach($employeesPerDepartment as $dept)
                    @if(!$loop->last)
                        "{{ $dept->name }}",
                    @else
                        "{{ $dept->name }}"
                    @endif
                @endforeach
            ];

            var data = [
                @foreach($employeesPerDepartment as $dept)
                    @if(!$loop->last)
                        {{ $dept->employees_count }},
                    @else
                        {{ $dept->employees_count }}
                    @endif
                @endforeach
            ];

            new Chart(canvas.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Employees',
                        data: data,
                        backgroundColor: 'rgba(99, 102, 241, 0.7)',
                        hoverBackgroundColor: 'rgba(139, 92, 246, 0.9)',
                        borderColor: '#6366f1',
                        borderWidth: 1,
                        borderRadius: 8,
                        maxBarThickness: 48
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#eef2f7' },
                            ticks: { precision: 0, color: '#64748b' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#64748b' }
                        }
                    }
                }
            });
        });
    </script>
@endsection
