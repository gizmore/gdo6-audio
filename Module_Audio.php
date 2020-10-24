<?php
namespace GDO\Audio;

use GDO\Core\GDO_Module;
use GDO\File\GDO_File;
use GDO\File\GDT_Path;
use MP3File;

/**
 * Audio utilities and Song/Album/Musician structure.
 * @author gizmore
 * @since 6.00
 * @version 6.10
 */
final class Module_Audio extends GDO_Module
{
	public $module_priority = 30;
	
	public function onInstall() { return Install::OnInstall($this); }
	public function onLoadLanguage() { return $this->loadLanguage('lang/audio'); }

	##############
	### Config ###
	##############
	public function getConfig()
	{
		return array(
			GDT_Path::make('lame_mp3_path')->initial('/usr/bin/lame')->label('lamemp3_path'),
		);
	}
	public function cfgLamePath() { return $this->getConfigValue('lame_mp3_path'); }

	###############
	### Classes ###
	###############
	public function getClasses()
	{
	    return array(
	        '\\GDO\\Audio\\GDO_Album',
	        '\\GDO\\Audio\\GDO_Band',
	        '\\GDO\\Audio\\GDO_Musician',
	        '\\GDO\\Audio\\GDO_Song',
	        '\\GDO\\Audio\\GDO_AlbumSong',
	        '\\GDO\\Audio\\GDO_SongMusician',
	    );
	}
	
	####################
	### MP3File info ###
	####################
	public function mp3Info(GDO_File $file)
	{
		$this->includeClass('3p/MP3File');
		$mp3file = new MP3File($file->getPath());
		$duration = $mp3file->getDuration();
		$bitrate = $mp3file->getBitrate();
		return [$duration, $bitrate];
	}

}
