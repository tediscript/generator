<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>MVC Generator</title>
    </head>
    <body>
        <h1>MVC Generator V3 Beta</h1>
        <form method="POST" action="<?php echo site_url();?>/welcome/generate/">
            <input type="submit" value="Generate" />
        </form>
        <br/>
        <br/>
        <form action="<?php echo site_url();?>/welcome/remove_handler/" method="GET">
            Remove ? 
            <input type="submit" value="OK" />
        </form>
    </body>
</html>
