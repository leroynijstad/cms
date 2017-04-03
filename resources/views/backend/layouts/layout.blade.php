<!DOCTYPE html>
<html>
<head>
  <title>Control panel</title>

  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/backend/algemeen.css">
  <style type="text/css" media="screen">
  </style>
</head>
<body >
<div class="container col-md-12" >

    <div class="row">
        
        @include('backend.layouts.menu')

        <div class="col-md-12 content">
            @yield('content')
        </div>
    </div>
</div>
  <script src="/js/bootstrap.min.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>