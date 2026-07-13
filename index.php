<!--
    Plain Craft Launcher 2 - Minecraft 芝士站主页 ( Minecraft Knowledge Sharing Site Homepage, MKSS )
    (C) 2026 awa_Eric233. All rights reserved.
-->

<?php
// 获取配置文件
function get_files()
{
    $files = new ArrayObject();
    foreach (scandir("./configs/") as $item) {
        // 判断是否为配置文件
        if (str_starts_with($item, "cfg_"))
        {
            $item = "./configs/".$item;
            $data = json_decode(file_get_contents($item), true);
            $files->append(array($data["Name"], $item, $data["Logo"]));
        }
    }
    return $files;
}

// 获取 JSON 对应的内容
function get_json($path, $logo)
{
    $result = "";
    $json = file_get_contents($path);
    $data = json_decode($json, true)["Data"];
    $tags = file_get_contents("./misc/tags.json");
    $tags_data = json_decode($tags, true);
    foreach ($data as $item)
    {
        // 构建卡片
        $cur_tag = "";
        if (array_key_exists($item["Author"], $tags_data)) $cur_tag = "&lt;".$tags_data[$item["Author"]]."&gt; ";
        $result = $result.'<local:MyListItem Logo="pack://application:,,,/images/Blocks/'.$logo.'.png" Title="'.$item["Title"].'" Info="贡献者：'.$cur_tag.$item["Author"].'" Type="Clickable" EventType="弹出窗口" EventData="'.$item["Title"]."|".$item["Content"].'|关闭"/>';
    }
    return $result;
}
?>

<local:MyCard Margin="0,0,0,15">
    <Border Padding="12" Background="{DynamicResource ColorBrush4}" CornerRadius="3" BorderThickness="3,0,0,0" BorderBrush="{DynamicResource ColorBrush3}">
        <StackPanel Orientation="Horizontal">
            <Path VerticalAlignment="Center" Stretch="Uniform" Height="15" Width="15" Margin="0,0,10,0" Fill="White" Data="M956.629333 370.048c-49.408-98.816-148.224-222.293333-255.146666-280.362667a35.584 35.584 0 0 0-34.133334 0L102.997333 395.946667A74.112 74.112 0 0 0 42.666667 468.864v395.221333c0 40.96 33.194667 74.112 74.112 74.112h790.442666c40.96 0 74.112-33.194667 74.112-74.112v-395.221333a307.285333 307.285333 0 0 0-24.704-98.816z m-271.701333-205.013333a435.754667 435.754667 0 0 1 193.152 229.717333H260.522667l424.405333-229.717333z m123.477333 303.786666a91.392 91.392 0 0 1-98.773333 98.858667c-61.269333 0-123.52-37.546667-123.52-98.816h222.293333z m98.816 395.264H116.778667v-391.253333l7.68-3.968H512c0 101.973333 95.36 172.885333 197.632 172.885333 148.181333 0 172.885333-172.885333 172.885333-172.885333 8.234667-0.512 16.469333-0.512 24.746667 0v395.221333z M339.072 542.976a123.52 123.52 0 1 0 0 247.04 123.52 123.52 0 0 0 0-247.04z m0 172.885333a49.408 49.408 0 1 1 0-98.816 49.408 49.408 0 0 1 0 98.816zM623.146667 295.936a37.034667 37.034667 0 1 0 74.112 0 37.034667 37.034667 0 0 0-74.112 0z"/>
            <TextBlock Foreground="White" TextWrapping="Wrap" Text="感谢您订阅 Minecraft 芝士站" FontWeight="Bold"/>
        </StackPanel>
    </Border>
</local:MyCard>

<?php
$ua = $_SERVER["HTTP_USER_AGENT"];
// UA 不是 PCL2 的直接踹飞
if (!str_starts_with($ua,"PCL2/"))
{
    http_response_code(403);
    echo "<b>Minecraft 芝士站主页（MKSS）</b> - 请使用 PCL2 访问主页！";
    return;    
}

// 调试
$is_debug_idx = false;
$is_rick = date("m-d") === "04-01";
if (isset($_GET["debug"])) {
    switch ($_GET["debug"]) {
        case "0":
            $is_debug_idx = true;
            break;
        case "1":
            echo '<local:MyCard Margin="0,0,0,15" Title="调试模式 - UA 调试">
    <TextBlock Margin="25,40,23,15" Text="".$ua.""/>
</local:MyCard>';
            break;
        case "41":
            $is_rick = true;
            break;
        default:
            echo '<local:MyCard Margin="0,0,0,15" Title="调试模式">
    <StackPanel Margin="25,40,23,15">
        <local:MyListItem Title="0：索引调试" Info="显示所有卡片对应的配置文件。"/>
        <local:MyListItem Title="1：UA 调试" Info="显示当前的 User-Agent。"/>
        <local:MyListItem Title="41：愚人节调试" Info="显示 RickRoll 提示条。"/>
    </StackPanel>
</local:MyCard>';
    }
}

// RickRoll 提示条
if ($is_rick) {
    echo '<local:MyHint Text="{variable:MkssRick:近期主页服务可能会受到影响，点击此提示条查看更多信息。}" Margin="0,0,0,15">
    <local:CustomEventService.Events>
        <local:CustomEventCollection>
            <local:CustomEvent Type="打开网页" Data="https://cdn.mtdv.me/video/rick.mp4"/>
            <local:CustomEvent Type="修改变量" Data="MkssRick|看来你已经被 RickRoll 过了。重音 Teto 生日快乐！|-"/>
            <local:CustomEvent Type="刷新页面" Data="-"/>
        </local:CustomEventCollection>
    </local:CustomEventService.Events>
</local:MyHint>';
}

// 输出卡片
foreach (get_files() as $item)
{
    $idx = "";
    if ($is_debug_idx) {
        $idx = " - ".$item[1];
    }
    echo '<local:MyCard Title="'.$item[0].$idx.'" Margin="0,0,0,15" CanSwap="True">
    <StackPanel Margin="25,40,23,15">
        '
        .get_json($item[1],$item[2]).
        '
    </StackPanel>
</local:MyCard>';
}
?>

<local:MyCard Title="Book and Quill - 芝士新闻" Margin="0,0,0,15" CanSwap="False">
    <StackPanel Margin="25,40,23,15">
        <?php
        // 获取公告
        $json = file_get_contents("./misc/notice.json");
        $data = json_decode($json, true);
        foreach ($data as $item)
        {
            $type = "弹出窗口";
            $event = "公告 - ".$item["Title"]."|".$item["Content"];
            if ($item["IsLink"]) {
                $type = "打开网页";
                $event = $item["Content"];
            }
            // 输出公告
            echo '<local:MyListItem Logo="pack://application:,,,/images/Blocks/CommandBlock.png" Title="'.$item["Title"].'" Info="'.$item["Info"].'" Type="Clickable" EventType="'.$type.'" EventData="'.$event.'|关闭"/>';
        }
        ?>
    </StackPanel>
</local:MyCard>

<local:MyCard Margin="0,0,0,15">
    <Border Padding="20,20,20,10" BorderThickness="0,0,0,7" BorderBrush="{DynamicResource ColorBrush3}" CornerRadius="5" Margin="-0.6" >
        <StackPanel>
            <TextBlock TextWrapping="Wrap" Foreground="{DynamicResource ColorBrush3}" FontSize="20">
                <Bold>PCL2</Bold>
                <Run>Minecraft 芝士站主页</Run>
            </TextBlock>
            <TextBlock Text="By awa_Eric233." Foreground="{DynamicResource ColorBrush3}" Margin="0,5,0,0"/>
            <StackPanel Orientation="Horizontal" Margin="0,10,0,0">
                <local:MyIconTextButton Height="35"
                    ColorType="Highlight" Text="投稿" ToolTip="芝士站需要你的帮助！&#xA;来为本主页贡献你找到的冷知识吧！" EventType="打开网页" EventData="https://forms.cloud.microsoft/r/5EmGAgSYHe" LogoScale="1" Logo="M1014.543678 9.459202a32.239736 32.239736 0 0 0-34.383718-7.30394L20.66383 371.592232a32.295735 32.295735 0 0 0-20.367832 25.783788 32.303735 32.303735 0 0 0 12.799895 30.255752L348.557141 675.493739l247.813967 335.437248a32.327735 32.327735 0 0 0 30.247752 12.783895 32.255735 32.255735 0 0 0 25.791788-20.367833L1021.847618 43.84292a32.279735 32.279735 0 0 0-7.30394-34.383718zM98.639191 410.663911l762.833742-293.70959-493.019955 493.051955L98.639191 410.663911z m514.699778 514.699778L414.036604 655.589902l493.003955-493.035955-293.70159 762.809742z"/>
                <local:MyIconTextButton Height="35" Text="刷新" ToolTip="重新加载主页，以便更新或调试。" EventType="刷新主页" LogoScale="1" Logo="M895.701333 391.424h-172.629333a39.850667 39.850667 0 1 1 0-79.701333h69.333333a344.490667 344.490667 0 0 0-281.813333-146.048 345.258667 345.258667 0 1 0 345.301333 345.258666 39.850667 39.850667 0 1 1 79.658667 0c0 234.666667-190.293333 424.96-424.96 424.96-234.666667 0-424.96-190.293333-424.96-424.96 0-234.666667 190.293333-424.96 424.96-424.96a423.765333 423.765333 0 0 1 345.301333 177.834667V192.213333a39.850667 39.850667 0 1 1 79.658667 0V351.573333a39.850667 39.850667 0 0 1-39.850667 39.850667z"/>
                <local:MyIconTextButton Height="35" Text="链接" ToolTip="主页的各类链接。" EventType="打开帮助" EventData="https://www.xxag.top/mkss/sub_links.json" LogoScale="1.05" Logo="M607.934444 417.856853c-6.179746-6.1777-12.766768-11.746532-19.554358-16.910135l-0.01228 0.011256c-6.986111-6.719028-16.47216-10.857279-26.930349-10.857279-21.464871 0-38.864146 17.400299-38.864146 38.864146 0 9.497305 3.411703 18.196431 9.071609 24.947182l-0.001023 0c0.001023 0.001023 0.00307 0.00307 0.005117 0.004093 2.718925 3.242857 5.953595 6.03853 9.585309 8.251941 3.664459 3.021823 7.261381 5.997598 10.624988 9.361205l3.203972 3.204995c40.279379 40.229237 28.254507 109.539812-12.024871 149.820214L371.157763 796.383956c-40.278355 40.229237-105.761766 40.229237-146.042167 0l-3.229554-3.231601c-40.281425-40.278355-40.281425-105.809861 0-145.991002l75.93546-75.909877c9.742898-7.733125 15.997346-19.668968 15.997346-33.072233 0-23.312962-18.898419-42.211381-42.211381-42.211381-8.797363 0-16.963347 2.693342-23.725354 7.297197-0.021489-0.045025-0.044002-0.088004-0.066515-0.134053l-0.809435 0.757247c-2.989077 2.148943-5.691629 4.669346-8.025791 7.510044l-78.913281 73.841775c-74.178443 74.229608-74.178443 195.632609 0 269.758863l3.203972 3.202948c74.178443 74.127278 195.529255 74.127278 269.707698 0l171.829484-171.880649c74.076112-74.17435 80.357166-191.184297 6.282077-265.311575L607.934444 417.856853z M855.61957 165.804257l-3.203972-3.203972c-74.17742-74.178443-195.528232-74.178443-269.706675 0L410.87944 334.479911c-74.178443 74.178443-78.263481 181.296089-4.085038 255.522628l3.152806 3.104711c3.368724 3.367701 6.865361 6.54302 10.434653 9.588379 2.583848 2.885723 5.618974 5.355985 8.992815 7.309476 0.025583 0.020466 0.052189 0.041956 0.077771 0.062422l0.011256-0.010233c5.377474 3.092431 11.608386 4.870938 18.257829 4.870938 20.263509 0 36.68962-16.428158 36.68962-36.68962 0-5.719258-1.309832-11.132548-3.645017-15.95846l0 0c-4.850471-10.891048-13.930267-17.521049-20.210297-23.802102l-3.15383-3.102664c-40.278355-40.278355-24.982998-98.79612 15.295358-139.074476l171.930791-171.830507c40.179095-40.280402 105.685018-40.280402 145.965419 0l3.206018 3.152806c40.279379 40.281425 40.279379 105.838513 0 146.06775l-75.686796 75.737962c-10.296507 7.628748-16.97358 19.865443-16.97358 33.662681 0 23.12365 18.745946 41.87062 41.87062 41.87062 8.048303 0 15.563464-2.275833 21.944801-6.211469 0.048095 0.081864 0.093121 0.157589 0.141216 0.240477l1.173732-1.083681c3.616364-2.421142 6.828522-5.393847 9.529027-8.792247l79.766718-73.603345C929.798013 361.334535 929.798013 239.981676 855.61957 165.804257z"/>
                <local:MyIconTextButton Height="35" Text="致谢" ToolTip="排名不分先后，感谢所有为主页建设做出贡献的人！" EventType="打开帮助" EventData="https://www.xxag.top/mkss/sub_thanks.json" LogoScale="1.05" Logo="M917.333333 0v774.592H247.082667c-42.218667 0-76.693333 32.149333-79.018667 71.637333l-0.149333 4.266667v35.626667c0 40 33.066667 73.557333 74.666666 75.818666l4.501334 0.128H917.333333V1024H247.082667C171.818667 1024 109.610667 965.12 106.773333 891.413333L106.666667 886.122667V173.504C106.666667 79.701333 183.253333 3.2 277.717333 0.106667L283.690667 0H917.333333z m-64 65.365333H285.504c-61.568 0-111.936 47.786667-114.709333 106.602667L170.666667 177.024 170.666667 740.757333l1.386666-0.917333a139.328 139.328 0 0 1 71.829334-23.104l5.333333-0.085333L853.333333 716.586667V65.365333z M298.666667 43.584v718.976H234.666667V43.584h64zM917.333333 849.706667v65.365333H234.666667V849.706667h682.666666z"/>
            </StackPanel>
        </StackPanel>
    </Border>
</local:MyCard>