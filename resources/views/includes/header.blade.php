<header id="siteHeader">
    <div class="container">
        <a href="{{ URL::route('home.index') }}">
            <div class="brand">
                <span class="color2">Task</span>Master
            </div>
        </a>
        <nav>
            <a href="{{ URL::route('register.index') }}" class="button main">
                Create a Free Account
            </a>
            <a href="{{ URL::route('login.index') }}" class="button secondary">
                Log In
            </a>
        </nav>
        <!--<nav>
            <a href="{{ URL::route('home.index') }}" class="{{ Route::is('home.*') ? 'active' : '' }}">
                Create a Free Account
            </a>
            <a href="{{ URL::route('home.index') }}" class="{{ Route::is('home.*') ? 'active' : '' }}">
                Log In
            </a>
        </nav>-->
    </div>
</header>
