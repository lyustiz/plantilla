<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;

class LdapController extends Controller
{
    protected $dn;

    public function __construct()
    {
        $this->dn = env('LDAP_MENU_DN');
    }

    public function index($user) 
    {
        $ldap = Adldap::search()
                ->select  ('userid')
                ->setDn($this->dn)
                ->where('Memberuid', $user)
                ->get();

        $menu = [];

        foreach ($ldap as $key => $value) 
        {
            $uid = $value->uid[0];

            $ldap = Adldap::search()
                            ->select  ('cn', 'labeleduri')
                            ->setDn($this->dn)
                            ->where   ('Memberuid', $uid)
                            ->whereHas('labeleduri')
                            ->sortBy('dn', 'cn', 'labeleduri', 'asc')
                            ->get();   
    
            foreach ($ldap as $key => $value) 
            {
                $labeleduri = $value->labeleduri;
                sort($labeleduri);
                $menu[$value->cn[0]] = $labeleduri;
            }
        }
        
        return $menu;
    }

}
 