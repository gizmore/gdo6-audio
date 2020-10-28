<?php
namespace GDO\Audio;

use GDO\Core\GDO;
use GDO\Country\GDT_Country;
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
            GDT_ImageFile::make('album_cover')->label('cover')->scaledVersion('thumb', 128, 128),
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
    
    ##############
    ### Getter ###
    ##############
    /**
     * @return GDO_File
     */
    public function getCover() { return $this->getValue('album_cover'); }
    public function getCoverId() { return $this->getVar('album_cover'); }

    ##############
    ### Render ###
    ##############
    public function displayTitle() { return $this->display('album_title'); }
    public function displayReleased() { return $this->gdoColumn('album_released')->renderCell(); }
    public function displayBand() { return $this->gdoColumn('album_band')->renderChoice(); }
    public function renderCard() { return GDT_Template::php('Audio', 'card/album.php', ['gdo' => $this]); }
    public function renderChoice() { return sprintf('%s - %s', $this->displayTitle(), $this->displayBand()); }
    
}
