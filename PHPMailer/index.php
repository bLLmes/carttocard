<?php include 'functions.php'; ?>
<?php email_send() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    
    <form method="POST"> 
        <input type="text" name="fullname" placeholder="your name">
        <input type="email" name="email" placeholder="your email">
        <input type="submit" name="send" name="send">
    </form>

    </body>
</html>