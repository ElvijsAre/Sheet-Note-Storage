<!-- Default Bootstrap Navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">SheetMusicStorage</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/') ? "active" : "" }}"><a href="/">Home</a></li>
                <li class="{{ Request::is('forum') ? "active" : "" }}"><a href="/forum">Forum</a></li>
                <li class="{{ Request::is('music/authors') ? "active" : "" }}"><a href="/music/authors">Authors</a></li>
                <li class="{{ Request::is('music/sheets') ? "active" : "" }}"><a href="/music/sheets">Musicals</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello {{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('messages.index') }}">Messages</a></li>
                        <li><a href="{{ route('posts.index') }}">Posts</a></li>
                        <li><a href="{{ route('comments.index') }}">Comments</a></li>
                        <li><a href="{{ route('music.orchestrations.index') }}">Notes</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('profile',Auth::user()->id) }}">Profile</a></li>
                        @if(Auth::user()->is_admin)
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('admin.index') }}">Admin</a></li>
                        <li><a href="{{ route('categories.index') }}">Categories</a></li>
                        <li><a href="{{ route('music.categories.index') }}">Genre</a></li>
                        @endif
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout') }}">Log out</a></li>
                    </ul>
                </li>
                @else
                <li class="{{ Request::is('login') ? "active" : "" }}"><a href="{{ route('login') }}">Login</a></li>
                <li class="{{ Request::is('register') ? "active" : "" }}"><a href="{{ route('register') }}">Register</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav><!-- Default Bootstrap Navbar END-->