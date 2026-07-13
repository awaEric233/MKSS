<!--
    Plain Craft Launcher 2 - Minecraft 芝士站主页 ( Minecraft Knowledge Sharing Site Homepage, MKSS )
    (C) 2026 awa_Eric233. Under the MIT License.
-->

<?php
// 获取配置文件
function get_files()
{
    $files = new ArrayObject();
    foreach (scandir("../configs/") as $item) {
        // 判断是否为配置文件
        if (str_starts_with($item, "cfg_"))
        {
            $item = "../configs/".$item;
            $data = json_decode(file_get_contents($item), true);
            $files->append(array($data["Name"], $item, $data["Logo"]));
        }
    }
    return $files;
}

// 根据 MD5 输出版本号
$str = file_get_contents("upd.txt");

// 获取 JSON 对应的内容
foreach (get_files() as $item)
{
    $str .= file_get_contents($item[1]); 
}

echo md5($str);
?>