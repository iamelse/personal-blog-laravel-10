@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Information</h3>
                    <p class="text-subtitle text-muted">
                        Learn more about my application.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">About</h4>
            </div>
            <div class="card-body">
                <p>
                    This project is a personal blog built using the Laravel 10 framework. 
                    It provides a platform for individuals to share their thoughts, experiences, 
                    and expertise through blog posts. The blog includes standard features 
                    such as user authentication, post creation, editing, and deletion. 
                </p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thanks to</h4>
            </div>
            <div class="card-body">
                <ol>
                    <li>Allah SWT</li>
                    <li>Lana Septiana (Me)</li>
                    <li>
                        Mazer Template by <a class="fw-bold" href="https://github.com/zuramai/mazer" target="_blank">Ahmad Saugi</a>
                    </li>
                </ol>
            </div>                
        </div> 
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Contact Me</h4>
            </div>
            <div class="card-body">
                If you have any inquiries or would like to collaborate, feel free to reach out to me via <a class="fw-bold" href="https://www.linkedin.com/in/iamelse/" target="_blank">LinkedIn</a>. And here <a class="fw-bold" href="https://github.com/iamelse" target="_blank">My Github</a> profile.
            </div>                
        </div>

    </section>
</div>
@endsection

@push('scripts')

@endpush