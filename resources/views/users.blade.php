@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">

                <h1>Users</h1>

                @foreach($users as $user)
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    {{ $user->email }}
                                </div>
                                <div class="col-auto">
                                    {{ $user->available_visits }}
                                </div>
                                <form
                                    class="col-auto"
                                    action="{{ route('user.increment', ['user' => $user]) }}"
                                    method="post"
                                >
                                    @csrf
                                    @method('POST')
                                    <button
                                        name="count"
                                        value="10"
                                        class="btn btn-primary btn-sm"
                                    >
                                        + 10
                                    </button>
                                    <button
                                        name="count"
                                        value="20"
                                        class="btn btn-primary btn-sm ml-3"
                                    >
                                        + 20
                                    </button>
                                    <button
                                        name="count"
                                        value="30"
                                        class="btn btn-primary btn-sm ml-3"
                                    >
                                        + 30
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
