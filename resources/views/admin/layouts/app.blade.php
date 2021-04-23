<!DOCTYPE html>
<html lang="en">
    <head>
       @include('admin.layouts.css_links')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
          @include('admin.layouts.navbar')
          @include('admin.layouts.sidebar')
          @section('main-content')
           @show
          @include('admin.layouts.footer')
      </div>  
      @include('admin.layouts.js_links')  
    </body>
</html>