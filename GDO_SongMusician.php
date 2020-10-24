<?php
namespace GDO\Audio;

use GDO\Core\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\DB\GDT_Object;

final class GDO_SongMusician extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('sm_id'),
            GDT_Object::make('sm_song')->table(GDO_Song::table())->notNull(),
            GDT_Object::make('sm_musician')->table(GDO_Musician::table())->notNull(),
            GDT_Instrument::make('sm_instrument')->notNull(),
        );
    }
    
}
