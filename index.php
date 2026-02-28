<!--
    Plain Craft Launcher 2 - Minecraft 芝士站主页 ( Minecraft Knowledge Share Site Homepage, MKSS )
    (C) 2026 awa_Eric233. All rights reserved.
-->

<?php
function get_json($path, $logo)
{
    $json = file_get_contents($path);
    $data = json_decode($json, true);
    foreach ($data as $item)
    {
        echo '<local:MyListItem Logo="pack://application:,,,/images/Blocks/'.$logo.'.png" Title="'.$item['Title'].'" Info="贡献者：'.$item['Author'].'" Type="Clickable" EventType="弹出窗口" EventData="'.$item['Title'].'|'.$item['Content'].'"/>';
    }
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

<local:MyCard Title="Powder Snow - 游戏冷知识" Margin="0,0,0,15" CanSwap="True" IsSwapped="False">
    <StackPanel Margin="25,40,23,15">
        <?php
            get_json('cfg_trivia.json','Grass');
        ?>
    </StackPanel>
</local:MyCard>
    
<local:MyCard Title="Firefly Bush - 特性收藏夹" Margin="0,0,0,15" CanSwap="True" IsSwapped="False">
    <StackPanel Margin="25,40,23,15">
        <?php
            get_json('cfg_issues.json','GrassPath');
        ?>
    </StackPanel>
</local:MyCard>

<local:MyCard Title="Candle - 旧版本时光机" Margin="0,0,0,15" CanSwap="True" IsSwapped="False">
    <StackPanel Margin="25,40,23,15">
        <?php
            get_json('cfg_wayback.json','Cobblestone');
        ?>
    </StackPanel>
</local:MyCard>

<local:MyCard Title="Lectern - Mojang 有话说" Margin="0,0,0,15" CanSwap="True" IsSwapped="False">
    <StackPanel Margin="25,40,23,15">
        <?php
            get_json('cfg_official.json','GoldBlock');
        ?>
    </StackPanel>
</local:MyCard>

<local:MyCard Title="Book and Quill - 芝士新闻" Margin="0,0,0,15" CanSwap="False" IsSwapped="False">
    <StackPanel Margin="25,40,23,15">
        <local:MyListItem Logo="pack://application:,,,/images/Blocks/CommandBlock.png" Title="芝士站需要你的帮助！" Info="来为本主页贡献你找到的冷知识吧！" Type="Clickable" EventType="打开网页" EventData="https://forms.office.com/r/sL2vTGsBcU"/>
        <local:MyListItem Logo="pack://application:,,,/images/Blocks/CommandBlock.png" Title="芝士站已登陆 PCL2 预设主页！" Info="点击这里可以查看主页审核的 Discussion，来接收一些维护信息。" Type="Clickable" EventType="打开网页" EventData="https://github.com/Meloong-Git/PCL/discussions/7750"/>
    </StackPanel>
</local:MyCard>

<local:MyCard Margin="0,0,0,15" CanSwap="False" IsSwapped="False">
    <Border Padding="20" BorderThickness="0,0,0,7" BorderBrush="{DynamicResource ColorBrush3}" CornerRadius="5" Margin="-0.6" >
        <Grid>
            <StackPanel HorizontalAlignment="Left" VerticalAlignment="Top">
                <TextBlock TextWrapping="Wrap" Foreground="{DynamicResource ColorBrush3}" FontSize="20">
                    <Run Text="PCL2"/>
                    <Bold>芝士站主页</Bold>
                </TextBlock>
                <TextBlock Text="By awa_Eric233" Foreground="{DynamicResource ColorBrush3}" Margin="0,5,0,0"/>
            </StackPanel>
            <StackPanel HorizontalAlignment="Right" VerticalAlignment="Top"> 
                <local:MyIconTextButton Height="35"
                    ColorType="Highlight" Text="刷新" ToolTip="重新加载主页，以便调试或更新。" EventType="刷新主页" LogoScale="1" Logo="M895.701333 391.424h-172.629333a39.850667 39.850667 0 1 1 0-79.701333h69.333333a344.490667 344.490667 0 0 0-281.813333-146.048 345.258667 345.258667 0 1 0 345.301333 345.258666 39.850667 39.850667 0 1 1 79.658667 0c0 234.666667-190.293333 424.96-424.96 424.96-234.666667 0-424.96-190.293333-424.96-424.96 0-234.666667 190.293333-424.96 424.96-424.96a423.765333 423.765333 0 0 1 345.301333 177.834667V192.213333a39.850667 39.850667 0 1 1 79.658667 0V351.573333a39.850667 39.850667 0 0 1-39.850667 39.850667z"/>
                <local:MyIconTextButton Height="35"
                    ColorType="Highlight" Text="致谢" ToolTip="排名不分先后，感谢所有为主页建设做出贡献的人！" EventType="打开帮助" EventData="https://www.xxag.top/mkss/sub_thanks.json" LogoScale="1.05" Logo="M917.333333 0v774.592H247.082667c-42.218667 0-76.693333 32.149333-79.018667 71.637333l-0.149333 4.266667v35.626667c0 40 33.066667 73.557333 74.666666 75.818666l4.501334 0.128H917.333333V1024H247.082667C171.818667 1024 109.610667 965.12 106.773333 891.413333L106.666667 886.122667V173.504C106.666667 79.701333 183.253333 3.2 277.717333 0.106667L283.690667 0H917.333333z m-64 65.365333H285.504c-61.568 0-111.936 47.786667-114.709333 106.602667L170.666667 177.024 170.666667 740.757333l1.386666-0.917333a139.328 139.328 0 0 1 71.829334-23.104l5.333333-0.085333L853.333333 716.586667V65.365333z M298.666667 43.584v718.976H234.666667V43.584h64zM917.333333 849.706667v65.365333H234.666667V849.706667h682.666666z"/>
            </StackPanel>
        </Grid>
    </Border>
</local:MyCard>