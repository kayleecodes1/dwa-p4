<header id="siteHeader">
    <div class="container">
        <a href="{{ URL::route('home.index') }}">
            <div class="brand">
                <span class="color2">Task</span>Master
            </div>
        </a>
        @if (Auth::user())
            Welcome, {{ Auth::user()->name }}!
            <nav>
                <form method="POST" action="{{ route('logout.submit') }}">
                    <button>Logout</button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </nav>
        @else
            <nav>
                <a href="{{ URL::route('register.index') }}" class="button main">
                    Create a Free Account
                </a>
                <a href="{{ URL::route('login.index') }}" class="button secondary">
                    Log In
                </a>
            </nav>
        @endif
    </div>
</header>
