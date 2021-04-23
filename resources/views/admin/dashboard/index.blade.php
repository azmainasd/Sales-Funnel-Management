@extends('admin.layouts.app')
@section('css')
<!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin-item/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-item/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('main-content')
<!-- Main content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 ">
        <div class="col-12">
          <h1>Dashboard</h1>  
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content dashboard-section">
    {{-- Tab Panel --}}
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#localLeads" role="tab" aria-controls="home" aria-selected="true">LOCAL LEADS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#foreignLeads" role="tab" aria-controls="profile" aria-selected="false">FOREIGN LEADS</a>
      </li>
    </ul>
    {{-- tab panel end --}}
    <div class="tab-content" id="myTabContent">

      <div class="tab-pane fade show active" id="localLeads" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="summary pb-2">
                <strong class="">Summary</strong>
              </div>  
                <!-- /.card-header -->
                <div class="card-body">
                  
                  <div class="row db-head">      
                    <div class="col-md-4 local-leads-summary-1" id="leadLocal">
                      @php
                        $count = 0;
                        $amount = 0;
                        foreach ($localLeads as $lead){
                         $amount += $lead->amount;
                         $count += 1;
                        }
                      @endphp
                      <div class="mb-1">
                        <a href="#" class="all" data-value={{ number_format($amount) }} style="margin-right: 4.9em;"><b>TOTAL LEADS</b> </a> 
                        <b>:</b>
                        <b style="margin-left: 2%;">{{ $count }}</b>
                      </div>
                      <div class="mb-1">
                        <a href="#" class="high_medium" data-value={{ number_format($lclHeigLeadsAmount) }} style="margin-right: .5em;"><b>HIGH PROSPECT LEADS</b></a>
                        <b>:</b>
                        <b class="high_medium_val" style="margin-left: 2%;">{{ $localHeighProspectLds }}</b>
                      </div>
                      <div>
                        <a href="#" class="low" data-value={{ number_format($lclLowLeadsAmount) }} style="margin-right: 0.8em;"><b>LOW PROSPECT LEADS</b></a>
                        <b>:</b> 
                        <b class="low_val" style="margin-left: 2%;">{{ $LocalLowProspectLds }}</b> 
                      </div>
                    </div>

                    <div class="col-md-4 local-leads-summary-2">
                      <div class="mb-1">
                        <span class="amountTitle" style="margin-right: 0.9em;"> <b>TOTAL AMOUNT</b> </span> 
                        <b class="">:</b> 
                        <b class="totalAmount" style="margin-left: 2%;"> {{ number_format($amount) }} </b> 
                        <b>BDT</b> 
                      </div>
                      <div class="mb-1">
                        <a href="#" id="local_secured_leads" style="margin-right: 0.6em;"><b> SECURED LEADS</b></a> 
                        <b>:</b>
                        <b style="margin-left: 2%;">{{ $LocalSecuredLds }}</b>
                      </div>
                      <div>
                        <a href="#" class="text-danger" id="local_deleted_leads" style="margin-right: 0.7em;"><b> DELETED LEADS</b></a> 
                        <b>:</b> 
                        <b style="margin-left: 2%;">{{ $LocalDeletedLds }} </b> 
                      </div>  
                    </div>   
                    
                    <div class="col-md-4 local-leads-summary-3 ">
                      
                      <div class="form-group row">
                        
                        <div class="col-md-12 d-flex justify-content-end mb-3">
                          <label class="from-date-picker-lable" for="">FROM :</label>
                          <input type="text" name="date" id="localDateStart" value="" class="pickdate" autocomplete="off" placeholder=" Select Start Date">
                        </div> 

                        <div class="col-md-12 d-flex justify-content-end">
                          <label class="to-date-picker-lable" for="">TO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                          <input type="text" name="date" id="localDateEnd" value="" class="pickdate" autocomplete="off" placeholder="  Select End Date">   
                        </div>

                      </div>

                    </div>  
                  </div>
                  
                  <table id="example1" class="table table-hover table-striped border-bottom">
                    <thead class="thead-backgroung">
                      <tr>
                        <th>SL</th>
                        <th>Solution</th>
                        <th>Industry</th>
                        <th>Client</th>
                        <th>Amount</th>
                        <th>Prospect</th>
                        <th>PO&nbsp;Closing Date</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody id="local_table">
                      @foreach ($localLeads as $lead)   
                      <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>
                          @if (!empty($lead->solution->name))   
                          {{ $lead->solution->name }}
                          @endif
                        </td>
                        <td>
                          @if (!empty($lead->industry->name))   
                          {{ $lead->industry->name }}
                          @endif
                        </td>
                        <td>@if (!empty($lead->client->name))   
                          {{ $lead->client->name }}
                          @endif
                        </td>
                        <td>{{ number_format($lead->amount)  }}</td>
                        <td>{{ $lead->prospect }}</td>
                        <td>{{ Carbon\Carbon::parse($lead->closingDate)->format('d-M-Y') }}</td>
                        <td><a class="mr-2 btn" href="{{ route('lead.details',[$lead->id]) }}"><i class="far fa-eye "></i></a></td>
                      </tr>
                      @endforeach
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
          <!-- /.col-12 -->
        </div>
      </div>
      {{-- Local Tab End --}}

      <div class="tab-pane fade" id="foreignLeads" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row">
          <div class="col-12">
              <div class="card">
                <div class="summary pb-2">
                  <strong class="">Summary</strong>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    
                    <div class="col-md-4 foreign-leads-summary-1" class="" id="leadForeign">
                      @php
                        $count = 0;
                        $amount = 0;
                        foreach ($foreignLeads as $lead){
                         $amount += $lead->amount;
                         $count += 1;
                        }
                      @endphp
                      <div class="mb-1">
                        <a href="#" class="all" data-value={{ number_format($amount) }} style="margin-right: 4.9em;"><b>TOTAL LEADS</b> </a> 
                        <b>:</b>
                        <b style="margin-left: 2%;">{{ $count }}</b>
                      </div>
                      <div class="mb-1">
                        <a href="#" class="high_medium" data-value={{ number_format($fgnHeigLeadsAmount) }} style="margin-right: .5em;"><b>HIGH PROSPECT LEADS</b></a> 
                        <b>:</b>
                        <b class="high_medium_fgn_val" style="margin-left: 2%;">{{ $foreignHeighProspectLds }}</b>
                      </div>
                      <div>
                        <a href="#" class="low" data-value={{ number_format($fgnLowLeadsAmount) }} style="margin-right: 0.8em;"><b>LOW PROSPECT LEADS</b></a> 
                        <b>:</b> 
                        <b class="low_fgn_val" style="margin-left: 2%;">{{ $foreignLowProspectLds }}</b> 
                      </div>
                    </div>

                    <div class="col-md-4 foreign-leads-summary-2">
                      <div class="mb-1">
                        <span class="foreignAmountTitle" style="margin-right: 0.9em;"> <b>TOTAL AMOUNT</b> </span> 
                        <b>:</b> 
                        <b class="totalForeignAmount" style="margin-left: 2%;"> {{ number_format($amount) }} </b> 
                        <b>USD</b>
                      </div>
                      <div class="mb-1">
                        <a href="#" id="foreign_secured_leads" style="margin-right: 0.6em;"><b> SECURED LEADS</b></a> 
                        <b>:</b>
                        <b style="margin-left: 2%;">{{ $foreignSecuredLds }}</b>
                      </div>
                      <div>
                        <a href="#" class="text-danger" id="foreign_deleted_leads" style="margin-right: 0.7em;"><b> DELETED LEADS</b></a> 
                        <b>:</b> 
                        <b style="margin-left: 2%;">{{ $foreignDeletedLds }} </b> 
                      </div>  
                    </div>  

                    <div class="col-md-4 foreign-leads-summary-3 ">
                      <div class="form-group row">
                        
                        <div class="col-md-12 d-flex justify-content-end mb-3">
                          <label class="from-date-picker-lable" for="">FROM :</label>
                          <input type="text" name="date" id="foreignDateStart" value="" class="pickdate" autocomplete="off" placeholder=" Select Start Date">
                        </div> 

                        <div class="col-md-12 d-flex justify-content-end">
                          <label class="to-date-picker-lable" for="">TO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                          <input type="text" name="date" id="foreignDateEnd" value="" class="pickdate" autocomplete="off" placeholder=" Select End Date">   
                        </div>

                      </div>
                    </div>

                  </div>
                  
                  <table id="example2" class="table table-striped border-bottom" width="100%">
                    <thead class="thead-backgroung">
                      <tr>
                        <th>SL</th>
                        <th>Solution</th>
                        <th>Industry</th>
                        <th>Client</th>
                        <th>Amount</th>
                        <th>Prospect</th>
                        <th>PO&nbsp;Closing&nbsp;&nbsp;Date</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody id="foreign_table">
                      @foreach ($foreignLeads as $lead)   
                      <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>
                          @if (!empty($lead->solution->name))   
                          {{ $lead->solution->name }}
                          @endif
                        </td>
                        <td>
                          @if (!empty($lead->industry->name))   
                          {{ $lead->industry->name }}
                          @endif
                        </td>
                        <td>@if (!empty($lead->client->name))   
                          {{ $lead->client->name }}
                          @endif
                        </td>
                        <td>{{ number_format($lead->amount) }}</td>
                        <td>{{ $lead->prospect }}</td>
                        <td>{{ Carbon\Carbon::parse($lead->closingDate)->format('d-M-Y') }}</td>
                        <td><a class="mr-2 btn" href="{{ route('lead.details',[$lead->id]) }}"><i class="far fa-eye "></i></a></td>
                      </tr>
                      @endforeach
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
          <!-- /.col-12 -->
        </div>
      </div>
      {{-- Foreign Tab End --}}

    </div>
    {{-- tab content end --}}
  </section>
  <!-- /.content -->
</div>
@endsection

@section('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin-item/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
  //***** Local leads data table
  // "responsive": false, "lengthChange": true, "autoWidth": false,  "search": {regex: true},
  //     "scrollX": true, "scrollY": "600px", "info": false, "searching": true, "paging": false,
  tableLcl = $("#example1").DataTable({
    "responsive": false,"lengthChange": false, "searching": true, "search": {regex: true}, "autoWidth": true,"info": false, 
      columnDefs: [
        { orderable: false, targets: -1 }
      ]
    });

  // filtering high and low prospect project on local leads table
  $('#leadLocal').on('click', 'a.high_medium', function() {
    // console.log(v); // this prints something, now.
    $('.local-leads-summary-1 .high_medium b, .high_medium_val, .totalAmount, .amountTitle').css("color", "#48b66d");
    $('.local-leads-summary-1 .low b, .low_val').css("color", "black");
    $( ".local-leads-summary-2 .totalAmount" ).html($(this).data('value'));
    tableLcl
      .columns(5)
      .search("High|Medium|Solid|NIR", true, true)
      .order('asc')
      .draw();
  });

  $('#leadLocal').on('click', 'a.low', function() {
    
    $('.local-leads-summary-1 .high_medium b,.high_medium_val').css("color", "black");
    $('.local-leads-summary-1 .low b, .low_val, .totalAmount, .amountTitle').css("color", "#48b66d");
    // $(this).css("color", "#48b66d");

    $( ".local-leads-summary-2 .totalAmount" ).html($(this).data('value'));
    tableLcl
      .columns(5)
      .search('low')
      .draw();
  });

  $('#leadLocal').on('click', 'a.all', function() {

    $('.local-leads-summary-1 .high_medium b, .high_medium_val').css("color", "black");
    $('.local-leads-summary-1 .low b, .low_val').css("color", "black");
    $('.amountTitle, .totalAmount').css("color", "black");
    // window.location.reload(true);
    $( ".local-leads-summary-2 .totalAmount" ).html($(this).data('value'));
    tableLcl
      .search('')
      .columns(5)
      .search('') 
      .columns(0)
      .order('asc')
      .draw();
  });
  // filtering end

  // Fetch local secured leads
  $('#local_secured_leads').on('click',function(){
    
    $('.local-leads-summary-1 .high_medium b, .high_medium_val').css("color", "black");
    $('.local-leads-summary-1 .low b, .low_val').css("color", "black");
    $('.amountTitle, .totalAmount').css("color", "black");

    $.get("{{ URL::to('get-local-secured-leads') }}",function(data){
 
      $('#local_table').empty();
      $.each(data,function(i,value){
        var id = value.id;   
        var tr = $("<tr/>");
            tr.append($('<td/>',{
              text : ++i
            }))
            .append($('<td/>',{
              text : value.solution.name
            }))
            .append($('<td/>',{
              text : value.industry.name
            }))
            .append($('<td/>',{
              text : value.client.name
            }))
            .append($('<td/>',{
              text : value.amount
            }))
            .append($('<td/>',{
              text : value.prospect
            }))
            .append($('<td/>',{
              text : value.closingDate
            }))
            .append("<td><a href='secured-lead-details/"+id+"'><i class='far fa-eye'></i></a></td>")
   
          $('#local_table').append(tr);
        });
    });
  })
  
  // Fetch local deleted leads
  $('#local_deleted_leads').on('click',function(){

    $('.local-leads-summary-1 .high_medium b, .high_medium_val').css("color", "black");
    $('.local-leads-summary-1 .low b, .low_val').css("color", "black");
    $('.amountTitle, .totalAmount').css("color", "black");
    
    $.get("{{ URL::to('get-local-deleted-leads') }}",function(data){
      
      $('#local_table').empty();
      $.each(data,function(i,value){
        var id = value.id;
        var tr = $("<tr/>");
            tr.append($('<td/>',{
              text : ++i
            }))
            .append($('<td/>',{
              text : value.solution.name
            }))
            .append($('<td/>',{
              text : value.industry.name
            }))
            .append($('<td/>',{
              text : value.client.name
            }))
            .append($('<td/>',{
              text : value.amount
            }))
            .append($('<td/>',{
              text : value.prospect
            }))
            .append($('<td/>',{
              text : value.closingDate
            }))
            .append("<td><a href='deleted-lead-details/"+id+"'><i class='far fa-eye'></i></a></td>")
    
        $('#local_table').append(tr);
      });
    });
  })

  // Local panel date picker
  $( function() {
		$( "#localDateStart" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});

  $( function() {
		$( "#localDateEnd" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
  
  //**** Filtering local table by closing date range
  $('#localDateEnd').on('change', function() {
    var minDate = $.datepicker.formatDate('yy-mm-dd', new Date($("#localDateStart").val())); // formating date as DB format
    var maxDate = $.datepicker.formatDate('yy-mm-dd', new Date($("#localDateEnd").val()));  // formating date as DB format
    $.ajax({
        type:"GET",
        url:"{{url('local-leads-date-filter')}}/"+minDate+"/"+maxDate,
        success:function(response) {
          console.log(response);
          $('#local_table').empty();
          $.each(response,function(i,value){
            var id = value.id;
            var dateFormat = $.datepicker.formatDate('dd M, yy', new Date(value.closingDate));
            console.log(dateFormat);
    
            var tr = $("<tr/>");
            tr.append($('<td/>',{
                text : ++i
            }))
            .append($('<td/>',{
              text : value.solution.name
            }))
            .append($('<td/>',{
              text : value.industry.name
            }))
            .append($('<td/>',{
              text : value.client.name
            }))
            .append($('<td/>',{
              text : value.amount
            }))
            .append($('<td/>',{
              text : value.prospect
            }))
            .append($('<td/>',{
              text : dateFormat
            }))
            .append("<td><a href='secured-lead-details/"+id+"'><i class='far fa-eye'></i></a></td>")
            $('#local_table').append(tr);
          });
        }
    });  
  })
</script>

<script>
  // foreign leads data table
  tableFgn = $("#example2").DataTable({
    "responsive": false,"lengthChange": false, "searching": true, "search": {regex: true}, "autoWidth": true,"info": false,
      columnDefs: [
        { orderable: false, targets: -1 }
      ]
    }) 

  // filtering high and low prospect projects on foreign leads table
  $('#leadForeign').on('click', 'a.high_medium', function() {
    $('.foreign-leads-summary-1 .high_medium b, .high_medium_fgn_val, .foreignAmountTitle, .totalForeignAmount').css("color", "#48b66d");
    $('.foreign-leads-summary-1 .low b, .low_val').css("color", "black");
    $(".foreign-leads-summary-2 .totalForeignAmount").html($(this).data('value'));
    tableFgn
      .columns(5)
      .search("High|Medium|Solid|NIR", true, true)
      .order( 'asc' )
      .draw();
  });

  $('#leadForeign').on('click', 'a.low', function() {
    $('.foreign-leads-summary-1 .high_medium b,.high_medium_val').css("color", "black");
    $('.foreign-leads-summary-1 .low b, .low_fgn_val, .foreignAmountTitle,.totalForeignAmount').css("color", "#48b66d");
    $(".foreign-leads-summary-2 .totalForeignAmount" ).html($(this).data('value')); //insert value into total amount
    tableFgn
      .columns(5)
      .search($(this).data('values'))
      .draw();
  });

  $('#leadForeign').on('click', 'a.all', function() {

    $('.foreign-leads-summary-1 .high_medium b, .high_medium_fgn_val').css("color", "black");
    $('.foreign-leads-summary-1 .low b, .low_fgn_val').css("color", "black");
    $('.foreignAmountTitle, .totalForeignAmount').css("color", "black");

    $( ".foreign-leads-summary-2 .totalForeignAmount" ).html($(this).data('value'));
    tableFgn
      .search('')
      .columns(5)
      .search('') 
      .columns(0)
      .order('asc')
      .draw();
  });

  $('#foreign_secured_leads').on('click',function(){

    $('.foreign-leads-summary-1 .high_medium b, .high_medium_fgn_val').css("color", "black");
    $('.foreign-leads-summary-1 .low b, .low_fgn_val').css("color", "black");
    $('.foreignAmountTitle, .totalForeignAmount').css("color", "black");

    $( ".foreign-leads-summary-2 .totalForeignAmount" ).html($(this).data('value'));
    $.get("{{ URL::to('get-foreign-secured-leads') }}",function(data){
 
      $('#foreign_table').empty();
      $.each(data,function(i,value){
        var id = value.id;        
        var tr = $("<tr/>");
            tr.append($('<td/>',{
              text : ++i
            }))
            .append($('<td/>',{
              text : value.solution.name
            }))
            .append($('<td/>',{
              text : value.industry.name
            }))
            .append($('<td/>',{
              text : value.client.name
            }))
            .append($('<td/>',{
              text : value.amount
            }))
            .append($('<td/>',{
              text : value.prospect
            }))
            .append($('<td/>',{
              text : value.closingDate
            }))
            .append("<td><a href='secured-lead-details/"+id+"'><i class='far fa-eye'></i></a></td>")
    
        $('#foreign_table').append(tr);
      });
    });
  })

  $('#foreign_deleted_leads').on('click',function(){
    
    $('.foreign-leads-summary-1 .high_medium b, .high_medium_fgn_val').css("color", "black");
    $('.foreign-leads-summary-1 .low b, .low_fgn_val').css("color", "black");
    $('.foreignAmountTitle, .totalForeignAmount').css("color", "black");

    $.get("{{ URL::to('get-foreign-deleted-leads') }}",function(data){

        $('#foreign_table').empty();
        $.each(data,function(i,value){
          var id = value.id;
          console.log(value.closingDate);
          
          var tr = $("<tr/>");
              tr.append($('<td/>',{
                text : ++i
              }))
              .append($('<td/>',{
                text : value.solution.name
              }))
              .append($('<td/>',{
                text : value.industry.name
              }))
              .append($('<td/>',{
                text : value.client.name
              }))
              .append($('<td/>',{
                text : value.amount
              }))
              .append($('<td/>',{
                text : value.prospect
              }))
              .append($('<td/>',{
                text : value.closingDate
              }))
              .append("<td><a href='deleted-lead-details/"+id+"'><i class='far fa-eye'></i></a></td>")   
              
          $('#foreign_table').append(tr);
        });
    });
  })

  // Foreign panel date picker
  $( function() {
		$( "#foreignDateStart" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});

  $( function() {
		$( "#foreignDateEnd" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
   
  $('#foreignDateEnd').on('change', function() {
    // window.location.reload(true);
    var minDate = $.datepicker.formatDate('yy-mm-dd', new Date($("#foreignDateStart").val()));
    var maxDate = $.datepicker.formatDate('yy-mm-dd', new Date($("#foreignDateEnd").val()));
    console.log(minDate);
    console.log(maxDate);
    $.ajax({
      type:"GET",
      url:"{{url('foreign-leads-date-filter')}}/"+minDate+"/"+maxDate,

      success:function(response) {
        console.log(response);
        $('#foreign_table').empty();
        $.each(response,function(i,value){
          var id = value.id;
          var dateFormat = $.datepicker.formatDate('dd M, yy', new Date(value.closingDate));
          console.log(dateFormat);
  
          var tr = $("<tr/>");
          tr.append($('<td/>',{
              text : ++i
          }))
          .append($('<td/>',{
            text : value.solution.name
          }))
          .append($('<td/>',{
            text : value.industry.name
          }))
          .append($('<td/>',{
            text : value.client.name
          }))
          .append($('<td/>',{
            text : value.amount
          }))
          .append($('<td/>',{
            text : value.prospect
          }))
          .append($('<td/>',{
            text : dateFormat
          }))
          .append("<td><a href='secured-lead-details/"+id+"'><i class='far fa-eye'></i></a></td>")
          $('#foreign_table').append(tr);
        });
      }
    });   
  })

</script>

@endsection

      
     
 