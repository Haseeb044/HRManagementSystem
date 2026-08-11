@extends('layouts.app')

@section('page-title', 'Add Employee')

@section('content')
    <div class="page-head fade-in">
        <div>
            <h2 class="page-title">Add Employee</h2>
            <p class="page-subtitle">Register a new employee in the system.</p>
        </div>
    </div>

    <div class="card fade-in-1">
        <div class="card-header">
            <h3>Personal & Job Information</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input id="full_name" type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" placeholder="e.g. John Doe" required autofocus>
                        @error('full_name')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="john@company.com" required>
                        @error('email')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input id="phone" type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+1 555 000 0000">
                        @error('phone')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="department_id" class="form-label">Department</label>
                        <select id="department_id" name="department_id" class="form-select" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="designation" class="form-label">Designation</label>
                        <input id="designation" type="text" name="designation" class="form-control" value="{{ old('designation') }}" placeholder="e.g. Software Engineer" required>
                        @error('designation')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="salary" class="form-label">Salary</label>
                        <input id="salary" type="number" step="0.01" name="salary" class="form-control" value="{{ old('salary') }}" placeholder="e.g. 75000">
                        @error('salary')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="joining_date" class="form-label">Joining Date</label>
                        <input id="joining_date" type="date" name="joining_date" class="form-control" value="{{ old('joining_date') }}" required>
                        @error('joining_date')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="divider"></div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="profile_image" class="form-label">Profile Image <span class="text-muted">(Optional)</span></label>
                        <div class="file-drop" id="profileDrop">
                            <input type="file" name="profile_image" id="profile_image" accept="image/*">
                            <div class="drop-icon">
                                <svg style="width:22px;height:22px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                            <p class="drop-title">Drop profile photo here</p>
                            <p class="drop-sub" id="profileName">or click to browse (JPG, PNG)</p>
                        </div>
                        @error('profile_image')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cv_document" class="form-label">CV / Document (PDF) <span class="text-muted">(Optional)</span></label>
                        <div class="file-drop" id="cvDrop">
                            <input type="file" name="cv_document" id="cv_document" accept=".pdf">
                            <div class="drop-icon">
                                <svg style="width:22px;height:22px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </div>
                            <p class="drop-title">Drop CV document here</p>
                            <p class="drop-sub" id="cvName">or click to browse (PDF)</p>
                        </div>
                        @error('cv_document')
                            <div class="input-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex-between" style="justify-content:flex-end;margin-top:1rem">
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <svg style="width:16px;height:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        Save Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function () {
            function bindFileDrop(dropId, inputId, nameId) {
                var drop = document.getElementById(dropId);
                var input = document.getElementById(inputId);
                var name = document.getElementById(nameId);
                if (!drop || !input || !name) return;

                ['dragenter', 'dragover'].forEach(function (evt) {
                    drop.addEventListener(evt, function (e) {
                        e.preventDefault();
                        drop.classList.add('dragover');
                    });
                });
                ['dragleave', 'drop'].forEach(function (evt) {
                    drop.addEventListener(evt, function (e) {
                        e.preventDefault();
                        drop.classList.remove('dragover');
                    });
                });
                input.addEventListener('change', function () {
                    name.textContent = input.files && input.files.length
                        ? input.files[0].name
                        : 'No file chosen';
                });
                drop.addEventListener('drop', function (e) {
                    if (e.dataTransfer.files.length) {
                        input.files = e.dataTransfer.files;
                        name.textContent = input.files[0].name;
                    }
                });
            }

            bindFileDrop('profileDrop', 'profile_image', 'profileName');
            bindFileDrop('cvDrop', 'cv_document', 'cvName');
        })();
    </script>
@endsection
