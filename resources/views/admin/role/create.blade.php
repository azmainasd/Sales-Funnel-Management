@extends('admin.layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('admin-item/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-item/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('main-content')
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
          <!-- left column -->
          <div class="col-sm-12 col-lg-8 ">
            <!-- general form elements -->
            <div class="card card-success my-5">
              <div class="card-header">
                <h3 class="card-title">Create Role</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::open(array('route' => 'role.store'), ['method' => 'POST']) !!}
              @csrf
              <div class="card-body">
                <div class="form-group row">
                  {{Form::label('Role', null, ['class' => 'col-sm-2 col-form-label'])}}
                  <div class="col-sm-10">
                    {{Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Enter Role'])}}
                    @error('name') 
                      <div class="alart text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  {{Form::label('Permissions', null, ['class' => 'col-sm-2 col-form-label'])}}
                  <div class="col-sm-10">
                    
                    <select class="select2 select2-hidden-accessible" name="permission[]" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                      @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                      @endforeach
                    </select>
                    <!-- get message by name -->
                    @error('permission') 
                      <div  class="alart text-danger">{{ $message }}</div> 
                    @enderror
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="{{route('role.index')}}" type="btn" class="btn btn-outline-success"> Back </a>
                {{Form::submit('Save', ['class' => 'btn btn-success'])}}
              </div>
              <!-- /.card-footer -->  
              {!! Form::close() !!}
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection

@section("scripts")
<script src="{{ asset('admin-item/plugins/select2/js/select2.full.min.js') }}"></script>
<script> 
  $(document).ready(function(){
  $('.alart').fadeIn().delay(6000).fadeOut();
  });
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  }) 
</script>
@endsection

