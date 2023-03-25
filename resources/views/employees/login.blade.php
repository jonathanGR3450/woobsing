@extends('layout')

@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body">

                            <form action="{{ route('employee.login.post') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="id" class="col-md-4 col-form-label text-md-right">ID Employee</label>
                                    <div class="col-md-6">
                                        <input type="text" id="id" class="form-control" name="id"
                                            required autofocus>
                                        @if ($errors->has('id'))
                                            <span class="text-danger">{{ $errors->first('id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Access
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

