<nav class="backend navbar navbar-inverse navbar-static-top">
    <div class="container">
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a href="{{ route('manager.hotels.index') }}">Meine Hotels</a>
            </li>
            <li>
                <a href="{{ route('manager.users.index') }}">Meine Benutzer</a>
            </li>
            <li>
                <a href="{{ route('manager.reservations.index') }}">Reservationen</a>
            </li>
        </ul>
    </div>
</nav>