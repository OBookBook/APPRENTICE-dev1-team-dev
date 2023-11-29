<?php

/**
 * 24時間ごとの時間間隔を持つセレクトボックスのオプションを生成するクラスです。
 */
class TimeSelectorBox
{
    /**
     * セレクトボックスのオプションを生成します。
     *
     * @return string 24時間ごとの時間間隔を持つセレクトボックスのHTMLオプション
     */
    public function generateOptions(): string
    {
        $options = '';
        for ($hours = 0; $hours < 24; $hours++) {
            for ($minutes = 0; $minutes < 60; $minutes += 30) {
                $formattedHours = str_pad($hours, 2, '0', STR_PAD_LEFT);
                $formattedMinutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
                $time = ($hours === 24 && $minutes === 0) ? '00' : $formattedHours;
                $options .= "<option value='$time:$formattedMinutes'>$time:$formattedMinutes</option>";
            }
        }
        $options .= "<option value='24:00'>24:00</option>";
        return $options;
    }
}
