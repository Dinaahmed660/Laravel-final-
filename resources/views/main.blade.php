<!DOCTYPE html>
<html lang="en">
    
 @include('includes.header')

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-car"></i></i> <span>Rent Car Admin</span></a>
            </div>

            <div class="clearfix"></div>
           @include('includes.menuprofile')
            <br />
           @include('includes.sidebar')
           @include('includes.menubutton')
          </div>
        </div>
           @include('includes.topnavigation')
              @yield('content')
           @include('includes.footer')
  </body>
</html>