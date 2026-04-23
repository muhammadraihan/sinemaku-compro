<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'about_hero_title' => ['id' => "Here Comes\nThe Fun.", 'en' => "Here Comes\nThe Fun."],
            'about_hero_subtitle' => ['id' => "about sinemaku pictures", 'en' => "about sinemaku pictures"],
            'about_identity_heading' => ['id' => "Sinemaku Pictures hadir untuk memberdayakan generasi baru pencerita dan mengubah lanskap perfilman Indonesia.", 'en' => "Sinemaku Pictures is here to empower a new generation of storytellers and change the landscape of Indonesian cinema."],
            'about_studio_label' => ['id' => "Company", 'en' => "Company"],
            'about_studio_body' => ['id' => "Pelajari bagaimana Sinemaku beroperasi. Jelajahi identitas kami, pendekatan kami, dan peran kami dalam membina sineas muda untuk ekosistem film Indonesia.", 'en' => "Learn how Sinemaku operates. Explore our identity, our approach, and our role in nurturing young filmmakers for the Indonesian film ecosystem."],
            'about_team_label' => ['id' => "Team", 'en' => "Team"],
            'about_team_body' => ['id' => "Kenali tim dan kolaborator yang membentuk kami. Pelajari tentang orang-orang di balik proyek kami, peran mereka, dan nilai-nilai yang memandu cara kami bekerja.", 'en' => "Meet the team and collaborators who shape us. Learn about the people behind our projects, their roles, and the values that guide how we work."],
            'about_mission_statement' => ['id' => "Sinemaku Pictures bukan sekadar rumah produksi, melainkan ruang bermain bagi generasi baru pencerita yang berani mendobrak tradisi kaku demi mengubah lanskap perfilman Indonesia.\n\nKami percaya bahwa cerita terbaik lahir dari keberanian mengeksplorasi ide-ide gila dan menyulap realitas menjadi magis di layar lebar, tanpa pernah melupakan semangat kolaborasi yang menghidupkan komunitas di setiap napas produksinya.\n\nBagi kami, keseriusan dalam mengejar kualitas visual premium hanyalah separuh cerita; separuh lainnya adalah tentang merayakan imajinasi dan memastikan bahwa di setiap prosesnya, Here Comes The Fun.", 'en' => "Sinemaku Pictures is not just a production house, but a playground for a new generation of storytellers who dare to break rigid traditions to change the landscape of Indonesian cinema.\n\nWe believe that the best stories are born from the courage to explore crazy ideas and magically transform reality onto the big screen, without ever forgetting the spirit of collaboration that brings communities to life in every breath of its production.\n\nFor us, seriousness in pursuing premium visual quality is only half the story; the other half is about celebrating imagination and ensuring that in every process, Here Comes The Fun."],
            'about_wwd_eyebrow' => ['id' => "What We Do", 'en' => "What We Do"],
            'about_wwd_heading' => ['id' => "Bukan hanya sekadar membuat karya.", 'en' => "More than just creating works."],
            'about_values_1_title' => ['id' => "Film & Seri web", 'en' => "Film & Web Series"],
            'about_values_1_body' => ['id' => "Eksplorasi cerita layar lebar dan seri web dengan narasi segar, menghadirkan estetika visual yang menantang batas-batas konvensional.", 'en' => "Exploring big screen stories and web series with fresh narratives, presenting visual aesthetics that challenge conventional boundaries."],
            'about_values_2_title' => ['id' => "Tayangan Televisi", 'en' => "Television Shows"],
            'about_values_2_body' => ['id' => "Menghadirkan kisah-kisah hangat untuk ruang keluarga melalui produksi televisi yang berkualitas dan dekat dengan realitas sehari-hari.", 'en' => "Bringing warm stories to the family room through quality television productions that are close to everyday reality."],
            'about_values_3_title' => ['id' => "Komunitas & Event", 'en' => "Community & Events"],
            'about_values_3_body' => ['id' => "Rantai penghubung antarsineas dan penonton lewat Sinemaku Day, workshop, nobar bincang karya, dan program kerelawanan.", 'en' => "The connecting chain between filmmakers and audiences through Sinemaku Day, workshops, screening discussions, and volunteer programs."],
            'about_collab_eyebrow' => ['id' => "Kolaborasi", 'en' => "Collaboration"],
            'about_collab_heading' => ['id' => "Ada proyek hebat yang bisa dikerjakan bersama?", 'en' => "Have a great project to work on together?"],
        ];

        foreach ($settings as $key => $vals) {
            SiteSetting::setValue($key, $vals['id'], 'about', $vals['en']);
        }
    }
}
