<nav class="navbar navbar-expand-lg p-0">
    <div class="container">

        <button class="btn btn-link d-block d-md-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span>
        </button>

        <div class="" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{route('generals')}}">General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('groups')}}">Groups</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('preference')}}">Preferences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('sync/products')}}">Sync Products
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('sync/orders')}}">Sync Orders
                    </a>
                </li>
            </ul>
        </div>
        <a class="navbar-brand p-2 text-center" href="#">
            <img src="assets/polished-logo-small.png" alt="logo" style="width: 50px"> Polished
        </a>
    </div>
</nav>
