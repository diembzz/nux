@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">{{ __('Link') }}</div>
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
                        @if ($link)
                            <div class="row">
                                <div class="col">
                                    <a href="{{route('links.link', ['key' => $link->key])}}">
                                        {{ route('links.link', ['key' => $link->key]) }}
                                    </a>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6 offset-md-3 mt-3 text-center">
                                    <a href="{{ route('links.play', ['key' => $link->key])  }}" class="btn btn-success">
                                        Imfeelinglucky
                                    </a>
                                    <a class="btn btn-warning">
                                        History
                                    </a>
                                </div>
                            </div>
                        @else
                            <p>No active link found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
