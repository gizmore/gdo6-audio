<?php
namespace GDO\Audio\Method;

use GDO\Core\Method;
use GDO\Audio\GDO_Song;
use GDO\Audio\GDT_Song;
use GDO\Net\Stream;
use GDO\UI\GDT_Link;

/**
 * Download a lyrics file for a song.
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class Lyrics extends Method
{
    public function gdoParameters()
    {
        return [
            GDT_Song::make('song')->notNull(),
        ];
    }
    
    /**
     * @return GDO_Song
     */
    public function getSong()
    {
        return $this->gdoParameterValue('song');
    }
    
    public function execute()
    {
        $song = $this->getSong();
        $fileName = "Lyrics_" . seo($song->getBand()->displayName().'_'.$song->displayTitle());
        $fileName .= '.txt';
        $lyrics = t('lyrics_file', [
            $song->displayTitle(), $song->getBand()->displayName(),
            $song->displayReleased(), $song->getPlainTextLyrics()]);
        Stream::serveText($lyrics, $fileName);
        die(0);
    }
    
}
