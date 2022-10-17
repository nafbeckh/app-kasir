<?php

function tambah_nol_didepan($value, $threshold = null)
{
    return sprintf("%0" . $threshold . "s", $value);
}

function format_uang ($angka) {
    return number_format($angka, 0, ',', '.');
}