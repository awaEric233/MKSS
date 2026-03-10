<?php
$files = new ArrayObject();
foreach (scandir('./') as $item) {
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