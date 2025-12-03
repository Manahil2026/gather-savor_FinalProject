<?php

    require_once __DIR__ . "/../../../src/auth/checkSession.php";
    //Protected, allow authenticated users only.
    //This file sends requests to the database so that I can get things like favorites etc. and it returns json data.


    //Need the table in the request, and the id, if the id is null it will return everything
?>