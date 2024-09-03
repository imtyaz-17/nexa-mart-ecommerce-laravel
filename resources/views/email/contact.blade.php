<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Message</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .email-body {
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container email-body">
    <div class="alert alert-info">
        <h1 class="alert-heading">A new message from User</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Message Details</h5>
            <p class="card-text"><strong>Name:</strong> {{$mailData['name']}}</p>
            <p class="card-text"><strong>Email:</strong> {{$mailData['email']}}</p>
            <p class="card-text"><strong>Subject:</strong> {{$mailData['subject']}}</p>
            <p class="card-text"><strong>Message:</strong></p>
            <div class="alert alert-light">
                {{$mailData['message']}}
            </div>
        </div>
    </div>
</div>
</body>
</html>
