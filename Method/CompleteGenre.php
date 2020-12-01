<?php
namespace GDO\Audio\Method;

use GDO\Core\MethodCompletion;
use GDO\Audio\GDT_Genre;
use GDO\Core\Website;
use GDO\Audio\GDO_Song;
use GDO\Audio\GDO_Band;

/**
 * Auto completion for genres
 * @author gizmore
 */
final class CompleteGenre extends MethodCompletion
{
    public function execute()
    {
        # build all
        $labels = [];
        $genres = GDT_Genre::$GENRES;
        foreach ($genres as $genre)
        {
            $labels[] = mb_strtolower(t('enum_'.$genre));
        }
        $all = array_combine($genres, $labels);
        
        $genres_song = GDO_Song::table()->select('DISTINCT(song_genre)')->exec()->fetchColumn();
        $genres_band = GDO_Band::table()->select('DISTINCT(band_genre)')->exec()->fetchColumn();
        
        $genres_db = array_merge($genres_song, $genres_band);
        $genres_db = array_unique($genres_db);
        $genres_db = array_combine($genres_db, $genres_db);
        
        $all = array_merge($all, $genres_song);
        
        # sort them
        uasort($all, function($a, $b) {
            $ca = iconv('utf-8', 'ascii//TRANSLIT', $a);
            $cb = iconv('utf-8', 'ascii//TRANSLIT', $b);
            return strcasecmp($ca, $cb);
        });
        
        # match them
        $matches = [];
        $q = mb_strtolower($this->getSearchTerm());
        $max = $this->getMaxSuggestions();
        foreach ($all as $key => $value)
        {
            $value = mb_strtolower($value);
            if ( ($q==='') || (mb_strpos($value, $q) !== false))
            {
                $matches[$key] = $value;
                if (count($matches) >= $max)
                {
                    break;
                }
            }
        }
        
        # sort exact match first
        uasort($matches, function($a, $b) use($q) {
            return $a === $q ? -1 : 1;
        });
        
        # render as json
        $json = [];
        foreach ($matches as $key => $value)
        {
            $json[] = array(
                'id' => $key,
                'text' => $value,
                'display' => $value,
            );
        }
        
        Website::renderJSON($json);
    }
    
}
