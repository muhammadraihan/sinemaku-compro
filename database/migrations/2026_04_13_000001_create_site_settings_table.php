<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->string('group')->default('general'); // e.g. 'about', 'general'
            $table->timestamps();
        });

        // Seed default About page settings so the CMS is ready to use immediately
        $defaults = [
            ['key' => 'about_hero_title',        'group' => 'about', 'value' => "Here Comes\nThe Fun"],
            ['key' => 'about_hero_subtitle',     'group' => 'about', 'value' => 'about sinemaku pictures'],
            ['key' => 'about_identity_heading',  'group' => 'about', 'value' => 'Sinemaku Pictures hadir untuk memberdayakan generasi baru pencerita dan mengubah lanskap perfilman Indonesia.'],
            ['key' => 'about_mission_statement', 'group' => 'about', 'value' => "Sinemaku Pictures bukan sekadar rumah produksi, melainkan ruang bermain bagi generasi baru pencerita yang berani mendobrak tradisi kaku demi mengubah lanskap perfilman Indonesia.\n\nKami percaya bahwa cerita terbaik lahir dari keberanian mengeksplorasi ide-ide gila dan menyulap realitas menjadi magis di layar lebar, tanpa pernah melupakan semangat kolaborasi yang menghidupkan komunitas di setiap napas produksinya.\n\nBagi kami, keseriusan dalam mengejar kualitas visual premium hanyalah separuh cerita; separuh lainnya adalah tentang merayakan imajinasi dan memastikan bahwa di setiap prosesnya, Here Comes The Fun."],
            ['key' => 'about_vision_statement',  'group' => 'about', 'value' => ''],
            ['key' => 'about_studio_label',      'group' => 'about', 'value' => 'Company'],
            ['key' => 'about_studio_body',       'group' => 'about', 'value' => 'Pelajari bagaimana Sinemaku beroperasi. Jelajahi identitas kami, pendekatan kami, dan peran kami dalam membina sineas muda untuk ekosistem film Indonesia.'],
            ['key' => 'about_values_1_title',    'group' => 'about', 'value' => 'Film & Seri web'],
            ['key' => 'about_values_1_body',     'group' => 'about', 'value' => 'Eksplorasi cerita layar lebar dan seri web dengan narasi segar, menghadirkan estetika visual yang menantang batas-batas konvensional.'],
            ['key' => 'about_values_2_title',    'group' => 'about', 'value' => 'Tayangan Televisi'],
            ['key' => 'about_values_2_body',     'group' => 'about', 'value' => 'Menghadirkan kisah-kisah hangat untuk ruang keluarga melalui produksi televisi yang berkualitas dan dekat dengan realitas sehari-hari.'],
            ['key' => 'about_values_3_title',    'group' => 'about', 'value' => 'Komunitas & Event'],
            ['key' => 'about_hero_image',        'group' => 'about', 'value' => 'photo/about_hero.png'],
            ['key' => 'about_secondary_image',   'group' => 'about', 'value' => 'photo/about_secondary.png'],
            ['key' => 'about_team_image_1',      'group' => 'about', 'value' => 'photo/about_hero.png'],
            ['key' => 'about_team_image_2',      'group' => 'about', 'value' => 'photo/about_crew_1.png'],
            ['key' => 'about_team_image_3',      'group' => 'about', 'value' => 'photo/about_crew_2.png'],
            ['key' => 'about_team_image_4',      'group' => 'about', 'value' => 'photo/about_crew_3.png'],
            ['key' => 'about_team_image_5',      'group' => 'about', 'value' => 'photo/about_crew_4.png'],
            ['key' => 'about_team_image_6',      'group' => 'about', 'value' => 'photo/about_crew_5.png'],
        ];

        foreach ($defaults as $row) {
            \DB::table('site_settings')->insertOrIgnore(array_merge($row, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
