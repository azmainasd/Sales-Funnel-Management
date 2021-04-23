@extends('admin.layouts.app')

@section('main-content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
          <div class="">
            <h1>Edit solution</h1>
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content ">
      <div class="row justify-content-center">
        <div class="col-md-8 ">
         <div class="card card-primary"> 
              <!-- form start -->
              {!! Form::open(array('route' => ['partner.update',$partner->id], 'method' => 'POST')) !!}
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if(count($errors) > 0)
                      @foreach($errors->all() as $error)
                        <p class="text-danger">*{{$error}}</p>
                      @endforeach
                    @endif
                    <div class="form-group ">
                        {{Form::label('Name')}}
                        {{Form::text('name', $partner->name, ['class' => 'form-control'])}}
                    </div>
                    <div class="form-group row">
                      <div class="col-md-1">
                        {{Form::label('Status')}}
                      </div>
                      <div class="col-md-10 custom-control custom-switch custom-switch-off-danger custom-switch-on-success ">
                        {{ Form::checkbox('active', 1, $partner->active,[$partner->active==1,'class' => 'custom-control-input', 'id' => 'customSwitch3']) }} 
                        <label class="custom-control-label ml-2" for="customSwitch3">Active</label>
                      </div>                  
                    </div>
                    <div class="text-center">
                      <a class="btn btn-outline-success" href="{{ route('partner.index')}}"> Back</a>
                      <button type="submit" class="btn btn-success">Update</button>
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