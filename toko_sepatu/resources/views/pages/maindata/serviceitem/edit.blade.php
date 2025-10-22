@extends('layouts.app')
<style>
    .container-new {
    max-width: 1400px; /* wider than bootstrap container */
    width: 100%;
    margin-left: auto;
    margin-right: auto;
    padding-left: 24px;
    padding-right: 24px;
    box-sizing: border-box;
}
</style>

@section('content')
    <form action="/serviceitems/{{ $serviceitem->id }}/update" method="POST">
      @csrf
         <div class="container-new">
    <div class="row">
      {{-- left column (slightly narrower now) --}}
      <div class="col-lg-12 col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Create Service item</h4>

            <div class="form-group">
              <label class="col-form-label">Name</label>
              <input type="text" class="form-control" name="service_name" value="{{ old('service_name', $serviceitem->service_name) }}" required>
            </div>

            <div class="form-group">
              <label class="col-form-label">Price</label>
              <input type="text" class="form-control" name="price" value="{{ old('price', $serviceitem->price) }}" required>
            </div>

             <div class="mt-3">
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <button type="reset" class="btn btn-dark">Cancel</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
    </form>
@endsection