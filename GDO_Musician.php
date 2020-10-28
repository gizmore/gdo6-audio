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
use GDO\File\GDT_ImageFile;
use GDO\Core\GDT_Template;
use GDO\DB\GDT_UInt;
use GDO\DB\GDT_Virtual;
use GDO\User\GDO_User;
use GDO\Date\Time;
use GDO\User\GDT_Gender;

final class GDO_Musician extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('musician_id'),
            GDT_String::make('musician_name')->label('name')->unique()->notNull(),
            GDT_Gender::make('musician_gender'),
            GDT_Country::make('musician_country')->withCompletion(),
            GDT_Instrument::make('musician_instrument'),
            GDT_Birthdate::make('musician_birthday'),
            GDT_ImageFile::make('musician_photo')->scaledVersion('thumb', 64, 64),
            GDT_Virtual::make('musician_songs')->label('num_songs')->gdtType(GDT_UInt::class)->subquery("SELECT COUNT(*) FROM gdo_songmusician WHERE sm_musician = musician_id"),
            GDT_EditedAt::make('musician_edited'),
            GDT_EditedBy::make('musician_editor'),
            GDT_CreatedAt::make('musician_created'),
            GDT_CreatedBy::make('musician_creator'),
            GDT_DeletedAt::make('musician_deleted'),
            GDT_DeletedBy::make('musician_deletor'),
        );
    }
    
    public function getBirthdate() { return $this->getVar('musician_birthday'); }
    
    ############
    ### Perm ###
    ############
    public function canEdit(GDO_User $user=null) { return Module_Audio::instance()->canEdit(); }
    
    ############
    ### HREF ###
    ############
    public function hrefEdit() { return href('Audio', 'MusicianCRUD', "&id={$this->getID()}"); }
    
    ###############
    ###  Render ###
    ###############
    public function displayAge() { return Time::displayAge($this->getBirthdate()); }
    public function displayBirthdate() { return $this->gdoColumn('musician_birthday')->renderCell(); }
    public function renderCard() { return GDT_Template::php('Audio', 'card/musician.php', ['gdo' => $this]); }
    
}
