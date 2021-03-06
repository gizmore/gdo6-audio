<?php
namespace GDO\Audio;

use GDO\Core\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\DB\GDT_Checkbox;
use GDO\DB\GDT_CreatedAt;
use GDO\DB\GDT_CreatedBy;
use GDO\DB\GDT_EditedAt;
use GDO\DB\GDT_EditedBy;
use GDO\Date\GDT_Date;
use GDO\UI\GDT_Message;
use GDO\UI\GDT_Title;
use GDO\Country\GDT_Country;
use GDO\DB\GDT_DeletedAt;
use GDO\DB\GDT_DeletedBy;
use GDO\Core\GDT_Template;
use GDO\User\GDO_User;
use GDO\DB\GDT_UInt;
use GDO\DB\GDT_Virtual;

/**
 * A music band entity.
 * 
 * @author gizmore
 * @version 6.10.1
 * @since 6.10.0
 *
 * @see GDO_Song
 * @see GDO_Album
 */
final class GDO_Band extends GDO
{
    ###########
    ### GDO ###
    ###########
    public function gdoColumns()
    {
        return [
            GDT_AutoInc::make('band_id'),
            GDT_Title::make('band_name')->label('name')->notNull()->unique(),
            GDT_Message::make('band_description')->label('description'),
            GDT_Genre::make('band_genre'),
            GDT_Date::make('band_founded')->label('founded'),
            GDT_Country::make('band_country')->withCompletion(),
            GDT_Checkbox::make('band_featured')->label('featured')->initial('0')->hidden(),
            GDT_Virtual::make('band_albums')->gdtType(GDT_UInt::make())->subquery("SELECT COUNT(*) FROM gdo_album a JOIN gdo_band ab ON ab.band_id=a.album_band WHERE a.album_band=ab.band_id"),
            GDT_Virtual::make('band_songs')->gdtType(GDT_UInt::make())->subquery("SELECT COUNT(*) FROM gdo_song s JOIN gdo_band sb ON sb.band_id=s.song_band WHERE s.song_band=sb.band_id"),
            GDT_EditedAt::make('band_edited'),
            GDT_EditedBy::make('band_editor'),
            GDT_CreatedAt::make('band_created'),
            GDT_CreatedBy::make('band_creator'),
            GDT_DeletedAt::make('band_deleted'),
            GDT_DeletedBy::make('band_deletor'),
        ]; 
    }
    
    ##############
    ### Getter ###
    ##############
    public function getID() { return $this->getVar('band_id'); }
    public function getGenre() { return $this->getVar('band_genre'); }
    public function isFeatured() { return $this->getValue('band_featured'); }
    
    ##############
    ### Render ###
    ##############
    public function displayName() { return $this->display('band_name'); }
    public function displayDescription() { return $this->gdoColumn('band_description')->renderCell(); }
    public function displayGenre() { return $this->gdoColumn('band_genre')->renderCell(); }
    public function displayFounded() { return $this->gdoColumn('band_founded')->renderCell(); }
    public function displayCountry() { return $this->gdoColumn('band_country')->withName(false)->renderCell(); }
    public function renderCell() { return GDT_Template::php('Audio', 'cell/band.php', ['gdo' => $this]); }
    public function renderList() { return GDT_Template::php('Audio', 'list/band.php', ['gdo' => $this]); }
    public function renderCard() { return GDT_Template::php('Audio', 'card/band.php', ['gdo' => $this]); }
    public function renderChoice() { return $this->displayName(); }

    ##################
    ### Permission ###
    ##################
    public function canEdit(GDO_User $user=null) { return Module_Audio::instance()->canEdit($user); }
    public function hrefEdit() { return href('Audio', 'BandCRUD', "&band_id={$this->getID()}"); }
    public function hrefShow() { return href('Audio', 'BandShow', "&band_id={$this->getID()}"); }
    public function hrefSongs() { return href('Audio', 'SongList', "&song_band={$this->getID()}"); }
    public function hrefAlbums() { return href('Audio', 'AlbumList', "&album_band={$this->getID()}"); }
    
}
