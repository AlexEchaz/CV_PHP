<?php
// Static/LoginPage/logout.php

session_destroy();
header('Location: index.php');
exit;