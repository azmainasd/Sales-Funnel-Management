@extends('admin/layouts/app')


@section('main-content')
  <!-- Main content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
          <!-- left column -->
          <div class="col-md-9 ">
            <div class="card card-success my-5">
                <div class="card-header">
                  <h3 class="card-title">Update User</h3>
                </div>
                <!-- form start -->
                {!! Form::open(array('route' => ['user.update',$user->id]), ['method' => 'POST', 'files' => true]) !!}
                @csrf
                @method("PUT")
                  <div class="card-body">

                    <div class="form-group row">
                      {{Form::label('Name', null, ['class' => 'col-sm-2 col-form-label'])}}
                      <div class="col-sm-10">
                        {{Form::text('name', $user->name, ['class' => 'form-control'])}}
                        @error('name') 
                            <div  class="alert text-danger">{{ $message }}</div> 
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      {{Form::label('Email', null, ['class' => 'col-sm-2 col-form-label'])}}
                      <div class="col-sm-10">
                        {{Form::email('email', $user->email, ['class' => 'form-control'])}}
                        @error('email') 
                            <div  class="alert text-danger">{{ $message }}</div> 
                        @enderror
                      </div>
                    </div>

                    {{-- <div class="form-group row">
                      {{Form::label('Old Password', null, ['class' => 'col-sm-2 col-form-label'])}}
                      <div class="col-sm-10">
                        {{ Form::password('oldPassword', ['class'=>'form-control', 'placeholder'=> 'Type old password']) }}
                        @if(Session::has('oldPass'))
                          <div  class="alert text-danger">{{ session('oldPass') }}</div> 
                        @endif
                      </div>
                    </div> --}}

                    <div class="form-group row">
                      {{Form::label('New Password', null, ['class' => 'col-sm-2 col-form-label'])}}
                      <div class="col-sm-10">
                        {{ Form::password('password', ['class'=>'form-control', 'placeholder'=> 'Type new password']) }}
                        @error('password') 
                            <div  class="alert text-danger">{{ $message }}</div> 
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      {{Form::label('Confirm Password',null , ['class' => 'col-sm-2 col-form-label'])}}
                      <div class="col-sm-10">
                        {{ Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=> 'Type confirm password']) }}
                        @error('password_confirmation') 
                            <div  class="alert text-danger">{{ $message }}</div> 
                        @enderror
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-lg-2">
                        {{Form::label('Assign Role')}}
                      </div>
                      <div class="col-lg-10 d-flex ">
                        <select class="form-control" name="role">
                          @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                              @foreach ($user->getRoleNames() as $userRole)
                                @if ($role->name == $userRole)
                                    selected
                                @endif
                              @endforeach
                            >{{ $role->name }}</option>
                          @endforeach
                        </select>
                        
                        <!-- get message by name --> 
                        @error('roles') 
                          <div class="alart text-danger">{{ $message }}</div> 
                        @enderror 
                      </div>  
                    </div>

                    <div class="form-group row">
                      <div class="col-md-2">
                        {{Form::label('Status')}}
                      </div>
                      <div class="col-md-10 custom-control custom-switch custom-switch-off-danger custom-switch-on-success ">
                        {{ Form::checkbox('active', 1, $user->active,[$user->active==1,'class' => 'custom-control-input', 'id' => 'customSwitch3']) }} 
                        <label class="custom-control-label ml-2" for="customSwitch3">Active</label>
                      </div>                  
                    </div>
                    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                      <a href="{{route('user.index')}}" type="btn" class="btn btn-outline-success"> Back </a>
                      {{Form::submit('Save', ['class' => 'btn btn-success'])}}
                  </div>
                  <!-- /.card-footer -->
                {!! Form::close() !!}
            </div>
            {{-- card end --}}
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content -->

@endsection

@section("scripts")
<script>
  $(document).ready(function(){
    $('.alert').fadeIn().delay(3000).fadeOut();
  });
</script>
@endsection
