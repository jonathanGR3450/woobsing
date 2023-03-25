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
                                <form action="{{ route('employees.index') }}" method="GET">
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="text" id="id" name="id" class="form-control"
                                                placeholder="search by employee ID" value="{{old('id', $id ?? '')}}">
                                        </div>
                                        <div class="col-3">
                                            <input type="text" id="department" name="department" class="form-control"
                                                placeholder="filter by department" value="{{old('department', $department ?? '')}}">
                                        </div>
                                        <div class="col-3">
                                            <input type="date" class="form-control" id="date_init" name="date_init" value="{{old('date_init', $date_init ?? '')}}">
                                            <label for="">* Initial Access date</label>
                                        </div>
                                        <div class="col-3">
                                            <input type="date" class="form-control" id="date_end" name="date_end" value="{{old('date_end', $date_end ?? '')}}">
                                            <label for="">* Final Access date</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <select id="has_access" name="has_access" class="form-control">
                                                <option value="" selected>Choose...</option>
                                                <option value="{{ "1" }}" {{ (Input::old("has_access", $has_access) == "1" ? "selected":"") }}>{{ 'YES' }}</option>
                                                <option value="{{ "0" }}" {{ (Input::old("has_access", $has_access) == "0" ? "selected":"") }}>{{ 'NO' }}</option>
                                            </select>
                                            <label for="has_access">* Has Access</label>
                                        </div>
                                        <div class="col-3">
                                            <button class="btn" type="submit">Search</button>
                                        </div>
                                        <div class="col-3">
                                            <button id="clear-btn" class="btn">Clear filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 bg-light text-right">
                                <a class="btn btn-primary" href="{{ route('employee.create') }}" role="button">New Employee</a>
                                <a class="btn btn-warning" href="{{ route('employee.upload.csv') }}" role="button">Upload CSV Employees</a>
                                <a class="btn btn-secondary" id="pdf" role="button">PDF</a>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Department</th>
                                            <th>Total access</th>
                                            <th>Actions</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->present()->getId() }}</td>
                                                <td>{{ $employee->present()->getFirstName() }}</td>
                                                <td>{{ $employee->present()->getLastName() }}</td>
                                                <td>{{ $employee->present()->getDepartment() }}</td>
                                                <td>{{ $employee->present()->getAttempts() }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a class="btn btn-primary"
                                                            href="{{ route('employee.edit', $employee->present()->getId()) }}">Update</a>
                                                        <a class="btn btn-danger" href="#"
                                                            onclick="document.getElementById('{{ 'delete-employee-' . $employee->present()->getId() }}').submit()">Delete</a>
                                                        <a class="btn btn-{{ $employee->present()->getHasAccessColor() }}"
                                                            href="#"
                                                            onclick="document.getElementById('{{ 'disabled-employee-' . $employee->present()->getId() }}').submit()">{{ $employee->present()->getHasAccessText() }}</a>
                                                        <a class="btn btn-warning"
                                                            href="{{ route('employee.history', $employee->present()->getId()) }}">History</a>
                                                    </div>
                                                    <form class="d-none"
                                                        id="{{ "delete-employee-{$employee->present()->getId()}" }}"
                                                        action="{{ route('employee.destroy', $employee->present()->getId()) }}"
                                                        method="post">
                                                        @csrf @method('DELETE')
                                                    </form>

                                                    <form class="d-none"
                                                        id="{{ "disabled-employee-{$employee->present()->getId()}" }}"
                                                        action="{{ route('employee.disabled', $employee->present()->getId()) }}"
                                                        method="post">
                                                        @csrf
                                                    </form>
                                                </td>
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
    <script>
        $("#clear-btn").on('click', function (e) {
            e.preventDefault();
            $("#id").val('');
            $("#department").val('');
            $("#date_init").val('');
            $("#date_end").val('');
            $("#has_access").val('');
            window.location.href = "{{ route('employees.index') }}";
        });
        $("#pdf").on('click', function (params) {
            var id = $("#id").val();
            var department = $("#department").val();
            var date_init = $("#date_init").val();
            var date_end = $("#date_end").val();
            var has_access = $("#has_access").val();
            var url = "{{ route('employee.pdf') }}" + `?id=${id}&department=${department}&date_init=${date_init}&date_end=${date_end}&has_access=${has_access}`;
            window.open(url);
        });
    </script>
@endsection
