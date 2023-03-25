@csrf
<div class="form-group">
    <label for="first_name">Firstname</label>
    <input class="form-control bg-light shadow-sm border-0" type="text" name="first_name" id="first_name" value="{{ old('first_name', $employee?->present()->getFirstName()) }}">
</div>
<div class="form-group">
    <label for="last_name">Lastname</label>
    <input type="text" name="last_name" id="last_name" class="form-control bg-light shadow-sm border-0" value="{{ old('last_name', $employee?->present()->getLastName()) }}">
</div>
<div class="form-group">
    <label for="department">Department</label>
    <input type="text" name="department" id="department" class="form-control bg-light shadow-sm border-0" value="{{ old('department', $employee?->present()->getDepartment()) }}">
</div>
<div class="form-group">
    <label for="department">Has Access</label>
    <select id="has_access" name="has_access" class="form-control">
        <option {{ !$employee?->present()->getHasAccess() == 'SI' && !$employee?->present()->getHasAccess() == 'NO'  ? 'selected' : '' }}>Choose...</option>
        <option {{ $employee?->present()->getHasAccess() == 'SI' ? 'selected' : '' }} value="1">YES</option>
        <option {{ $employee?->present()->getHasAccess() == 'NO' ? 'selected' : '' }} value="0">NO</option>
      </select>
</div>
<button class="btn btn-primary btn-lg btn-block" type="submit">{{ $btnAction }}</button>
<input type="hidden" name="id" value="{{ $employee?->id ?? '0' }}">
<a class="btn btn-block btn-warning mt-2" href="{{ route('employees.index') }}">Cancelar</a>