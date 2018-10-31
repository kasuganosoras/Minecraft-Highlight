# Minecraft-Highlight
PHP 将 Minecraft 特殊彩色字符转换为 HTML 彩色文字

这是一个用 PHP 编写的工具类，用于将 Minecraft 中的彩色代码转换为 HTML 彩色文字。

例如 `§1test` 会被转换为：`<span style='color: rgb(0, 0, 192);'>test</span>`

### 使用方法
````php
include("Minecraft-Highlight.php");
$text = "§aMinecraft §6is §ba §csandbox §dgame";
$Highlight = new Highlight();
echo $Highlight->convert($text);
````
