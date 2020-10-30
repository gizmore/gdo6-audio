<?php
namespace GDO\Audio;

use GDO\Core\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\UI\GDT_Title;
use GDO\Date\GDT_Date;
use GDO\DB\GDT_CreatedAt;
use GDO\DB\GDT_CreatedBy;
use GDO\DB\GDT_EditedAt;
use GDO\DB\GDT_EditedBy;
use GDO\File\GDT_ImageFile;
use GDO\File\GDO_File;
use GDO\Core\GDT_Template;
use GDO\DB\GDT_DeletedAt;
use GDO\DB\GDT_DeletedBy;
use GDO\User\GDO_User;
use GDO\DB\GDT_Virtual;
use GDO\DB\GDT_UInt;
use GDO\DB\GDT_Checkbox;

/**
 * Music album entity.
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class GDO_Album extends GDO
{
    ###########
    ### GDO ###
    ###########
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('album_id'),
            GDT_Title::make('album_title')->max(128)->notNull(),
            GDT_Genre::make('album_genre'),
            GDT_Band::make('album_band'),
            GDT_Date::make('album_released')->label('released'),
            GDT_Checkbox::make('album_featured')->label('featured')->initial('0'),
            GDT_ImageFile::make('album_cover')->label('cover')->scaledVersion('thumb', 128, 128)->previewHREF(href('Audio', 'Cover', "&file=")),
            GDT_Virtual::make('album_tracks')->gdtType(GDT_UInt::class)->subquery("SELECT COUNT(*) FROM gdo_songalbum WHERE sa_album=album_id"),
            GDT_EditedAt::make('album_edited'),
            GDT_EditedBy::make('album_editor'),
            GDT_CreatedAt::make('album_created'),
            GDT_CreatedBy::make('album_creator'),
            GDT_DeletedAt::make('album_deleted'),
            GDT_DeletedBy::make('album_deletor'),
        );
    }
    
    ############
    ### Perm ###
    ############^
    public function canEdit(GDO_User $user=null) { return Module_Audio::instance()->canEdit($user); }
    public function hrefEdit() { return href('Audio', 'AlbumCRUD', "&album_id={$this->getID()}"); }
    public function hrefShow() { return href('Audio', 'AlbumView', "&id={$this->getID()}"); }
    
    ##############
    ### Getter ###
    ##############
    /**
     * @return GDO_File
     */
    public function getCover() { return $this->getValue('album_cover'); }
    public function getCoverId() { return $this->getVar('album_cover'); }
    
    /**
     * @return GDO_Band
     */
    public function getBand() { return $this->getValue('album_band'); }
    public function getBandID() { return $this->getVar('album_band'); }
    
    /**
     * @return GDT_ImageFile
     */
    public function gdoCoverColumn() { return $this->gdoColumn('album_cover'); }

    ##############
    ### Render ###
    ##############
    public function displayName() { return $this->display('album_title'); }
    public function displayTitle() { return $this->display('album_title'); }
    public function displayReleased() { return $this->gdoColumn('album_released')->renderCell(); }
//     public function displayBand() { return $this->gdoColumn('album_band')->renderChoice(); }
//     public function displayCover() { return $this->gdoColumn('album_cover')->renderCell(); }
    public function renderCard() { return GDT_Template::php('Audio', 'card/album.php', ['gdo' => $this]); }
    public function renderList() { return GDT_Template::php('Audio', 'list/album.php', ['gdo' => $this]); }
    public function renderChoice() { return GDT_Template::php('Audio', 'choice/album.php', ['album' => $this]); }
    
}
