<head>
      <meta charset="utf-8">
      <title>Calculator</title>
</head>

<body>
      <h2>Calculator</h2>
      <form method="get" attribute="post" action="calculator.php">
            <p>First Value:<br />
                  <input type="number" id="first" name="first">
            </p>
            <p>Second Value:<br />
                  <input type="number" id="second" name="second">
            </p>
            <input type="radio" name="group1" id="add" value="add" checked="true">
            +
            <input type="radio" name="group1" id="subtract" value="subtract">
            -
            <input type="radio" name="group1" id="times" value="times">
            x
            <input type="radio" name="group1" id="divide" value="divide">
            : <br> <br>
            <button type="submit" name="answer" id="answer" value="answer">Calculate</button>

      </form>
</body>

</html>

<?php
if (isset($_GET['answer'])) {

      switch ($_GET['group1']) {
            case "add":
                  echo "Result :" . ($_GET['first'] + $_GET['second']);
                  break;
            case "subtract":
                  echo "Result :" . ($_GET['first'] - $_GET['second']);
                  break;
            case "times":
                  echo "Result :" . ($_GET['first'] * $_GET['second']);
                  break;
            case "divide":
                  echo "Result :" . ($_GET['first'] / $_GET['second']);
                  break;
            default:
                  echo "";
                  break;
      }
}

?>