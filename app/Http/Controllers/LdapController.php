<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;

class LdapController extends Controller
{
    protected $dn = 'ou=AppBaseBandes,ou=Aplicaciones,ou=Venezuela,ou=Bandes,dc=qa,dc=bandes,dc=gob,dc=ve';

    public function index($user) 
    {

        $ldap = Adldap::search()
                ->select  ('userid')
                ->setDn($this->dn)
                ->where('Memberuid', '=',$user)
                ->get();

        $menu = array();

        foreach ($ldap as $key => $value) {
            // echo $value->uid[0]. "<br />\n";
            $uid = $value->uid[0];

            $ldap = Adldap::search()
                            ->select  ('cn', 'labeleduri')
                            ->setDn($this->dn)
                            ->where   ('Memberuid', '=', $uid)
                            ->whereHas('labeleduri')
                            ->sortBy('dn', 'cn', 'labeleduri', 'asc')
                            ->get();   
    
            foreach ($ldap as $key => $value) {
                // echo $value->cn[0]. "<br />\n";
                $labeleduri = $value->labeleduri;
                sort($labeleduri);
                $menu[$value->cn[0]] = $labeleduri;
            }
        }
        // array_multisort($menu);
        return $menu;
    }

}
 