<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index()
    {
        $mappp = "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2552.7933967249073!2d117.22912786566681!3d-0.8342596379442541!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcd748a34b972a55b!2sKlinik%20Maju%20Sejahtera!5e1!3m2!1sid!2sid!4v1664207204197!5m2!1sid!2sid";

        return view('welcome', compact('mappp'));
    }
}
