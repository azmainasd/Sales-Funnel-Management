@extends('admin.layouts.app')
@section('main-content')
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <!-- left column -->
          <div class="col-sm-12 col-lg-8 ">
            <!-- general form elements -->
            <div class="card card-success my-5">
                <div class="card-header">
                  <h3 class="card-title">Create User</h3>
                </div>
                 <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(array('route' => 'user.store'), ['method' => 'POST']) !!}
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    {{Form::label('Name', null, ['class' => 'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                      {{Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Enter Name'])}}
                      @error('name') 
                        <div class="alart text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    {{Form::label('Email', null, ['class' => 'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                      {{Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Enter Email'])}}
                      @error('email') 
                        <div class="alart text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    {{Form::label('Password', null, ['class' => 'col-sm-2 col-form-label'])}}
                    <div class="col-sm-10">
                      {{ Form::password('password', ['class'=>'form-control', 'placeholder'=>'Enter Password'] ) }}
                      @error('password') 
                          <div class="alart text-danger">{{ $message }}</div> 
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    {{Form::label('Confirm Password',null , ['class' => 'col-sm-2 col-form-label pt-0'])}}
                    <div class="col-sm-10">
                      {{Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'Enter Confirm Password'])}}
                      @error('password_confirmation') 
                        <div class="alart text-danger">{{ $message }}</div> 
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-2">
                      {{Form::label('Assign Role')}}
                    </div>
                    <div class="col-lg-10 ">
                      {{ Form::select('role', $roles, null, ['class' => 'form-control', 'placeholder' => '--Select Role']) }}
                      <!-- get message by name --> 
                      @error('role') 
                        <div class="alart text-danger">{{ $message }}</div> 
                      @enderror 
                    </div>                  
                  </div>
                  <div class="form-group row">
                    <div class="col-md-2">
                      {{Form::label('Status')}}
                    </div>
                    <div class="col-md-10 custom-control custom-switch custom-switch-off-danger custom-switch-on-success ">
                      {{ Form::checkbox('active', 1, 'selected',['class' => 'custom-control-input', 'id' => 'customSwitch3']) }} 
                      <label class="custom-control-label ml-2" for="customSwitch3">Active</label>
                    </div>                 
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <a href="{{route('user.index')}}" type="btn" class="btn btn-outline-success"> Back </a>
                  {{Form::submit('Save', ['class' => 'btn btn-success'])}}
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    {{-- /section --}}
  </div>
  <!-- /.content -->

@endsection

@section("scripts")
<script> 
  $(document).ready(function(){
  $('.alart').fadeIn().delay(6000).fadeOut();
  });
</script>
@endsection

