<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../assets/style/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <header>
        <div class="logo">
            <img src="../assets/Images/Registration-Logo.jpg" alt="">
            <p>Registration</p>
        </div>
        <nav>
            <div>
                <a href="#">Home</a>
                <a href="#">Contact</a>
                <a href="#">About</a>
            </div>
        </nav>
    </header>    
    <main>
        @yield('content')
    </main>
    <script src="../assets/js/Validation.js"></script>
    <script src="../assets/js/whatsApi.js"></script>
</body>
<footer>
    <p>&copy; All rights reserved by Team 46</p>
</footer></html>