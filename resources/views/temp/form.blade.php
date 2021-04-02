<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{ route('create_client') }}" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="name" required>
        <br>
        Active? <br>
        <label for="active_yes"> Yes
            <input type="radio" name="active" id="active_yes" value="yes" required>
        </label>
        <br>
        <label for="active_no"> No
            <input type="radio" name="active" id="active_no" value="no" required>
        </label>
        <br>
        <input type="file" name="photo">
        <br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>