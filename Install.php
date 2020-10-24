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
        if (Process::commandExists("lame"))
        {
            $module->saveConfigVar('lame_mp3_path', "lame");
        }
    }
    
}
