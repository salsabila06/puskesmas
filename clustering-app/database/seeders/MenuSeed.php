<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu = [
            [
                'menu_name' => 'Dashboard',
                'menu_url' => '/dashboard',
                'menu_icon' => "bxs:dashboard"
            ],
            [
                'menu_name' => 'Parameter',
                'menu_url' => '/parameter-penilaian',
                'menu_icon' => "healthicons:i-exam-multiple-choice"
            ],
            [
                'menu_name' => 'Pertanyaan',
                'menu_url' => '/pertanyaan',
                'menu_icon' => "fluent:book-question-mark-24-filled"
            ],
            [
                'menu_name' => 'Survey',
                'menu_url' => '/survey',
                'menu_icon' => "wpf:survey"
            ],
            [
                'menu_name' => 'Hasil Survey',
                'menu_url' => '/result',
                'menu_icon' => "clarity:clipboard-solid"
            ],
            [
                'menu_name' => 'Hasil Clustering',
                'menu_url' => '/hasil-clustering',
                'menu_icon' => "streamline:interface-file-clipboard-check-checkmark-edit-task-edition-checklist-check-success-clipboard-form"
            ],
            [
                'menu_name' => 'Isi Survey',
                'menu_url' => '/input-survey',
                'menu_icon' => "fluent:text-bullet-list-square-edit-24-filled"
            ],
            [
                'menu_name' => 'Puskesmas',
                'menu_url' => '/puskesmas',
                'menu_icon' => "mingcute:hospital-fill"
            ],

        ];

        Menu::insert($menu);
    }
}
