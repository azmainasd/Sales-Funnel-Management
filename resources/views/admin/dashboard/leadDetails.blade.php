@extends('admin.layouts.app')

@section('main-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header pb-0">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 ">
            <h1>Lead Details</h1>  
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content lead-details-section">
      <div class="text-right">
          <a class="add-btn btn btn-success mb-1" href="{{ route('dashboard.index') }}"><i class="fas fa-arrow-circle-left"></i> Back</a>
      </div>
      <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header custom-bg">
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped " >
                    <thead class="thead-backgroung">
                        <tr>
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
                            <th>Next&nbsp;Course of Actions</th>
                            <th>Prospect</th>
                            <th>Closing&nbsp;&nbsp;Date (estimated)</th>
                            <th>Remarks</th>
                            <th>CEO's&nbsp;&nbsp;Remarks/Comments</th>
                            <th>Client&nbsp;&nbsp;contact Person</th>
                            <th>Contact Number</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                            <td>
                              @if (!empty($funnelLead->solution->name))   
                              {{ $funnelLead->solution->name }}
                              @endif
                            </td>
                            <td>
                              @if (!empty($funnelLead->industry->name))   
                              {{ $funnelLead->industry->name }}
                              @endif
                            </td>
                            <td>
                              @if (!empty($funnelLead->client->name))   
                              {{ $funnelLead->client->name }}
                              @endif
                            </td>
                            <td>
                              @if (!empty($funnelLead->owner->name))   
                              {{ $funnelLead->owner->name }}
                              @endif
                            </td>
                            <td>{{ $funnelLead->projectScope }}</td>
                            <td>{{ number_format($funnelLead->amount) }}</td>
                            <td>
                              @if (!empty($funnelLead->partner->name))                                   
                              {{ $funnelLead->partner->name }}
                              @endif
                            </td>
                            <td>{{ $funnelLead->sponsor }}</td>
                            <td>{{ $funnelLead->previousStatus }}</td>
                            <td>{{ $funnelLead->currentStatus }}</td>
                            <td>{{ $funnelLead->action }}</td>
                            <td>{{ $funnelLead->prospect }}</td>
                            <td>{{ Carbon\Carbon::parse($funnelLead->closingDate)->format('d-M-Y') }}</td>
                            <td>{{ $funnelLead->remarks }}</td>
                            <td>{{ $funnelLead->ceoRemark }}</td>
                            <td>{{ $funnelLead->contactPerson }}</td>
                            <td>{{ $funnelLead->contactNumber }}</td>
                        </tr>
                    </tbody>
                </table>
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": true,
      "searching": false, "paging": false, "info": false
    })
  });
</script>
@endsection

