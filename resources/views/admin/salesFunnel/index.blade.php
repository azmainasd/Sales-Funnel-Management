@extends('admin.layouts.app')
@section('css')
<!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin-item/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-item/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('main-content')
<!-- Main content -->
<div class="content-wrapper funnel">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 ">
          <div class="col-12 ">
            <h1>Sales Funnel</h1>  
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content sales-funnel-content">
      <div class="row">
        <div class="col-12">
            <div class="card sales-funnel-card">
              <div class="card-header text-center">
                <h3 class="card-title">All Projects</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if(Session::has('msg'))
                   <div  class="alert alert-success">{{ session('msg') }}</div> 
                @endif
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link px-4 border-outline-success
                      @if(session('type') != 'foreign')
                          active
                      @endif" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="
                      @if(session('type') != 'foreign')
                          true
                      @endif
                      ">Local </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link px-4
                      @if(session('type') == 'foreign')
                          active
                      @endif
                      " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="
                      @if(session('type') == 'foreign')
                       true
                      @endif
                      ">Foreign</a>
                    </li>
                    @can('Sales-Funnel-Create',Auth::user())
                      <a class="btn btn-outline-success ml-auto mb-2 p-1" href="{{route('sales-funnel.create')}}"><i class="fas fa-plus"></i> Add new</a>
                    @endcan
                  </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade 
                      @if(session('type') != 'foreign')
                        active show
                      @endif " id="home" role="tabpanel" aria-labelledby="home-tab">
                      <table id="example1" class="table table-bordered table-striped" >
                        <thead>
                          <tr>
                              <th>SL</th>
                              <th>Solution&nbsp;&nbsp;&nbsp;&nbsp;</th>
                              <th>Industry</th>
                              <th>Client</th>
                              <th>Owner</th>
                              <th>Project&nbsp;&nbsp;Scope</th>
                              <th>Amount&nbsp;in&nbsp;BDT (Approximate)</th>
                              <th>Partner</th>
                              <th>Sponsor</th>
                              <th>Previous&nbsp;&nbsp;Status</th>
                              <th>Current&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                              <th>Next&nbsp;Course&nbsp;of&nbsp;Actions</th>
                              <th>Prospect</th>
                              <th>PO&nbsp;Closing&nbsp;&nbsp;Date</th>
                              <th>Remarks</th>
                              <th>CEO's&nbsp;&nbsp;Remarks/Comments</th>
                              <th>Client&nbsp;&nbsp;contact Person</th>
                              <th>Contact Number</th>
                              @canany(['Sales-Funnel-Edit', 'Sales-Funnel-Delete'])
                              <th>Action</th>
                              @endcanany
                          </tr>
                        </thead>
                        <tbody> 
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
                              <td>
                                @if (!empty($lead->client->name))   
                                {{ $lead->client->name }}
                                @endif
                              </td>
                              <td>
                                @if (!empty($lead->owner->name))   
                                {{ $lead->owner->name }}
                                @endif
                              </td>
                              <td>{{ $lead->projectScope }}</td>
                              <td>{{ number_format($lead->amount) }}</td>
                              <td>
                                @if (!empty($lead->partner->name))                                   
                                {{ $lead->partner->name }}
                                @endif
                              </td>
                              <td>{{ $lead->sponsor }}</td>
                              <td>{{ $lead->previousStatus }}</td>
                              <td>{{ $lead->currentStatus }}</td>
                              <td>{{ $lead->action }}</td>
                              <td>{{ $lead->prospect }}</td>
                              <td>{{ Carbon\Carbon::parse($lead->closingDate)->format('d-M-Y') }}</td>
                              <td>{{ $lead->remarks }}</td>
                              <td>{{ $lead->ceoRemark }}</td>
                              <td>{{ $lead->contactPerson }}</td>
                              <td>{{ $lead->contactNumber }}</td>
                              @canany(['Sales-Funnel-Edit', 'Sales-Funnel-Delete'])
                              <td class="">
                                @can('Sales-Funnel-Edit',Auth::user())
                                <a class="mr-2" href="{{ route('sales-funnel.edit',[$lead->id]) }}"><i class="fas fa-edit"></i></a>
                                @endcan
                                @can('Sales-Funnel-Delete',Auth::user())
                                <a class="text-danger" href="" onclick="" data-toggle="modal" data-target="#exampleModal"><i id="delete" class="fas fa-trash"></i></a>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Delete Note</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          {!! Form::open(array('route' => ['sales-funnel.destroy',$lead->id], 'method' => 'POST', 'files' => true)) !!}
                                              @csrf
                                              @method('DELETE')
                                              <div class="modal-body">
                                                <div class="form-group">
                                                  {{Form::label('Remarks')}}<b class="text-danger">*</b>
                                                  {{Form::textarea('deleteRemarks',old('deleteRemarks'),['class'=>'form-control', 'placeholder' => 'Enter remarks','required'])}}
                                                  @error('deleteRemarks')
                                                    <div class="alart text-danger">{{ $message }}</div>
                                                  @enderror
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                              </div>
                                          {!! Form::close() !!}
                                      </div>
                                  </div>
                                </div>
                                @endcan
                              </td> 
                              @endcanany
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane fade 
                      @if(session('type') == 'foreign')
                        active show
                      @endif " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <table id="example2" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Solution</th>
                            <th>Industry</th>
                            <th>Client</th>
                            <th>Owner</th>
                            <th>Project&nbsp;&nbsp;Scope</th>
                            <th>Amount&nbsp;in&nbsp;BDT (Approximate)</th>
                            <th>Partner</th>
                            <th>Sponsor</th>
                            <th>Previous&nbsp;&nbsp;Status</th>
                            <th>Current&nbsp;&nbsp;Status</th>
                            <th>Next&nbsp;Course&nbsp;of&nbsp;Actions</th>
                            <th>Prospect</th>
                            <th>PO&nbsp;Closing&nbsp;&nbsp;Date</th>
                            <th>Remarks</th>
                            <th>CEO's&nbsp;&nbsp;Remarks/Comments</th>
                            <th>Client&nbsp;&nbsp;contact Person</th>
                            <th>Contact Number</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
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
                            <td>
                              @if (!empty($lead->client->name))   
                              {{ $lead->client->name }}
                              @endif
                            </td>
                            <td>
                              @if (!empty($lead->owner->name))   
                              {{ $lead->owner->name }}
                              @endif
                            </td>
                            <td>{{ $lead->projectScope }}</td>
                            <td>{{ number_format($lead->amount) }}</td>
                            <td>
                              @if (!empty($lead->partner->name))                                   
                              {{ $lead->partner->name }}
                              @endif
                            </td>
                              <td>{{ $lead->sponsor }}</td>
                              <td>{{ $lead->previousStatus }}</td>
                              <td>{{ $lead->currentStatus }}</td>
                              <td>{{ $lead->action }}</td>
                              <td>{{ $lead->prospect }}</td>
                              <td>{{ $lead->closingDate }}</td>
                              <td>{{ $lead->remarks }}</td>
                              <td>{{ $lead->ceoRemark }}</td>
                              <td>{{ $lead->contactPerson }}</td>
                              <td>{{ $lead->contactNumber }}</td>
                              <td class="">
                                <a class="mr-3" href="{{ route('sales-funnel.edit',[$lead->id]) }}"><i class="fas fa-edit"></i></a>
                                <a class="text-danger" href="" onclick="" data-toggle="modal" data-target="#exampleModal2"><i id="delete" class="fas fa-trash"></i></a>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Delete Note</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          {!! Form::open(array('route' => ['sales-funnel.destroy',$lead->id], 'method' => 'POST', 'files' => true)) !!}
                                              @csrf
                                              @method('DELETE')
                                              <div class="modal-body">
                                                <div class="form-group">
                                                  {{Form::label('Remarks')}}<b class="text-danger">*</b>
                                                  {{Form::textarea('deleteRemarks',old('deleteRemarks'),['class'=>'form-control', 'placeholder' => 'Enter remarks','required'])}}
                                                  @error('deleteRemarks')
                                                    <div class="alart text-danger">{{ $message }}</div>
                                                  @enderror
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                  <button type="submit" class="btn btn-danger">Delete</button>
                                              </div>
                                          {!! Form::close() !!}
                                      </div>
                                  </div>
                                </div>
                              </td> 
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-12 -->
      </div>
      <!-- /.row -->
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
<script src="{{ asset('admin-item/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin-item/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false, "lengthChange": true, "autoWidth": true,
      "pageLength": 3,
      buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ]
                }
            },
         ],
      columnDefs: [
             { orderable: false, targets: -1 },
             
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
  $(function () {
    $("#example2").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": true,
      "pageLength": 3,
      buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ]
                }
            },
         ]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
  $(document).ready(function(){
  $('.alert-success').fadeIn().delay(3000).fadeOut();
    });
</script>
@endsection