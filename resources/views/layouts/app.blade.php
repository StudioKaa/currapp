<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>CurrApp</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
    <script src="https://use.fontawesome.com/30b7c2b05b.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
      <div>
        <a class="navbar-brand" href="{{ url('educations') }}">Curr<span class="text-muted">App</span></a><div class="navbar-text">&nbsp;@yield('page-title')</div>
      </div>
      <div class="btn-group">
        @yield('buttons-right')
        @if(Auth::check())

          <div class="dropdown btn-group">
            <a class="btn btn-outline-secondary navbar-text dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-cog" aria-hidden="true"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/users"><i class="fa fa-fw fa-users"></i>&nbsp;Gebruikers</a>
              <a class="dropdown-item" href="#"><i class="fa fa-fw fa-user"></i>&nbsp;{{ Auth::user()->name }}</a>
              <a class="dropdown-item" href="/amoclient/logout"><i class="fa fa-fw fa-sign-out"></i>&nbsp;Uitloggen</a>
            </div>
          </div>
          
        @endif
      </div>
    </nav>

    <div class="main">
      <div class="container">
            @yield('content')
      </div>
    </div>

    <footer class="text-muted">
      <div class="container">
        <p><small>Designed, built and powered by <a target="_blank" href="http://studiokaa.co">studioKaa</a>, for Team ICO at Radius College.</small></p>
      </div>
    </footer>

    <script type="text/javascript" src="/js/script.js"></script>
  </body>
</html>
