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
            <h1>Industries</h1>  
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
                @can('Master-Data-Create',Auth::user())
                <a class="btn btn-outline-success custom-btn float-left" href="{{route('industry.create')}}"><i class="fas fa-plus"></i> Add New</a>
                @endcan
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>SL</th>
                        <th>Industries</th>
                        <th>Status</th>
                        @can('Master-Data-Edit',Auth::user())
                        <th>Edit</th>
                        @endcan
                        @can('Master-Data-Delete',Auth::user())
                        <th>Delete</th>
                        @endcan
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($industries as $industry)
                        
                      <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $industry->name }}</td>
                        <td>
                          @if (!empty($industry->active))
                            <label class="badge badge-success">Active</label>
                          @else
                            <label class="badge badge-danger">Inactive</label>
                          @endif
                        </td>
                        @can('Master-Data-Edit',Auth::user())
                        <td>
                          <a class="mr-3" href="{{ route('industry.edit',[$industry->id]) }}"><i class="fas fa-edit"></i></a>
                        </td>
                        @endcan
                        @can('Master-Data-Delete',Auth::user())
                        <td>
                          <form id="delete-form-{{ $industry->id }}" method="post" action="{{ route('industry.destroy',$industry->id) }}" style="display: none">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                          </form>
                          <a class="text-danger" href="" onclick="
                              if(confirm('Are you sure, You Want to delete this ? If you delete this industry all your related data on sales funnel will be destroyed!'))
                              {
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $industry->id }}').submit();
                              }
                              else{
                                event.preventDefault();
                              }" ><i id="delete" class="fas fa-trash"></i>
                          </a>
                        </td>
                        @endcan
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
      columnDefs: [
             { orderable: false, targets: [-1, -2] }
        ]
    })
  });
</script>
@endsection