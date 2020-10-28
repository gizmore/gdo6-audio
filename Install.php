<?php
namespace GDO\Audio;

use GDO\Util\Process;

final class Install
{
    public static function OnInstall(Module_Audio $module)
    {
        self::detectLameMP3($module);
    }
    
    private static function detectLameMP3(Module_Audio $module)
    {
        if ($path = Process::commandPath("lame", '.exe'))
        {
            $module->saveConfigVar('lame_mp3_path', $path);
        }
    }
    
}
