<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('employees') }}">Home</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('employees') }}">All data</a></li>
        <li><a href="{{ URL::to('employees/filtered') }}">List data</a></li>
        <li><a href="{{ URL::to('logout') }}">Logout</a>
    </ul>
</nav>