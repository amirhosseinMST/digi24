<?php
function truncateText($text, $limit = 50)
{
    if (empty($text)) return '';

    if (mb_strlen($text) <= $limit) {
        return $text;
    }


    $substring = mb_substr($text, 0, $limit);

    $lastSpace = mb_strrpos($substring, ' ');
    if ($lastSpace !== false && $lastSpace > 0) {
        $substring = mb_substr($substring, 0, $lastSpace);
    }

    return $substring . '...';
}

?>
