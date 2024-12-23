@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Your Link') }}</div>
                    <div class="card-body">
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
