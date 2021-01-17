<?php
namespace GDO\Audio;

use GDO\File\GDT_File;
use GDO\Core\GDT_Template;
use GDO\File\GDO_File;

/**
 * MP3 audio file.
 * @author gizmore
 * @version 6.10
 * @since 6.05
 */
final class GDT_AudioFile extends GDT_File
{
	protected function __construct()
	{
		parent::__construct();
		$this->audioFile();
		$this->maxsize(Module_Audio::instance()->cfgMaxAudioFilesize());
	}
	
	public function audioFile()
	{
		$this->mime('audio/mp3');
		$this->mime('audio/mpeg');
		return $this;
	}
	
	public function gdoAfterCreate()
	{
	    parent::gdoAfterCreate();
	    $this->updateMP3Info();
	}
	
	public function gdoAfterUpdate()
	{
	    parent::gdoAfterUpdate();
	    $this->updateMP3Info();
	}
	
	private function updateMP3Info()
	{
	    if ($file = $this->getValue())
	    {
	        $info = Module_Audio::instance()->mp3Info($file);
	        $file->saveVars([
	            'file_duration' => $info[0],
	            'file_bitrate' => $info[1],
	        ]);
	    }
	}
	
	############
	### File ###
	############
	/**
	 * @return GDO_File
	 */
	public function getFile() { return $this->getValue(); }
	public function getFileID() { return $this->getVar(); }
	
	public function getHREFRange()
	{
	    return href('Audio', 'AudioRange', '&file='.$this->getFileID());
	}
	
	#####################
	### Player render ###
	#####################
	public $withDownload = false;
	public function withDownload($withDownload=true) { $this->withDownload = $withDownload; return $this; }
	
	public $withPlayer = false;
	public function withPlayer($withPlayer=true) { $this->withPlayer = $withPlayer; return $this; }
	
	public $withControls = false;
	public function withControls($withControls=true) { $this->withControls = $withControls; return $this; }
	
	public function renderCell()
	{
	    if ($this->withPlayer)
	    {
	        return GDT_Template::php('Audio', 'cell/audioplayer.php', ['field' => $this]);
	    }
	    else
	    {
	        return parent::renderCell();
	    }
	}
	
	public function renderCard()
	{
	    if ($this->withPlayer)
	    {
	        return GDT_Template::php('Audio', 'card/audioplayer.php', ['field' => $this]);
	    }
	    else
	    {
	        return parent::renderCard();
	    }
	}
}
