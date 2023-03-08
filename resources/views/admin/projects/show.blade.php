@extends('layouts.app')

@section('content')
    <main class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <img class="img-fluid" src="{{ $project['image'] }}" alt="{{ $project['title'] }}">
                </div>
                <div class="col-8">
                    <h1>{{ $project['title'] }}</h1>
                    <p>{{ $project['description'] }}</p>
                    <a href="{{ $project['url'] }}" class="btn btn-primary"><i class="fa-brands fa-github me-1"></i>Vai al
                        GitHub</a>

                </div>
            </div>

        </div>
    </main>
@endsection
