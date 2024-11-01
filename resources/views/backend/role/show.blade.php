@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Role Details</h3>
                    <p class="text-subtitle text-muted">View the details of this user role.</p>
                </div>
            </div>
        </div>        
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-header">
                            <h5>{{ $role->name }} Permissions</h5>
                        </div>
                        <div class="card-body">
                            <form class="form form-horizontal" method="POST" action="{{ route('role.store.permissions', $role->id) }}">
                                @csrf
                                
                                <div class="row my-5">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                            <label class="form-check-label" for="checkAll">Check All</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        @php
                                            $groupedPermissions = [];
                                    
                                            function humanReadablePermission($permissionName) {
                                                return ucwords(str_replace('_', ' ', $permissionName));
                                            }
                                    
                                            foreach ($permissions as $permission) {
                                                $parts = explode('_', $permission->name);
                                                $groupName = end($parts);
                                                if (!isset($groupedPermissions[$groupName])) {
                                                    $groupedPermissions[$groupName] = [];
                                                }
                                                $groupedPermissions[$groupName][] = $permission;
                                            }
                                        @endphp
                                    
                                        @foreach ($groupedPermissions as $groupName => $groupPermissions)
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input group-check" type="checkbox" id="checkGroup{{ $loop->iteration }}" data-group="{{ $groupName }}">
                                                        <label class="form-check-label" for="checkGroup{{ $loop->iteration }}">{{ humanReadablePermission($groupName) }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @foreach ($groupPermissions as $permission)
                                                        <div class="form-check">
                                                            <input class="form-check-input permission-check" name="permissions[]" value="{{ $permission->id }}" data-group="{{ $groupName }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} type="checkbox" id="checkPermission{{ $loop->parent->iteration }}_{{ $loop->iteration }}">
                                                            <label class="form-check-label" for="checkPermission{{ $loop->parent->iteration }}_{{ $loop->iteration }}">{{ humanReadablePermission($permission->name) }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="my-4"></div>
                                        @endforeach
                                    </div>                                    
                                </div>                                                                                         
                        
                                <div class="mt-3 text-end">
                                    <button type="submit" class="btn btn-sm btn-primary">Save Permissions</button>
                                </div>
                            </form>
                        </div>             
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        @if($errors->any())
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'There are errors in the form!',
                showConfirmButton: false,
                timer: 3000
            });
        @endif

        @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
</script>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('checkAll');
        const groupCheckboxes = document.querySelectorAll('.group-check');
        const permissionCheckboxes = document.querySelectorAll('.permission-check');

        function updateGroupCheckbox(groupName) {
            const groupPermissions = document.querySelectorAll(`.permission-check[data-group="${groupName}"]`);
            const allChecked = Array.from(groupPermissions).every(checkbox => checkbox.checked);
            document.querySelector(`.group-check[data-group="${groupName}"]`).checked = allChecked;
        }

        function updateCheckAll() {
            const allChecked = Array.from(permissionCheckboxes).every(checkbox => checkbox.checked);
            checkAll.checked = allChecked;
        }

        checkAll.addEventListener('change', function() {
            groupCheckboxes.forEach(function(groupCheckbox) {
                groupCheckbox.checked = checkAll.checked;
            });

            permissionCheckboxes.forEach(function(checkbox) {
                checkbox.checked = checkAll.checked;
            });
        });

        groupCheckboxes.forEach(function(groupCheckbox) {
            groupCheckbox.addEventListener('change', function() {
                const groupName = groupCheckbox.dataset.group;
                const groupPermissions = document.querySelectorAll(`.permission-check[data-group="${groupName}"]`);
                groupPermissions.forEach(function(permission) {
                    permission.checked = groupCheckbox.checked;
                });
                updateCheckAll();
            });
        });

        permissionCheckboxes.forEach(function(permissionCheckbox) {
            permissionCheckbox.addEventListener('change', function() {
                const groupName = permissionCheckbox.dataset.group;
                updateGroupCheckbox(groupName);
                updateCheckAll();
            });
        });

        groupCheckboxes.forEach(function(groupCheckbox) {
            const groupName = groupCheckbox.dataset.group;
            updateGroupCheckbox(groupName);
        });
        updateCheckAll();
    });
</script>
@endpush
