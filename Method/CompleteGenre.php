<?php
namespace GDO\Audio\Method;

use GDO\Core\MethodCompletion;
use GDO\Audio\GDT_Genre;
use GDO\Core\Website;

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
