@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">{{ __('Your Link') }}</div>
                        <div class="float-end">
                            @if ($link)
                                <a href="{{ route('links.regenerate', ['key' => $link->key]) }}"
                                   class="btn btn-sm btn-primary">Regenerate</a>
                                <a href="{{ route('links.deactivate', ['key' => $link->key]) }}"
                                   class="btn btn-sm btn-danger">Deactivate</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                        @endif

                        @if ($link)
                            <a href="{{route('links.link', ['key' => $link->key])}}">
                                {{ route('links.link', ['key' => $link->key]) }}
                            </a>
                        @else
                            <p>No active link found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
