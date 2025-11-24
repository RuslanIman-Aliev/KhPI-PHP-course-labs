<?php

setcookie('past_purchases', '', time() - 3600, '/');
header('Location: past.php');
exit;