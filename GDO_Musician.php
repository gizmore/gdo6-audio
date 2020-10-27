<?php
namespace GDO\Audio;

use GDO\Core\GDO;
use GDO\DB\GDT_CreatedAt;
use GDO\DB\GDT_CreatedBy;
use GDO\DB\GDT_EditedAt;
use GDO\DB\GDT_EditedBy;
use GDO\DB\GDT_String;
use GDO\DB\GDT_AutoInc;
use GDO\Country\GDT_Country;
use GDO\DB\GDT_DeletedAt;
use GDO\DB\GDT_DeletedBy;
use GDO\Date\GDT_Birthdate;

final class GDO_Musician extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('musician_id'),
            GDT_String::make('musician_name')->label('name')->notNull(),
            GDT_Country::make('musician_country')->withCompletion(),
            GDT_Birthdate::make('musician_birthday'),
            GDT_EditedAt::make('musician_edited'),
            GDT_EditedBy::make('musician_editor'),
            GDT_CreatedAt::make('musician_created'),
            GDT_CreatedBy::make('musician_creator'),
            GDT_DeletedAt::make('musician_deleted'),
            GDT_DeletedBy::make('musician_deletor'),
        );
    }

}
