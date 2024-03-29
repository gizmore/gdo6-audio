<?php
namespace GDO\Audio\Method;

use GDO\Core\MethodCompletion;
use GDO\Core\Website;
use GDO\Audio\GDT_Instrument;
use GDO\Audio\GDO_SongMusician;
use GDO\Core\GDT_Array;

/**
 * Auto completion for genres
 * @author gizmore
 */
final class CompleteInstrument extends MethodCompletion
{
    public function execute()
    {
        # build all
        $labels = [];
        $instruments = GDT_Instrument::$INSTRUMENTS;
        foreach ($instruments as $instrument)
        {
            $labels[] = mb_strtolower(t('enum_'.$instrument));
        }
        $all = array_combine($instruments, $labels);
        
        $instruments = GDO_SongMusician::table()->select('DISTINCT(sm_instrument)')->exec()->fetchColumn();
        
        $instruments = array_combine($instruments, $instruments);
        
        $all = array_merge($all, $instruments);
        
        
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
        
        return GDT_Array::makeWith($json);
    }
    
}
