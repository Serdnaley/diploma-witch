@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">

            @if(!\Auth::user()->available_visits)
                <div class="alert alert-danger">
                    You have not available visits. Please buy more.
                </div>
            @endif

            <h1 class="text-center">{{ $today->format('F Y') }}</h1>

            <table class="table">
                <thead>
                    <tr>
                        <th class="col">ПН</th>
                        <th class="col">ВТ</th>
                        <th class="col">СР</th>
                        <th class="col">ЧТ</th>
                        <th class="col">ПТ</th>
                        <th class="col">СБ</th>
                        <th class="col">ВС</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($calendar as $row)
                        <tr>
                            @foreach($row as $col)
                                <td>
                                    <div>
                                        {{ $col['date']->day }}
                                    </div>
                                    @if(!$col['is_active'])
                                        <div class="btn btn-secondary disabled btn-sm">
                                            Not available
                                        </div>
                                    @elseif($col['booked'])
                                        <div class="btn btn-secondary disabled btn-sm">
                                            Booked
                                        </div>
                                    @else
                                        <a
                                            href="{{ route('day', ['day' => $col['date']->format('d-m-Y')]) }}"
                                            class="btn btn-primary btn-sm"
                                        >
                                            Book
                                        </a>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
