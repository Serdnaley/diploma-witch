@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">

                <div class="row">
                    <a
                        href="{{ route('calendar') }}"
                        class="btn btn-link"
                    >
                        < Back
                    </a>
                    <h1>Booking a pool</h1>
                </div>

                <form
                    action="{{ route('booking.store') }}"
                    class="form-row align-items-center"
                    method="POST"
                >
                    @csrf
                    @method('POST')
                    <div class="col-auto">
                        <div class="text-center">{{ $day->format('d F Y') }}</div>
                    </div>
                    <div class="col-auto">
                        <select
                            class="custom-select"
                            name="date"
                        >
                            @foreach($timestamps as $time)
                                <option
                                    value="{{ $time['date']->format('Y-m-d H:i:s') }}"
                                    {{ $time['books_count'] < 24 ?: 'disabled'}}
                                >
                                    {{ $time['date']->format('H:i') }} (booked {{ $time['books_count'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary">
                            Book
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
