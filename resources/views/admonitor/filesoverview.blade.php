@extends('layouts.app')

@section('content')



    <div class="container-fluid bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Light table</h3>
                    </div>
                    @include('admonitor/filestable')
                </div>
            </div>
        </div>
    </div>
@endsection
