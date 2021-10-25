<!DOCTYPE html>
<html>
<head>
    <title>Oliveira Trust</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="alert alert-success">
        <pre>{{ json_encode(collect($data)->toArray(), JSON_PRETTY_PRINT) }}</pre>
    </div>
   
    <h4>Thank you</h4>
</body>
</html>