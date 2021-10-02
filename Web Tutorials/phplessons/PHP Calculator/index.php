<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calculator</title>
    </head>
    <body>
        
        <form method="POST">
            <input type="text" name="num1" placeholder="Number 1" required>
            <input type="text" name="num2" placeholder="Number 2" required>
            <select name="operator">
                <option>None</option>
                <option>Add</option>
                <option>Subtract</option>            
                <option>Multiply</option>
                <option>Divide</option>
            </select>
            <br>
            <button type="submit" name="submit" value="submit">Calculate</button>
        </form>
        <p>The answer is:</p>
        <?php
            if(isset($_POST['submit'])) {
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $result;
                $operator = $_POST['operator'];
                switch($operator) {
                    case 'Add':
                        $result = $num1 + $num2;
                        break;
                    case 'Subtract':
                        $result = $num1 - $num2;
                        break;
                    case 'Multiply':
                        $result = $num1 * $num2;
                        break;
                    case 'Divide':
                        $result  = $num1 / $num2;
                        break;
                    default:
                        $result = "You have not selected an operator!";
                }
                echo $result;
            }
        ?>

    </body>
</html>