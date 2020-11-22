<?php
namespace GDO\Audio;

use GDO\Core\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\DB\GDT_Checkbox;
use GDO\DB\GDT_CreatedAt;
use GDO\DB\GDT_CreatedBy;
use GDO\DB\GDT_EditedAt;
use GDO\DB\GDT_EditedBy;
use GDO\UI\GDT_Title;
use GDO\Date\GDT_Date;
use GDO\Language\GDT_Language;
use GDO\DB\GDT_DeletedAt;
use GDO\DB\GDT_DeletedBy;
use GDO\Core\GDT_Template;
use GDO\File\GDO_File;
use GDO\Date\GDT_Duration;
use GDO\User\GDO_User;
use GDO\UI\GDT_Message;

/**
 * A music song entity.
 * @author gizmore
 */
final class GDO_Song extends GDO
{
    ###########
    ### GDO ###
    ###########
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('song_id'),
            GDT_Title::make('song_title')->notNull(),
            GDT_Song::make('song_original')->label('song_original'), # for remixes
            GDT_Band::make('song_band'),
            GDT_Genre::make('song_genre'),
            GDT_Language::make('song_language'),
            GDT_AudioFile::make('song_file')->previewHREF(href('Audio', 'AudioFile', '&file='))->label('audiofile'),
            GDT_Lyrics::make('song_lyrics'),
            GDT_Message::make('song_description')->label('description'),
            GDT_Duration::make('song_duration'),
            GDT_BPM::make('song_bpm'),
            GDT_Date::make('song_released')->label('released'),
            GDT_Checkbox::make('song_featured')->label('featured')->initial('0')->hidden(),
            GDT_EditedAt::make('song_edited'),
            GDT_EditedBy::make('song_editor'),
            GDT_CreatedAt::make('song_created'),
            GDT_CreatedBy::make('song_creator'),
            GDT_DeletedAt::make('song_deleted'),
            GDT_DeletedBy::make('song_deletor'),
        );
    }
    
    ############
    ### Perm ###
    ############
    public function canEdit(GDO_User $user=null) { return Module_Audio::instance()->canEdit($user); }
    public function hrefEdit() { return href('Audio', 'SongCRUD', "&song_id={$this->getID()}"); }
    public function hrefShow() { return href('Audio', 'SongShow', "&id={$this->getID()}"); }
    public function hrefPlay() { return href('Audio', 'AudioRange', "&file={$this->getFileID()}"); }
    
    ##############
    ### Getter ###
    ##############
    public function getID() { return $this->getVar('song_id'); }
    public function getTitle() { return $this->getVar('song_title'); }
    public function getTrack() { return $this->getVar('sa_track'); }
    public function isFeatured() { return $this->getValue('song_featured'); }
    
    /**
     * @return GDO_Song
     */
    public function getOriginalSong() { return $this->getValue('song_original'); }
    public function getOriginalSongID() { return $this->getVar('song_original'); }
    /**
     * @return GDO_Band
     */
    public function getBand() { return $this->getValue('song_band'); }
    public function getBandID() { return $this->getVar('song_band'); }
    
    /**
     * @return GDO_Musician[]
     */
    public function getMusicians()
    {
        return GDO_SongMusician::getMusicians($this);
    }
    
    /**
     * @return GDO_File
     */
    public function getFile() { return $this->getValue('song_file'); }
    public function getFileID() { return $this->getVar('song_file'); }
    
    ##############
    ### Render ###
    ##############
    public function displayName() { return $this->display('song_title'); }
    public function displayTitle() { return $this->display('song_title'); }
    public function displayLyrics() { return $this->getVar('song_lyrics'); }
    public function displayGenre() { return $this->gdoColumn('song_genre'); }
    public function displayDuration() { return $this->gdoColumn('song_duration')->renderCell(); }
    public function displayMusicianInstrument() { return $this->display('sm_instrument'); }
    public function renderCard() { return GDT_Template::php('Audio', 'card/song.php', ['gdo' => $this]); }
    public function renderList() { return GDT_Template::php('Audio', 'list/song.php', ['gdo' => $this]); }
    public function renderChoice() { return $this->display('song_title'); }
    
}
