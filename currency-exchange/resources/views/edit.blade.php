<!-- resources/views/users/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User Name</title>
</head>
<body>
<h1>Edit User Name</h1>
<form method="POST" action="{{ route('users.update', ['id' => $user->id]) }}">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ $user->name }}">
    <button type="submit">Update Name</button>
</form>
</body>
</html>
