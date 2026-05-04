<!--
    Plain Craft Launcher 2 - Minecraft 芝士站主页 ( Minecraft Knowledge Sharing Site Homepage, MKSS )
    (C) 2026 awa_Eric233. All rights reserved.
-->

<?php
// 根据 MD5 输出版本号
$str = file_get_contents('upd.txt');
echo md5($str);
?>