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
          <div class="col-12 ">
            <h1>Secured Project</h1>  
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>SL</th>
                        <th>Solution</th>
                        <th>Industry</th>
                        <th>Client</th>
                        <th>Owner</th>
                        <th>Secured&nbsp;&nbsp;Date</th>
                        <th>PO&nbsp;&nbsp;Number</th>
                        <th>PO&nbsp;&nbsp;Amount</th>
                        <th>PO&nbsp;&nbsp;Date</th>
                        <th>PO&nbsp;Expiry&nbsp;Date</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @foreach ($securedProjects as $project)
                    <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $project->solution->name }}</td>
                      <td>{{ $project->industry->name }}</td>
                      <td>{{ $project->client->name }}</td>
                      <td>{{ $project->owner->name }}</td>
                      <td>{{ Carbon\Carbon::parse($project->updated_at)->format('d-M-Y') }}</td>
                      <td>{{ $project->poNumber }}</td>
                      <td>{{ $project->poAmount }}</td>
                      <td>{{ Carbon\Carbon::parse($project->poDate)->format('d-M-Y') }}</td>
                      <td>{{ Carbon\Carbon::parse($project->poExpiryDate)->format('d-M-Y') }}</td>
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
    })
  });
</script>
@endsection