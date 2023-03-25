@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Administrative Menu') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                {{ date('Y-m-d H:m:s') }}
                            </div>
                            <div class="col-6 text-right">
                                Welcome: {{ Auth::user()->name }}
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <form action="{{ route('employee.csv') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="csv_file">Upload CSV file Employees</label>
                                        <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                                    </div>
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Upload</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection