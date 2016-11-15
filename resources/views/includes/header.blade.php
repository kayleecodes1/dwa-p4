<header id="siteHeader">
    <div class="container">
        <a href="{{ URL::route('home.index') }}">
            <div class="brand">
                <span class="color2">Task</span>Master
            </div>
        </a>
        <div class="user-section">
            @if (Auth::user())
                <span class="welcome">
                    <em>Welcome, {{ Auth::user()->name }}!</em>
                </span>
                <nav>
                    <form method="POST" action="{{ route('logout.submit') }}">
                        <button class="secondary">Logout</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </nav>
            @else
                <nav>
                    <a href="{{ URL::route('register.index') }}" class="main">
                        Create a Free Account
                    </a>
                    <a href="{{ URL::route('login.index') }}" class="secondary">
                        Log In
                    </a>
                </nav>
            @endif
        </div>
    </div>
</header>
