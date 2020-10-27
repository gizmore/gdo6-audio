<?php
namespace GDO\Audio;

use GDO\Form\MethodCrud;

/**
 * CRUD methods share the same permissions.
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
abstract class MethodAudioCRUD extends MethodCrud
{
    public function getPermission()
    {
        if (!Module_Audio::instance()->cfgAllowUserEntries())
        {
            return 'staff';
        }
    }
    
    public function isGuestAllowed()
    {
        return Module_Audio::instance()->cfgAllowGuestEntries();
    }
    
}
