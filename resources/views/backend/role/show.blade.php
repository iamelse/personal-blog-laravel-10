@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Dashboard</h3>
                    <p class="text-subtitle text-muted">Navbar will appear on the top of the page.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Layout Vertical Navbar</li>
                    </ol>
                    </nav>
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
                                                        <label class="form-check-label" for="checkGroup{{ $loop->iteration }}">{{ Str::ucfirst($groupName) }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @foreach ($groupPermissions as $permission)
                                                        <div class="form-check">
                                                            <input class="form-check-input permission-check" name="permissions[]" value="{{ $permission->id }}" data-group="{{ $groupName }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} type="checkbox" id="checkPermission{{ $loop->parent->iteration }}_{{ $loop->iteration }}">
                                                            <label class="form-check-label" for="checkPermission{{ $loop->parent->iteration }}_{{ $loop->iteration }}">{{ $permission->name }}</label>
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
</div>
@endsection

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
