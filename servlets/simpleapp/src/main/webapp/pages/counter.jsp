<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counter</title>

    <style>
        body {
            width: 100vw;
            height: 95vh;
        }

        body, div {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        body > div {
            padding: 5rem;
            border: 1px solid grey;
            border-radius: 2rem;
            box-shadow: 1px 1px 2px black;
        }
    </style>
</head>
<body>
    
    <div>

        <h2>Counter</h2>
        <h3 id="counter">0</h3>

        <div style="flex-direction: row;">
            <button onclick="handleClick(-1)">-</button>
            <button onclick="handleClick(1)">+</button>
        </div>

    </div>

    <script>
        
        function handleClick(val) {
            document.getElementById("counter").innerHTML = Number(document.getElementById("counter").innerHTML) + val;
        } 
    </script>
</body>
</html>