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

final class GDO_Album extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('album_id'),
            GDT_Title::make('album_title'),
            GDT_Genre::make('album_genre'),
            GDT_Date::make('album_released'),
            GDT_Country::make('album_country'),
            GDT_ImageFile::make('album_cover')->scaledVersion('thumb', 128, 128),
            GDT_EditedAt::make('album_edited'),
            GDT_EditedBy::make('album_editor'),
            GDT_CreatedAt::make('album_created'),
            GDT_CreatedBy::make('album_creator'),
        );
    }
    
    public function getCoverId() { return $this->getVar('album_cover'); }
    
}
