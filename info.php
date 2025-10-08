<?php
    if (isset($_GET['full'])) {
        phpinfo();
        exit;
    }

    $info = [
        'PHP 版本' => PHP_VERSION,
        '作業系統' => PHP_OS_FAMILY . ' (' . PHP_OS . ')',
        '伺服器軟體' => $_SERVER['SERVER_SOFTWARE'] ?? php_sapi_name(),
        'SAPI' => php_sapi_name(),
        '執行使用者' => function_exists('get_current_user') ? get_current_user() : '未知',
        '時區' => date_default_timezone_get(),
        '記憶體限制' => ini_get('memory_limit'),
        '最大執行時間' => ini_get('max_execution_time') . ' 秒',
        '上傳檔案大小上限' => ini_get('upload_max_filesize'),
        'POST 大小上限' => ini_get('post_max_size'),
        '已載入擴充模組數量' => count(get_loaded_extensions()),
    ];

    $extensions = get_loaded_extensions();
?>
<!doctype html>
<html lang="zh-Hant">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>系統資訊</title>
<style>
body{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Arial,"Noto Sans TC",sans-serif;margin:24px;color:#1f2328;background:#fff}
h1{margin:0 0 12px;font-size:22px}
p{margin:6px 0 16px;color:#555}
a.button{display:inline-block;padding:8px 12px;border:1px solid #d0d7de;border-radius:6px;text-decoration:none;color:#0969da;background:#f6f8fa}
a.button:hover{background:#eef2f6}
table{border-collapse:collapse;width:100%;max-width:900px}
th,td{border:1px solid #d0d7de;padding:8px 10px;text-align:left;vertical-align:top}
th{background:#f6f8fa;width:220px}
.details{margin-top:24px;max-width:900px}
code{background:#f6f8fa;border:1px solid #d0d7de;padding:1px 4px;border-radius:4px}
small.muted{color:#6e7781}
</style>
</head>
<body>
<h1>系統資訊（摘要）</h1>
<p class="muted"><small class="muted">提示：若需要完整資訊（可能包含敏感環境細節），請使用右側按鈕。</small></p>
<p>
    <a class="button" href="?full=1">顯示完整 phpinfo()</a>
</p>

<table>
    <tbody>
    <?php foreach ($info as $k => $v): ?>
        <tr>
            <th><?php echo htmlspecialchars($k, ENT_QUOTES, 'UTF-8'); ?></th>
            <td><?php echo htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="details">
    <h1>已載入擴充模組</h1>
    <p><small class="muted">共 <?php echo count($extensions); ?> 個</small></p>
    <table>
        <tbody>
        <?php foreach ($extensions as $ext): ?>
            <tr>
                <td><?php echo htmlspecialchars($ext, ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>