<?php
namespace GDO\Audio;

use GDO\Core\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\DB\GDT_CreatedAt;
use GDO\DB\GDT_CreatedBy;
use GDO\DB\GDT_EditedAt;
use GDO\DB\GDT_EditedBy;
use GDO\Date\GDT_Date;
use GDO\UI\GDT_Title;

final class GDO_Band extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('band_id'),
            GDT_Title::make('band_name')->notNull(),
            GDT_Genre::make('band_genre'),
            GDT_Date::make('band_founded'),
            GDT_EditedAt::make('band_edited'),
            GDT_EditedBy::make('band_editor'),
            GDT_CreatedAt::make('band_created'),
            GDT_CreatedBy::make('band_creator'),
        );
    }
    
}
