@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('History user') }}</div>

                    <div class="card-body">
                        <div class="row mt-4">
                            <div class="col-12">
                                <form action="{{ route('employee.history', $id) }}" method="GET">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="date" class="form-control" id="date_init" name="date_init">
                                            <label for="">* Initial Access date</label>
                                        </div>
                                        <div class="col-3">
                                            <input type="date" class="form-control" id="date_end" name="date_end">
                                            <label for="">* Final Access date</label>
                                        </div>
                                        <div class="col-3">
                                            <button class="btn" type="submit">Search</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="btn">Clear filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Created at</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($histories as $history)
                                            <tr>
                                                <td>{{ $history->present()->getEmployeeId() }}</td>
                                                <td>{{ $history->present()->getCreatedAt() }}</td>
                                            </tr>
                                        @empty
                                            No hay informacion
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
