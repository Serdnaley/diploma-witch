@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="w3-text-teal text-center">
                {{ $today->format('F Y') }}
            </h1>

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
                                <td class="{{ $col['is_active'] ? '' : 'text-secondary' }}">
                                    <span class="date">
                                        {{ $col['day'] }}
                                    </span>
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
