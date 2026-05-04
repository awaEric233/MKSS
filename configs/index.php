<!--
    Plain Craft Launcher 2 - Minecraft 芝士站主页 ( Minecraft Knowledge Sharing Site Homepage, MKSS )
    (C) 2026 awa_Eric233. All rights reserved.
-->

<?php
// 获取配置文件
$files = new ArrayObject();
foreach (scandir('./') as $item) {
    // 判断是否为配置文件
    if (str_starts_with($item, 'cfg_'))
    {
        $data = json_decode(file_get_contents($item), true);
        $files->append(array(
            'Name' => $data['Name'],
            'Path' => $item,
            'Logo' => $data['Logo']
        ));
    }
}
header('Content-Type: application/json');
echo json_encode($files);
?>