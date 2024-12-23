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
                        @if (Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                        @endif

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
                                    <a class="btn btn-warning" id="history-btn">
                                        History
                                    </a>
                                </div>
                            </div>

                            <div class="row d-none" id="history">
                                <div class="col">
                                    <hr class="mt-4">
                                    <table class="table">
                                        <th>Date</th>
                                        <th>Result</th>
                                        <th>Score</th>
                                        <th>Sum</th>
                                        @foreach($results as $result)
                                            <tr>
                                                <td><small>{{ $result->created_at }}</small></td>
                                                <td>@if ($result->win)
                                                        Win
                                                    @else
                                                        Lose
                                                    @endif</td>
                                                <td>{{ $result->score }}</td>
                                                <td>${{ number_format($result->sum / 100, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
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

    <script>
        document.getElementById('history-btn').addEventListener('click', function () {
            this.classList.toggle('btn-warning');
            this.classList.toggle('btn-info');
            document.getElementById('history').classList.toggle('d-none');
        });
    </script>
@endsection
