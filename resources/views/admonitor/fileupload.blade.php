@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Datei Upload</h3>
                    </div>
                    <form action="{{route('fileupload')}}" method="post" enctype="multipart/form-data">
                        <h3 class="text-center mb-5"></h3>
                        @csrf
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="pl-md-4 pr-md-4 pb-md-4">
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                                <label class="custom-file-label" for="chooseFile">Datei wählen</label>
                            </div>

                            <button type="submit" name="submit" class="btn btn-dark btn-block mt-4">
                                Datei hochladen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
