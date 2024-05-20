<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px; 
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
            display: flex; 
            flex-wrap: wrap; 
            justify-content: space-between; 
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%; /* Set width to 100% for full width */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%; /* Button width */
            padding: 10px;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

        .menu-bar {
            background-color: #333;
            overflow: hidden;
        }

        .menu-bar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .menu-bar a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Adjusted width for the columns */
        .column {
            width: calc(50% - 10px); /* Adjusted width for two columns */
            margin-bottom: 20px; /* Added margin for spacing between columns */
        }

        /* Added media query for responsiveness */
        @media screen and (max-width: 600px) {
            .column {
                width: 100%; /* Full width on smaller screens */
            }
        }
    </style>
</head>
<body>
    <!-- Menu bar -->
    <div class="menu-bar">
        <a href="{{ route('appointment') }}">Appointment</a>
        <a href="{{ route('progress') }}">Progress</a>
        <a href="{{ route('logout') }}">Logout</a>
        @if(auth()->check())
            <span style="float: right; color: #f2f2f2; padding: 14px 16px;">
                {{ auth()->user()->name }}({{ auth()->user()->role }})
            </span>
        @endif
    </div>

</body>
</html>
