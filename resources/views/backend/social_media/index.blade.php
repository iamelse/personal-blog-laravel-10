
@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Social Media</h3>
                    <p class="text-subtitle text-muted">View and manage your social media lists.</p>
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
                            @can('create_social_media', $socialMedias)
                            <div class="row mb-4">
                                <div class="col-6"></div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('social.media.create') }}" class="btn btn-primary btn-sm">
                                        New Social Media
                                    </a>
                                </div>
                            </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            <!-- Table with outer spacing -->
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Social Media Name</th>
                                            <th>Icon</th>
                                            <th>URL</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($socialMedias as $socialMedia)
                                        <tr>
                                            <td class="text-bold-500">{{ $loop->iteration }}</td>
                                            <td class="text-bold-500">{{ $socialMedia->name }}</td>
                                            <td class="text-bold-500">{{ $socialMedia->icon }}</td> 
                                            <th class="text-bold-500">{{ $socialMedia->url }}</th>                                                                                         
                                            <td>
                                                <div style="display: flex; gap: 5px;">
                                                    <a href="{{ $socialMedia->url }}" target="_blank" class="btn btn-sm btn-outline-info">Visit</a>
                                                    @can('edit_social_media', $socialMedia)
                                                    <a href="{{ route('social.media.edit', $socialMedia->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                                    @endcan
                                                    @can('destroy_social_media', $socialMedia)
                                                    <form method="POST" action="{{ route('social.media.destroy', $socialMedia->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" id="delete-btn">Delete</button>
                                                    </form>
                                                    @endcan
                                                </div>
                                            </td>                                                
                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="text-center" colspan="4">No Data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>               
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
        const deleteButtons = document.querySelectorAll('#delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary mx-1',
                        cancelButton: 'btn btn-danger mx-1'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        @if($errors->any())
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Oops, something went wrong.',
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
