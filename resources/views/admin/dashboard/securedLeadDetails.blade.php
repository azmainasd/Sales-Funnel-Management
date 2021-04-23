@extends('admin.layouts.app')

@section('main-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 ">
          <div class="col-12 ">
            <h1>Secured Lead Details</h1>  
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
                <table id="example1" class="table table-bordered table-striped" >
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
                            <th>Secured&nbsp;&nbsp;Date</th>
                            <th>PO&nbsp;&nbsp;Number</th>
                            <th>PO&nbsp;&nbsp;Amount</th>
                            <th>PO&nbsp;&nbsp;Date</th>
                            <th>PO&nbsp;Expiry&nbsp;Date</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                            <td>
                              @if (!empty($securedLeadDetails->solution->name))   
                              {{ $securedLeadDetails->solution->name }}
                              @endif
                            </td>
                            <td>
                              @if (!empty($securedLeadDetails->industry->name))   
                              {{ $securedLeadDetails->industry->name }}
                              @endif
                            </td>
                            <td>
                              @if (!empty($securedLeadDetails->client->name))   
                              {{ $securedLeadDetails->client->name }}
                              @endif
                            </td>
                            <td>
                              @if (!empty($securedLeadDetails->owner->name))   
                              {{ $securedLeadDetails->owner->name }}
                              @endif
                            </td>
                            <td>{{ $securedLeadDetails->projectScope }}</td>
                            <td>{{ number_format($securedLeadDetails->amount) }}</td>
                            <td>
                              @if (!empty($securedLeadDetails->partner->name))                                   
                              {{ $securedLeadDetails->partner->name }}
                              @endif
                            </td>
                            <td>{{ $securedLeadDetails->sponsor }}</td>
                            <td>{{ $securedLeadDetails->previousStatus }}</td>
                            <td>{{ $securedLeadDetails->currentStatus }}</td>
                            <td>{{ $securedLeadDetails->action }}</td>
                            <td>{{ $securedLeadDetails->prospect }}</td>
                            <td>{{ Carbon\Carbon::parse($securedLeadDetails->closingDate)->format('d-M-Y') }}</td>
                            <td>{{ $securedLeadDetails->remarks }}</td>
                            <td>{{ $securedLeadDetails->ceoRemark }}</td>
                            <td>{{ $securedLeadDetails->contactPerson }}</td>
                            <td>{{ $securedLeadDetails->contactNumber }}</td>
                            <td>{{ Carbon\Carbon::parse($securedLeadDetails->updated_at)->format('d-M-Y') }}</td>
                            <td>{{ $securedLeadDetails->poNumber }}</td>
                            <td>{{ $securedLeadDetails->poAmount }}</td>
                            <td>{{ Carbon\Carbon::parse($securedLeadDetails->poDate)->format('d-M-Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($securedLeadDetails->poExpiryDate)->format('d-M-Y') }}</td>
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

