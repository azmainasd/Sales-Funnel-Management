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
            <h1>System User Management</h1>  
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
            <div class="card-header text-center">
              <h3 class="card-title">All users</h3>
              @if(Session::has('success'))
                <div  class="alert alert-success">{{ session('success') }}</div> 
              @endif  
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @can('User-Create', Auth::user())
                <a class="btn btn-outline-success custom-btn float-left" href="{{route('user.create')}}"><i class="fas fa-plus"></i> Add new</a>
              @endcan
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Status</th>
                    @can('User-Edit', Auth::user())
                    <th>Edit</th>
                    @endcan
                    @can('User-Delete', Auth::user())
                    <th>Delete</th>
                    @endcan
                  </tr>
                </thead>
                <tbody> 
                  @foreach ($users as $user)
                    <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        @foreach ($user->getRoleNames() as $role) 
                            <label class="badge badge-success">{{ $role}}</label>
                        @endforeach
                      <td>
                        @foreach ($user->getPermissionsViaRoles() as $permission) 
                          {{ $permission->name }} <br>
                        @endforeach
                      </td>
                      <td>{{ $user->active? 'Active' : 'Incative' }}</td>
                      @can('User-Edit', Auth::user())
                      <td class="">
                        <a class="mr-3" href="{{ route('user.edit',[$user->id]) }}"><i class="fas fa-edit"></i></a>
                      </td>
                      @endcan
                      @can('User-Delete', Auth::user())
                      <td>
                        <form id="delete-form-{{ $user->id }}" method="post" action="{{ route('user.destroy',$user->id) }}" style="display: none">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                        </form>
                        <a class="text-danger" href="" onclick="
                          if(confirm('Are you sure, You Want to delete this?'))
                          {
                            event.preventDefault();
                            document.getElementById('delete-form-{{ $user->id }}').submit();
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
<script src="{{ asset('admin-item/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin-item/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
    "responsive": false,"lengthChange": false, "searching": true, "search": {regex: true},"autoWidth": true,
      columnDefs: [
        { orderable: false, targets: [-1, -2] }
      ]
    }) 
  });
</script>
<script>
  $(document).ready(function(){
    $('.alert-success').fadeIn().delay(3000).fadeOut();
  });
</script>
@endsection