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
                                <form action="{{ route('employee.store') }}" method="post">
                                    @include('employees.partials._form', ["btnAction" => "Save"])
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection