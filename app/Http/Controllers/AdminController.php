<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        // Array kata-kata motivasi
        $motivations = [
            "Jangan pernah menyerah, kesuksesan ada di depan mata.",
            "Hari ini adalah kesempatan untuk menjadi lebih baik.",
            "Keberhasilan datang kepada mereka yang mau berusaha.",
            "Setiap langkah kecil mendekatkanmu pada tujuan besar.",
            "Kerja keras hari ini, hasil besar esok hari.",
            "Jadilah versi terbaik dari dirimu sendiri setiap hari.",
            "Semangat adalah kunci untuk menggapai mimpi."
        ];

        // Pilih motivasi berdasarkan hari ini
        $dayIndex = date('z') % count($motivations);
        $motivation = $motivations[$dayIndex];

        // Menentukan sapaan berdasarkan waktu
        $hour = date('H');
        if ($hour < 10) {
            $greeting = "Selamat Pagi";
        } elseif ($hour < 14) {
            $greeting = "Selamat Siang";
        } elseif ($hour < 18) {
            $greeting = "Selamat Sore";
        } else {
            $greeting = "Selamat Malam";
        }

        // Mengirim data ke view
        return view('admin.dashboard', compact('motivation', 'greeting'));
    }
}
