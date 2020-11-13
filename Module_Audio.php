<?php
namespace GDO\Audio;

use GDO\Core\GDO_Module;
use GDO\File\GDO_File;
use GDO\File\GDT_Path;
use MP3File;
use GDO\DB\GDT_Checkbox;
use GDO\UI\GDT_Bar;
use GDO\UI\GDT_Link;
use GDO\UI\GDT_Menu;
use GDO\User\GDO_User;
use GDO\File\GDT_Filesize;
use GDO\Core\Module_Core;

/**
 * Audio utilities and Song/Album/Musician structure.
 * Comes with soundmanager2 via yarn.
 * Comes with sm2-ui-bar via third party code.
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.08
 */
final class Module_Audio extends GDO_Module
{
	public $module_priority = 45;
	
	##################
	### Permission ###
	##################
	public function canEdit(GDO_User $user=null)
	{
	    $user = $user ? $user : GDO_User::current();
	    return $user->isMember() ? $this->cfgAllowUserEntries() : $this->cfgAllowGuestEntries();
	}
	
	##############
	### Module ###
	##############
	public function onInstall() { return Install::OnInstall($this); }
	public function onLoadLanguage() { return $this->loadLanguage('lang/audio'); }
	public function getDependencies() { return ['File']; }

	##############
	### Config ###
	##############
	public function getConfig()
	{
		return array(
			GDT_Path::make('lame_mp3_path')->initial('/usr/bin/lame')->label('lamemp3_path'),
		    GDT_Checkbox::make('allow_user_entries')->initial('1'),
		    GDT_Checkbox::make('allow_guest_entries')->initial('0'),
		    GDT_Filesize::make('max_audio_filesize')->initial('16777216'),
// 		    GDT_Checkbox::make('fallback_flash')->initial('0'),
		    GDT_Checkbox::make('hook_left_bar')->initial('1'),
		);
	}
	public function cfgLamePath() { return $this->getConfigValue('lame_mp3_path'); }
	public function cfgAllowUserEntries() { return $this->getConfigValue('allow_user_entries'); }
	public function cfgAllowGuestEntries() { return $this->getConfigValue('allow_guest_entries'); }
	public function cfgMaxAudioFilesize() { return $this->getConfigValue('max_audio_filesize'); }
	public function cfgHookLeftBar() { return $this->getConfigValue('hook_left_bar'); }

	###############
	### Classes ###
	###############
	public function getClasses()
	{
	    return array(
	        GDO_Band::class,
	        GDO_Musician::class,
	        GDO_Song::class,
	        GDO_Album::class,
	        GDO_SongAlbum::class,
	        GDO_SongMusician::class,
	    );
	}
	
	####################
	### MP3File info ###
	####################
	public function mp3Info(GDO_File $file)
	{
	    $path = $this->filePath('3p/MP3File.php');
	    require_once $path;
		$mp3file = new MP3File($file->getPath());
		$duration = $mp3file->getDuration();
		$bitrate = $mp3file->getBitrate();
		return [$duration, $bitrate];
	}
	
	public function onIncludeScripts()
	{
	    $min = Module_Core::instance()->cfgMinifyJS() === 'no' ? '' : '-jsmin';
	    $this->addBowerJavascript("soundmanager2/script/soundmanager2-nodebug{$min}.js");
	    $this->addJavascript('3p/sm2-bar-ui/bar-ui.js');
	    $this->addCSS('3p/sm2-bar-ui/bar-ui.css');
	    $this->addCSS('css/audio.css');
	}
	
	#############
	### Hooks ###
	#############
	/**
	 * Add all crud and list to the left menu.
	 * @param GDT_Bar $nav
	 */
	public function hookLeftBar(GDT_Bar $nav)
	{
	    if ($this->cfgHookLeftBar())
	    {
	        $menu = GDT_Menu::make('menu_audio');
	        $nav->addField($menu);

	        $can = $this->canEdit();
	        
	        if ($can)
	        {
    	        $linkAddAlbum = GDT_Link::make('link_add_album')->href(href('Audio', 'AlbumCRUD'));
    	        $menu->addField($linkAddAlbum);
	        }
	        
	        $linkAlbums = GDT_Link::make('link_album_list')->href(href('Audio', 'AlbumList'));
	        $menu->addField($linkAlbums);

	        if ($can)
	        {
    	        $linkAddSong = GDT_Link::make('link_add_song')->href(href('Audio', 'SongCRUD'));
    	        $menu->addField($linkAddSong);
	        }
	        
	        $linkAlbums = GDT_Link::make('link_song_list')->href(href('Audio', 'SongList'));
	        $menu->addField($linkAlbums);

	        if ($can)
	        {
    	        $linkAddBand = GDT_Link::make('link_add_band')->href(href('Audio', 'BandCRUD'));
    	        $menu->addField($linkAddBand);
	        }
	        
	        $linkBands = GDT_Link::make('link_band_list')->href(href('Audio', 'BandList'));
	        $menu->addField($linkBands);

	        if ($can)
	        {
    	        $linkAddMusician = GDT_Link::make('link_add_musician')->href(href('Audio', 'MusicianCRUD'));
    	        $menu->addField($linkAddMusician);
	        }
	        
	        $linkMusicians = GDT_Link::make('link_musician_list')->href(href('Audio', 'MusicianList'));
	        $menu->addField($linkMusicians);
	    }
	}

}
