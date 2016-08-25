@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <header>
                    <h2>Edit {{ e($domain->url) }}</h2>
                </header>

                <a href="{{ route('domains.index') }}">Go back to your domains control panel</a>

                <form
                        class="form-horizontal"
                        role="form"
                        method="POST"
                        action="{{ route('domains.update', ['domains' => (int) $domain->id]) }}"
                        name="domainForm"
                        id="domainForm"
                >
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group{{ $errors->has('domain') ? ' has-error' : '' }}">
                        <label for="domain" class="col-md-4 control-label">Domain Address</label>

                        <div class="col-md-6">
                            <input
                                    id="domain"
                                    type="url"
                                    required="required"
                                    class="form-control"
                                    name="domain"
                                    maxlength="255"
                                    value="{{ old('domain') ?? $domain->url }}"
                                    placeholder="eg domanamon.com"
                            />

                            @if ($errors->has('domain'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('domain') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button
                                    name="edit-domain-button"
                                    id="edit-domain-button"
                                    type="submit"
                                    class="btn btn-primary"
                            ><i class="fa fa-btn fa-link"></i> Edit Domain</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
