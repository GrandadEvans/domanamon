@extends('layouts.app')

@section('content')
    <!--suppress DeclareUseStrictTypesInspection, DeclareUseStrictTypesInspection -->
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <header>
                    <h2>Your Domains</h2>
                </header>

                @if (isset($domains) && count($domains) > 0)
                    <table class="domain-table">
                        <thead>
                            <tr>
                                <th>Domain Address</th>
                                <th>Visit</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($domains as $domain)
                                <tr class="domain-row">
                                    <!-- Domain Address -->
                                    <td>{{ e($domain->url) }}</td>

                                    <!-- Visit -->
                                   <td>
                                        <a
                                                href="{{ e($domain->url) }}"
                                                title="Visit {{ e($domain->url) }}"
                                        >
                                            <i class="fa fa-globe"></i>
                                        </a>
                                    </td>

                                    <!-- Edit -->
                                    <td>
                                        <a
                                                href="{{ route('domains.edit', ['domains' => (int) $domain->id]) }}"
                                                title="Edit {{ e($domain->url) }}">
                                                    <i class="fa fa-edit"></i>
                                        </a>
                                    </td>

                                    <!-- Remove -->
                                    <td>
                                        <a
                                                class="js-confirm-delete"
                                                data-name="{{ e($domain->url) }}"
                                                data-method="DELETE"
                                                data-model="domain"
                                                href="{{ e(route('domains.destroy', ['domains' => (int) $domain->id])) }}"
                                                title="Remove {{ e($domain->url) }}"
                                        ><i class="fa fa-close icon-remove"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('domains.create') }}">Add a new domain</a>
                @else
                    <p><strong>You do not have any domains listed</strong><br />
                    <a href="{{ route('domains.create') }}" title="Add a new domain">Add your first domain now.
                    </a></p>
                @endif

            </div>
        </div>
    </div>
@endsection
