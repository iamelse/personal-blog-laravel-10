@extends('template.main')

@section('content')
<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Dashboard</h3>
                    <p class="text-subtitle text-muted">Overview of your activities and quick access to main features.</p>
                </div>                
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">About Vertical Navbar</h4>
            </div>
            <div class="card-body">
                <p>Vertical Navbar is a layout option that you can use with Mazer. </p>
                <p>In case you want the navbar to be sticky on top while scrolling, add <code>.navbar-fixed</code> class alongside with <code>.layout-navbar</code> class.</p>
            </div>
        </div>
    </section>
</div>
@endsection