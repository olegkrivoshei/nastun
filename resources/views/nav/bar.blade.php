{{--<nav class="navbar navbar-expand-md navbar-dark bg-dark">--}}
{{--<a class="navbar-brand" href="/">Laravel</a>--}}
{{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--<span class="navbar-toggler-icon"></span>--}}
{{--</button>--}}

{{--<div class="collapse navbar-collapse" id="navbarsExampleDefault">--}}
{{----}}

{{--</div>--}}

<nav class="navbar navbar-expand-md navbar-dark bg-dark" style="background-color: rgba(216,191,216,0.7)!important;">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'nastun') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size: 11pt;">
            <b>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item" id="hover">
                        <a class="nav-link" href="/post" style="color: white">Posts</a>
                    </li>
                    <li class="nav-item" id="hover">
                        <a class="nav-link" href="/about" style="color: white">about</a>
                    </li>
                    <li class="nav-item" id="hover">
                        <a class="nav-link" href="/sating" style="color: white">Services</a>
                    </li>
                </ul>
            </b>
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

        {{--<ul class="nav navbar-nav navbar-right">--}}
        {{--<li class="nav-item">--}}
        {{--<a class="nav-link" href="/post/create">Add post <span class="sr-only">(current)</span></a>--}}
        {{--</li>--}}
        {{----}}
        {{--</ul>--}}
        <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <b>
                    <a class="nav-link" style="color: white" id="hover" href="{{ route('login') }}">{{ __('Login') }} </a>
                    </b>
                </li>
                <li class="nav-item">
                    @if (Route::has('register'))
                        <b>
                        <a class="nav-link" style="color: white" id="hover" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </b>
                    @endif
                </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="hover">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/dashboard">Dashboard</a>
                            <b>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </b>
                        </div>
                    </li>
                    @endguest
            </ul>
        </div>
    </div>
</nav>