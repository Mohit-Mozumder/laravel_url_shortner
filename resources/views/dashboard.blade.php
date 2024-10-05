<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">URL Shortener</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>Your Shortened URLs</h2>
    <form action="{{ route('urls.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="long_url" class="form-label">Enter Long URL</label>
            <input type="url" name="long_url" class="form-control" id="long_url" placeholder="Enter long URL here" required>
        </div>
        <button type="submit" class="btn btn-primary">Shorten URL</button>
    </form>

    @if($urls->isNotEmpty())
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Long URL</th>
                <th scope="col">Short URL</th>
                <th scope="col">Clicks</th>
            </tr>
            </thead>
            <tbody>
            @foreach($urls as $url)
                <tr>
                    <td>{{ $url->long_url }}</td>
                    <td><a href="{{ url($url->short_url) }}" target="_blank">{{ url($url->short_url) }}</a></td>
                    <td>{{ $url->click_count }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No URLs found. Start by shortening a new one!</p>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
