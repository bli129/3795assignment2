<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #E9EDC9 !important;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Laravel Expense Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('transactions.index') }}">Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/buckets"> Buckets </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                         Reports  
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li class="px-3 py-1">
                            <div class="d-flex">
                                <select id="yearSelect" name="year" class="form-select form-select-sm me-2">
                                    @for ($year = date('Y'); $year >= 1900; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                                <button onclick="navigateToYearReport()" class="btn btn-primary btn-sm">Go</button>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- User List only shows for admins -->
                @if(Session::get('user')['role'] === 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.userlist') }}">User List</a>
                </li>
                @endif
                <!-- Logout button -->
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="display: block; padding: 0.5rem 1rem; margin: 0; border: none; background: none;"> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


<script>
    function navigateToYearReport() {
        var selectedYear = document.getElementById('yearSelect').value;
        window.location.href = '/reports/' + selectedYear;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  

  
  
  