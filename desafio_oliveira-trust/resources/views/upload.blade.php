<!-- resources/views/upload.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Upload CSV</title>
</head>

<body>
    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file_uploaded" accept=".csv, .txt, .xls, .xlsx" required>
        <button type="submit">Upload CSV</button>
    </form>

    @foreach($errors->all() as $error)
    <h2>{{ $error }}</h2>
    @endforeach
</body>

</html>