@extends('admin.layouts.app')
@section('css')
@endsection
@section('main-content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
          <div class="">
            <h1>New Client</h1>
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content ">
      <div class="row justify-content-center">
        <div class="col-md-8 ">
         <div class="card card-primary"> 
              <!-- form start -->
              {!! Form::open(array('route' => 'client.store', 'method' => 'POST')) !!}
                @csrf
                <div class="card-body">
                    @if(count($errors) > 0)
                      @foreach($errors->all() as $error)
                        <p class="text-danger">*{{$error}}</p>
                      @endforeach
                    @endif
                    <div class="form-group ">
                        {{Form::label('Name')}}
                        {{Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Enter client name'])}}
                    </div>
                    <div class="form-group row">
                      <div class="col-md-1">
                        {{Form::label('Status')}}
                      </div>
                      <div class="col-md-10 custom-control custom-switch custom-switch-off-danger custom-switch-on-success ">
                        {{ Form::checkbox('active', 1, 'selected',['class' => 'custom-control-input', 'id' => 'customSwitch3']) }} 
                        <label class="custom-control-label ml-2" for="customSwitch3">Active</label>
                      </div>                 
                    </div>
                    <div class="text-center">
                      <a class="btn btn-outline-success" href="{{ route('client.index')}}"> Back</a>
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
                <!-- /.card-body -->
              {!! Form::close() !!}
         </div>
        </div>
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('js-section')
@endsection