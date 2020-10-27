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

/**
 * Audio utilities and Song/Album/Musician structure.
 * 
 * @author gizmore
 * @since 6.00
 * @version 6.10
 */
final class Module_Audio extends GDO_Module
{
	public $module_priority = 30;
	
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
	public function getDependencies() { return []; }

	##############
	### Config ###
	##############
	public function getConfig()
	{
		return array(
			GDT_Path::make('lame_mp3_path')->initial('/usr/bin/lame')->label('lamemp3_path'),
		    GDT_Checkbox::make('allow_user_entries')->initial('1'),
		    GDT_Checkbox::make('allow_guest_entries')->initial('0'),
		    GDT_Checkbox::make('hook_left_bar')->initial('1'),
		);
	}
	public function cfgLamePath() { return $this->getConfigValue('lame_mp3_path'); }
	public function cfgAllowUserEntries() { return $this->getConfigValue('allow_user_entries'); }
	public function cfgAllowGuestEntries() { return $this->getConfigValue('allow_guest_entries'); }
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
	        GDO_AlbumSong::class,
	        GDO_SongMusician::class,
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
	        $menu = GDT_Menu::make();
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
