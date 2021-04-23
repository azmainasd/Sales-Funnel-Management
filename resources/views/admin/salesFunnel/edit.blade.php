@extends('admin.layouts.app')
@section('main-content')
  <!-- Main content -->
  <div class="content-wrapper">
    <section class="content funnel-edit">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-sm-12 ">
            <!-- general form elements -->
            <div class="card card-success my-5">
              <div class="card-header">
                <h3 class="card-title">Update Lead</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::open(array('route' => ['sales-funnel.update',$lead->id], 'method' => 'POST', 'files' => true)) !!}
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-row">
                      <div class="col-lg-6">
                          
                          <div class="form-group">
                              {{Form::label('Solution')}}<b class="text-danger">*</b>
                              {{ Form::select('solution',$solutions, $lead->solution->id ,[$lead->solution->name == $solutions, 'class' => 'form-control']) }}
                              <!-- get message by name -->
                              @error('solution') 
                                <div  class="alart text-danger">{{ $message }}</div> 
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Industry')}}<b class="text-danger">*</b>
                              {{ Form::select('industry',$industries, $lead->industry->id ,[$lead->industry->name == $industries, 'class' => 'form-control']) }}
                              <!-- get message by name -->
                              @error('industry') 
                                <div  class="alart text-danger">{{ $message }}</div> 
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Client Name')}}<b class="text-danger">*</b>
                              {{ Form::select('client',$clients, $lead->client->id ,[$lead->client->name == $clients, 'class' => 'form-control']) }}
                              @error('client')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Owner')}}<b class="text-danger">*</b>
                              {{ Form::select('owner',$owners, $lead->owner->id ,[$lead->owner->name == $owners, 'class' => 'form-control']) }}
                              @error('owner')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Project Scope')}}<b class="text-danger">*</b>
                              {{Form::text('projectScope', $lead->projectScope, ['class' => 'form-control', 'placeholder' => 'Enter Project Scope'])}}
                              @error('projectScope')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Amount in BDT (Approximate) ')}}<b class="text-danger">*</b>
                              {{Form::text('amount', $lead->amount, ['class' => 'form-control', 'placeholder' => 'Enter Amount'])}}
                              @error('amount')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              @if (!empty($lead->partner->id))
                                {{Form::label('Partner')}} 
                                {{ Form::select('partner',$partners, $lead->partner->id ,[$lead->partner->name == $partners, 'class' => 'form-control']) }}
                                @error('partner')
                                 <div class="alart text-danger">{{ $message }}</div>
                                @enderror
                              @else  
                                {{Form::label('Partner')}} 
                                {{Form::select('partner', $partners, null , ['class' => 'form-control', 'placeholder' => '--Select Partner'])}}
                                @error('partner')
                                  <div class="alart text-danger">{{ $message }}</div>
                                @enderror
                              @endif
                          </div>
                          <div class="form-group">
                              {{Form::label('Sponsor(Client)')}}
                              {{Form::text('sponsor', $lead->sponsor, ['class' => 'form-control', 'placeholder' => 'Enter Sponsor'])}}
                              @error('sponsor')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Client Contact Person')}}
                              {{Form::text('contactPerson', $lead->contactPerson, ['class' => 'form-control', 'placeholder' => 'Enter Client Contact Person'])}}
                              @error('contactPerson')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Contact Number')}}
                              {{Form::text('contactNumber', $lead->contactNumber, ['class' => 'form-control', 'placeholder' => 'Enter Contact Number'])}}
                              @error('contactNumber')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>   
                      </div>

                      <div class="col-lg-6">
                          <div class="form-group">
                              {{Form::label('Current Status')}} 
                              {{Form::textarea('currentStatus', $lead->currentStatus, ['class' => 'form-control', 'placeholder' => 'Enter Current Status'])}}
                              @error('currentStatus')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror  
                          </div>
                          <div class="form-group">
                              {{Form::label('Next Course of Action')}}
                              {{Form::textarea('action', $lead->action, ['class' => 'form-control', 'placeholder' => 'Enter Next Course of Action'])}}
                              @error('action')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror   
                          </div>

                          <div class="form-group">
                              {{Form::label('Prospect')}}<b class="text-danger">*</b>
                              {{Form::select('prospect', ['High' => 'High', 'Medium' => 'Medium', 'Low' => 'Low'], $lead->prospect, ['class' => 'form-control'])}}
                              @error('prospect')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <div class="form-group">
                              {{Form::label('PO Closing Date')}}
                              {{Form::text('closingDate', $lead->closingDate, ['class' => 'form-control', 'id' => 'datepicker', 'autocomplete'=>'off', 'placeholder' => 'Enter Permanent Name'])}}
                              @error('closingDate')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="form-group">
                              {{Form::label('Remarks')}}
                              {{Form::textarea('remarks', $lead->remarks, ['class' => 'form-control', 'placeholder' => 'Enter Remarks'])}}
                              @error('remarks')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                        </div>
                        <div class="form-group">
                              {{Form::label("CEO's Remarks/Comments")}}
                              {{Form::textarea('ceoRemark', $lead->ceoRemark, ['class' => 'form-control', 'placeholder' => "Enter CEO's Remarks"])}}
                              @error('ceoRemark')
                                <div class="alart text-danger">{{ $message }}</div>
                              @enderror
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group">
                          {{Form::label('Project Sate: ')}} 
                          {{Form::checkbox('state', 1,null, ['class' => 'ml-2 show-fields', 'onClick' => 'checkFunction()', 'id' => 'hidden_field'] ) }}
                          {{Form::label('Secured')}}
                          @error('type')
                            <div class="alart text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                    </div>
                    {{-- hidden fields --}}
                    <div class="hidden-field form-row" id="hidden-item" style="display: none">
                      <div class="col-lg-3">
                        <div class="form-group">
                          {{Form::label('PO Number')}}<b class="text-danger">*</b>
                          {{Form::text('poNumber',old('poNumber') , ['class' => 'form-control', 'placeholder' => 'Enter Number'])}}
                          @error('poNumber')
                            <div class="alart text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          {{Form::label('PO Amount')}}<b class="text-danger">*</b>
                          {{Form::text('poAmount', old('poAmount'), ['class' => 'form-control', 'placeholder' => 'Enter Amount'])}}
                          @error('poAmount')
                            <div class="alart text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          {{Form::label('PO Date')}}<b class="text-danger">*</b>
                          {{Form::text('poDate',old('poDate') , ['class' => 'form-control', 'id' => 'datepicker1', 'autocomplete'=>'off', 'placeholder' => 'Enter Date'])}}
                          @error('contactNumber')
                            <div class="alart text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          {{Form::label('PO Expiry Date')}}<b class="text-danger">*</b>
                          {{Form::text('poExpiryDate', old('poExpiryDate'), ['class' => 'form-control', 'id' => 'datepicker2', 'autocomplete'=>'off', 'placeholder' => 'Enter Expiry Date'])}}
                          @error('poExpiryDate')
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
<script> 
  $(document).ready(function(){
  $('.alart').fadeIn().delay(6000).fadeOut();
  });
</script>
<script>
  function checkFunction() {
    var checkBox = document.getElementById("hidden_field").checked;
    var x = document.getElementById('hidden-item');
    if (checkBox){  
      if(confirm('Are you sure, You Want to secure this?'))
        x.style.display = '';
      else
        event.preventDefault();
    }
    else {
      x.style.display = 'none';  
    }    
  }
</script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
       dateFormat: 'yy-mm-dd' 
    });
  } );
</script>
<script>
  $( function() {
    $( "#datepicker1" ).datepicker({
       dateFormat: 'yy-mm-dd' 
    });
  } );
</script>
<script>
  $( function() {
    $( "#datepicker2" ).datepicker({
      dateFormat: 'yy-mm-dd' 
    });
  } );
</script>
@endsection