<nav class="backend navbar navbar-inverse navbar-static-top">
    <div class="container">
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a href="{{ route('manager.hotels.index') }}">Meine Hotels</a>
            </li>
            <li>
                <a href="{{ route('manager.users.index') }}">Meine Hotelangestellten</a>
            </li>
            <li>
                <a href="{{ route('manager.reservations.index') }}">Reservationen</a>
            </li>
            <li>
                <a href="{{ route('manager.newsletter.create') }}">Newsletter erstellen</a>
            </li>
            <li>
                <a href="{{ route('manager.statistic.index') }}">Statistik</a>
            </li>
        </ul>
    </div>
</nav>