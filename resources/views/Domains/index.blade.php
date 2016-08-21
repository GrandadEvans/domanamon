@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <header>
                    <h2>Your Domains</h2>
                </header>

                <a href="{{ route('domains.create') }}">Add a new domain</a>
            </div>
        </div>
    </div>
@endsection
