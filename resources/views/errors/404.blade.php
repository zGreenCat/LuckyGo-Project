<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f0f0f0;
      font-family: Arial, sans-serif;
    }
    .container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      border-radius: 15px; 
    }
    .text {
      font-family: 'font-normal',;
      margin-bottom: 20px;
      font-size: 24px;
      text-align: center;
      color: black;
    }
    .button {
      margin-bottom: 20px;
      padding: 10px 20px;
      font-size: 16px;
      color: #fff;
      background-color: #007BFF;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .button:hover {
      background-color: #0056b3;
    }
    .centered-gif {
      max-width: 100%;
      max-height: 100%;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="text">El 404 no está en nuestra lista de ganadores</div>
  <button class="button" onclick="window.location.href='{{ url('/') }}'">Volver al Inicio</button>
  <img src="https://i.giphy.com/media/v1.Y2lkPTc5MGI3NjExYnJwb2tzcjhldDR0cW1pYmgwZHFkMW5hOTc1cDAzOTJldzk4ejZlZyZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/3orif4z2002jOuua5O/giphy.gif" alt="Loading GIF" class="centered-gif">
</div>

</body>
</html>