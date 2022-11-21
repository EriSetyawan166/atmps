<?php

if(isset($_POST['Submit'])) {
    $name = $_POST['name'];
    $output = passthru("python twitter2.py $name");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
</head>
<body>
<form action="" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Hastag</td>
                <td><input type="text" name="name"></td>
            </tr>
                <td><input type="submit" name="Submit" value="Tarik"></td>
            </tr>
        </table>
    </form>
</body>
</html>