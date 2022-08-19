<?php

const PAGE_SIZE_LIMIT = [10, 20, 50, 100];
const PAGE_SIZE_DEFAULT = 10;

function uploadImage($filePath, $idObject, $image)
{
    $imageName = md5(microtime()) . '.' . $image->extension();
    $path = $filePath . "/" . $idObject;
    $image->move(public_path($path), $imageName);
    return url($path . '/' . $imageName);
}
