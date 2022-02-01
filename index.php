<?php
session_start();
require_once 'header.php';
echo "<div class='center'>Welcome to Jagans's Nest,";
if ($loggedin) echo " $user, you are logged in";
else echo " please sign up or log in";

echo <<<_END
</div><br>
</div>
<div data-role="footer" class="footer">
<h4>Thank you for visiting. All rights reserved.</h4>
</div>
</body>
</html>
_END;
?>