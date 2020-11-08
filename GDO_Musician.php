<?php
namespace GDO\Audio;

use GDO\Core\GDO;
use GDO\DB\GDT_Checkbox;
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
use GDO\UI\GDT_Message;
use GDO\User\GDO_User;
use GDO\Date\Time;
use GDO\User\GDT_Gender;
use GDO\Country\GDO_Country;
use GDO\File\GDO_File;

final class GDO_Musician extends GDO
{
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('musician_id'),
            GDT_String::make('musician_name')->label('name')->unique()->notNull(),
            GDT_Message::make('musician_description')->label('description'),
            GDT_Gender::make('musician_gender'),
            GDT_Country::make('musician_country')->withCompletion(),
            GDT_Birthdate::make('musician_birthday'),
            GDT_ImageFile::make('musician_photo')->scaledVersion('thumb', 64, 64)->previewHREF(href('Audio', 'MusicianPhoto', '&file=')),
            GDT_Checkbox::make('musician_featured')->label('featured')->initial('0'),
            GDT_Virtual::make('musician_songs')->label('_num_songs')->gdtType(GDT_UInt::class)->subquery("SELECT COUNT(DISTINCT(sm_song)) FROM gdo_songmusician WHERE sm_musician = musician_id"),
            GDT_Virtual::make('musician_instruments')->label('num_instruments')->gdtType(GDT_UInt::class)->subquery("SELECT COUNT(DISTINCT(sm_instrument)) FROM gdo_songmusician WHERE sm_musician = musician_id"),
            GDT_EditedAt::make('musician_edited'),
            GDT_EditedBy::make('musician_editor'),
            GDT_CreatedAt::make('musician_created'),
            GDT_CreatedBy::make('musician_creator'),
            GDT_DeletedAt::make('musician_deleted'),
            GDT_DeletedBy::make('musician_deletor'),
        );
    }
    
    /**
     * @return GDO_Song[]
     */
    public function getSongs() { return GDO_SongMusician::getSongs($this); }
    public function getBirthdate() { return $this->getVar('musician_birthday'); }
    public function getNumSongs() { return $this->getVar('musician_songs'); }
    public function getNumInstruments() { return $this->getVar('musician_instruments'); }
    public function getInstrument() { return $this->getVar('sm_instrument'); }
    public function isFeatured() { return $this->getValue('musician_featured'); }
    
    /** @return GDO_Country **/
    public function getCountry()
    {
        $country = $this->getValue('musician_country');
        return $country ? $country : GDO_Country::unknownCountry();
    }
    
    /** @return GDO_File **/
    public function getPhoto() { return $this->getValue('musician_photo'); }
    public function getPhotoID() { return $this->getVar('musician_photo'); }
    
    ############
    ### Perm ###
    ############
    public function canEdit(GDO_User $user=null) { return Module_Audio::instance()->canEdit(); }
    
    ############
    ### HREF ###
    ############
    public function hrefEdit() { return href('Audio', 'MusicianCRUD', "&musician_id={$this->getID()}"); }
    public function hrefShow() { return href('Audio', 'MusicianShow', "&id={$this->getID()}"); }
    
    ###############
    ###  Render ###
    ###############
    public function displayName() { return $this->display('musician_name'); }
    public function displayAge() { return Time::displayAge($this->getBirthdate()); }
    public function displayBirthdate() { return $this->gdoColumn('musician_birthday')->renderCell(); }
    public function renderCard() { return GDT_Template::php('Audio', 'card/musician.php', ['gdo' => $this]); }
    public function renderList() { return GDT_Template::php('Audio', 'list/musician.php', ['gdo' => $this]); }
    
}
