@php
    $messageCount = 0;
@endphp
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('employee.notification') }}" role="button">
                <i class="fas fa-light fa-bell"></i>
                <span class="badge badge-danger" id="notification-count">{{ $messageCount }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" role="button">
                <p>Logout</p>
            </a>
        </li>
    </ul>
</nav>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function fetchMessageCount() {
        axios.get('{{ route('employee.notification.count') }}')
            .then(response => {
                document.getElementById('notification-count').innerText = response.data.messageCount;
            })
            .catch(error => {
                console.error('Error fetching message count', error);
            });
    }
    fetchMessageCount();
    setInterval(fetchMessageCount, 60000);
</script>
