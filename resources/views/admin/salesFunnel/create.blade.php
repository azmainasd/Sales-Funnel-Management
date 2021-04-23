@extends('admin.layouts.app')
@section('main-content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content funnel-create">
      <div class="container-fluid">
        <!-- Row -->
        <div class="row align-items-center">
          <div class="col-sm-12 ">
            <!-- general form elements -->
            <div class="card card-success my-5">
              <div class="card-header">
                <h3 class="card-title">Create Lead</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::open(array('route' => 'sales-funnel.store', 'method' => 'POST', 'files' => true)) !!}
                @csrf
                <div class="card-body">
                    <div class="form-row">
                      <div class="col-lg-6">
                          
                          <div class="form-group">
                              {{Form::label('Solution')}}<b class="text-danger">*</b>
                              {{ Form::select('solution', $solutions, null , ['class' => 'form-control', 'placeholder' => '--Select Solution']) }}
                              <!-- get message by name -->
                              @error('solution') 
                                <div  class="alart text-danger">{{ $message }}</div> 
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Industry')}}<b class="text-danger">*</b>
                              {{ Form::select('industry', $industries, null , ['class' => 'form-control', 'placeholder' => '--Select Industry']) }}
                              <!-- get message by name -->
                              @error('industry') 
                                <div  class="alart text-danger">{{ $message }}</div> 
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Client Name')}}<b class="text-danger">*</b>
                              {{ Form::select('client', $clients, null , ['class' => 'form-control', 'placeholder' => '--Select Client']) }}
                              @error('client')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Owner')}}<b class="text-danger">*</b>
                              {{ Form::select('owner', $owners, null , ['class' => 'form-control', 'placeholder' => '--Select Owner']) }}
                              @error('owner')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Project Scope')}}<b class="text-danger">*</b>
                              {{Form::text('projectScope', old('projectScope'), ['class' => 'form-control', 'placeholder' => 'Enter Project Scope'])}}
                              @error('projectScope')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Amount in BDT (Approximate) ')}}<b class="text-danger">*</b>
                              {{Form::text('amount', old('amount'), ['class' => 'form-control', 'placeholder' => 'Enter Amount'])}}
                              @error('amount')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Partner')}} 
                              {{Form::select('partner', $partners, null , ['class' => 'form-control', 'placeholder' => '--Select Partner'])}}
                              @error('partner')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Sponsor(Client)')}}
                              {{Form::text('sponsor', old('sponsor'), ['class' => 'form-control', 'placeholder' => 'Enter Sponsor'])}}
                              @error('sponsor')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Client Contact Person')}}
                              {{Form::text('contactPerson', old('contactPerson'), ['class' => 'form-control', 'placeholder' => 'Enter Client Contact Person'])}}
                              @error('contactPerson')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Contact Number')}}
                              {{Form::text('contactNumber', old('contactNumber'), ['class' => 'form-control', 'placeholder' => 'Enter Contact Number'])}}
                              @error('contactNumber')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>  
                      </div>

                      <div class="col-lg-6">
                          <div class="form-group">
                              {{Form::label('Current Status')}} 
                              {{Form::textarea('currentStatus', old('currentStatus'), ['class' => 'form-control text-area-height', 'placeholder' => 'Enter Current Status'])}}
                              @error('currentStatus')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror  
                          </div>
                          <div class="form-group">
                              {{Form::label('Next Course of Action')}}
                              {{Form::textarea('action', old('action'), ['class' => 'form-control', 'placeholder' => 'Enter Next Course of Action'])}}
                              @error('action')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror   
                          </div>

                          <div class="form-group">
                              {{Form::label('Prospect')}}<b class="text-danger">*</b>
                              {{Form::select('prospect', ['High' => 'High', 'Medium' => 'Medium', 'Low' => 'Low'], 
                                null, ['class' => 'form-control', 'placeholder' => '--Priority level'])}}
                              @error('prospect')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <div class="form-group">
                              {{Form::label('PO Closing Date')}}
                              {{Form::text('closingDate', old('closingDate'), ['class' => 'form-control', 'id'=>'datepicker', 'autocomplete'=>'off', 'placeholder' => 'dd/mm/yy'])}}
                              @error('closingDate')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Remarks')}}
                              {{Form::textarea('remarks', old('remarks'), ['class' => 'form-control', 'placeholder' => 'Enter Remarks'])}}
                              @error('remarks')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                        </div>
                        <div class="form-group">
                              {{Form::label("CEO's Remarks/Comments")}}
                              {{Form::textarea('ceoRemark', old('ceoRemark'), ['class' => 'form-control', 'placeholder' => "Enter CEO's Remarks"])}}
                              @error('ceoRemark')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                        </div>
                        
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group">
                          {{Form::label('Lead Type')}}<b class="text-danger">*</b>
                          <div class="form-group">
                            <label class="mr-3">
                                    {{ Form::radio('type', 'local') }} Local</label>
                            <label >{{ Form::radio('type', 'foreign') }} Foreign</label>
                          </div>
                          @error('type')
                            <div class="alart text-danger">{{ $message }}</div>
                          @enderror
                        </div>  
                      </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer form-row justify-content-center">
                  <a class="btn btn-outline-success float-right" href="{{ route('sales-funnel.index')}}"> Back</a>
                  {{Form::submit('Submit', ['class' => ['btn btn-success','ml-1']])}} 
                </div>
              {!! Form::close() !!}
              {{-- form end --}}
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-12 -->
        </div>
        <!-- /.Row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection

@section("scripts")
<script> 
  $(document).ready(function(){
  $('.alart').fadeIn().delay(6000).fadeOut();
  });
</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
       dateFormat: 'yy-mm-dd' 
    });
  } );
</script>

@endsection