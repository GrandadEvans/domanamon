@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @if (isset($flashMessage))
                    <div class="alert alert-success">
                        <p>{{ $flashMessage }}</p>
                    </div>
                @endif

                <header>
                    <h2>Your Domains</h2>
                </header>

                @if (isset($domains))
                    <table>
                        <thead>
                            <tr>
                                <th>Domain Address</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($domains as $domain)
                                <tr>
                                    <td><a href="{{ $domain->url }}">Visit {{ $domain->url }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <a href="{{ route('domains.create') }}">Add a new domain</a>
            </div>
        </div>
    </div>
@endsection
