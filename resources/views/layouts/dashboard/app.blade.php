<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description"
    content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
  <title>Netflix</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('dashboad_files/css/main.css')}}">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css"
  href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{{asset('dashboad_files/plugins/noty/noty.css')}}" rel="stylesheet">
  <script src="{{asset('dashboad_files/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('dashboad_files/js/popper.min.js')}}"></script>

  <script src="{{asset('dashboad_files/plugins/noty/noty.js')}}" type="text/javascript"></script>
</head>

<body class="app sidebar-mini">
  <!-- Navbar-->
  @include('layouts.dashboard._header')
  @include('layouts.dashboard._aside')
  <main class="app-content">
    @include('partials._sessions')
    @yield('content')

  </main>
  <!-- Essential javascripts for application to work-->
    <script src="{{asset('dashboad_files/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('dashboad_files/plugins/select2/select2.js')}}"></script>
  <script src="{{asset('dashboad_files/js/main.js')}}"></script>
  <script>
    $(document).ready(function(){
    $(document).on('click','.delete',function(e){
      e.preventDefault();
  var that = $(this);
      var n = new Noty({
        text:"confirm deleting record",
        killer: true,
        buttons:[
Noty.button('Yes','btn btn-success mr-2',function(){
that.closest('form').submit();
}),
Noty.button('No','btn btn-danger',function(){
n.close();
}),
        ]
      });
      n.show();
    });

  });
$('.select2').select2({
width:'100%'

});
  </script>
</body>

</html>