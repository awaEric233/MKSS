<?php
$str = file_get_contents('../cfg_issues.json').file_get_contents('../cfg_trivia.json').file_get_contents('../cfg_wayback.json').file_get_contents('./upd.txt');
echo md5($str);
?>