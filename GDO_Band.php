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
use GDO\Country\GDT_Country;
use GDO\DB\GDT_DeletedAt;
use GDO\DB\GDT_DeletedBy;
use GDO\Core\GDT_Template;
use GDO\User\GDO_User;

/**
 * A music band entity.
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 *
 * @see GDO_Album
 */
final class GDO_Band extends GDO
{
    ###########
    ### GDO ###
    ###########
    public function gdoColumns()
    {
        return array(
            GDT_AutoInc::make('band_id'),
            GDT_Title::make('band_name')->notNull(),
            GDT_Genre::make('band_genre'),
            GDT_Date::make('band_founded')->label('founded'),
            GDT_Country::make('band_country')->withCompletion(),
            GDT_EditedAt::make('band_edited'),
            GDT_EditedBy::make('band_editor'),
            GDT_CreatedAt::make('band_created'),
            GDT_CreatedBy::make('band_creator'),
            GDT_DeletedAt::make('band_deleted'),
            GDT_DeletedBy::make('band_deletor'),
        );
    }
    
    ##############
    ### Getter ###
    ##############
    public function getID() { return $this->getVar('band_id'); }
    
    ##############
    ### Render ###
    ##############
    public function displayName() { return $this->display('band_name'); }
    public function displayGenre() { return $this->gdoColumn('band_genre')->renderCell(); }
    public function displayFounded() { return $this->gdoColumn('band_founded')->renderCell(); }
    public function displayCountry() { return $this->gdoColumn('band_country')->renderCell(); }
    public function renderCard() { return GDT_Template::php('Audio', 'card/band.php', ['gdo' => $this]); }
    public function renderChoice() { return GDT_Template::php('Audio', 'choice/band.php', ['gdo' => $this]); }

    ##################
    ### Permission ###
    ##################
    public function canEdit(GDO_User $user=null) { return Module_Audio::instance()->canEdit($user); }
    
    ##################
    ### Statistics ###
    ##################
    public function numSongsAvailable()
    {
        if (null === ($songs = $this->tempGet('audio_songs_available')))
        {
            $songs = $this->querySongsAvailable();
            $this->tempSet('audio_songs_available', $songs);
            $this->recache();
        }
        return $songs;
    }
    
    private function querySongsAvailable()
    {
        $query = GDO_Song::table()->select('COUNT(*)')->where("song_band={$this->getID()} AND song_deleted IS NULL");
        return $query->exec()->fetchValue();
    }

}
