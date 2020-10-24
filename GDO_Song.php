<?php
namespace GDO\Audio;

use GDO\Core\GDO;
use GDO\DB\GDT_AutoInc;
use GDO\DB\GDT_CreatedAt;
use GDO\DB\GDT_CreatedBy;
use GDO\DB\GDT_EditedAt;
use GDO\DB\GDT_EditedBy;
use GDO\DB\GDT_Object;
use GDO\UI\GDT_Title;
use GDO\Date\GDT_Date;
use GDO\Language\GDT_Language;

final class GDO_Song extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('song_id'),
            GDT_Title::make('song_title')->notNull(),
            GDT_Object::make('song_original')->table(GDO_Song::table()), # for remixes
            GDT_Object::make('song_band')->table(GDO_Band::table()),
            GDT_AudioFile::make('song_file'),
            GDT_Genre::make('song_genre'),
            GDT_Language::make('song_language'),
            GDT_Lyrics::make('song_lyrics'),
            GDT_BPM::make('song_bpm'),
            GDT_Date::make('song_released'),
            GDT_EditedAt::make('song_edited'),
            GDT_EditedBy::make('song_editor'),
            GDT_CreatedAt::make('song_created'),
            GDT_CreatedBy::make('song_creator'),
        );
    }
    
}
