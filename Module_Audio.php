<?php
namespace GDO\Audio;

use GDO\Core\Module;
use GDO\File\File;
use GDO\File\GDT_Path;
use MP3File;

final class Module_Audio extends Module
{
	public $module_priority = 30;
	
	public function getConfig()
	{
		return array(
			GDT_Path::make('lame_mp3_path')->initial('/usr/bin/lame')->label('lamemp3_path'),
		);
	}
	public function cfgLamePath() { return $this->getConfigValue('lame_mp3_path'); }

	####################
	### MP3File info ###
	####################
	public function mp3Info(File $file)
	{
		$this->includeClass('3p/MP3File');
		$mp3file = new MP3File($file->getPath());
		$duration = $mp3file->getDuration();
		$bitrate = $mp3file->getBitrate();
		return [$duration, $bitrate];
	}
}
