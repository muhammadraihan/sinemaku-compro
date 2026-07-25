<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\HeroSlide;
use App\Support\ImageOptimizer;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    /**
     * Show the About page editor form.
     */
    public function aboutIndex()
    {
        $settings = SiteSetting::getGroup('about');
        $heroSlides = HeroSlide::orderBy('sort_order')->get();
        return view('settings.about', compact('settings', 'heroSlides'));
    }

    /**
     * Save all About page settings in one POST.
     */
    public function aboutUpdate(Request $request)
    {
        $keys = [
            'about_identity_heading',
            'about_mission_statement',
            'about_vision_statement',
            'about_studio_label',
            'about_studio_body',
            'about_team_label',
            'about_team_body',
            'about_values_1_title',
            'about_values_1_body',
            'about_values_2_title',
            'about_values_2_body',
            'about_values_3_title',
            'about_values_3_body',
            'about_wwd_eyebrow',
            'about_wwd_heading',
            'about_collab_eyebrow',
            'about_collab_heading',
        ];

        // Handle basic text keys
        foreach ($keys as $key) {
            if ($request->has($key)) {
                $value_en = $request->input($key . '_en');
                SiteSetting::setValue($key, $request->input($key), 'about', $value_en);
            }
        }

        // Handle Hero Slides (Dynamic Multiple Images)
        $existingSlideIds = $request->input('hero_existing_slide_ids', []);
        $existingSlidePaths = $request->input('hero_existing_slide_paths', []);
        
        // Delete slides that were removed in UI
        HeroSlide::whereNotIn('id', array_filter($existingSlideIds))->delete();

        // Update/Insert Slides
        $slideFiles = $request->file('hero_slides', []);
        $totalSlides = max(count($existingSlidePaths), count($slideFiles));

        for ($i = 0; $i < $totalSlides; $i++) {
            $imagePath = $existingSlidePaths[$i] ?? null;
            
            if (isset($slideFiles[$i])) {
                $file = $slideFiles[$i];
                $filename = ImageOptimizer::save($file, 'photo', 'hero_slide_' . time() . '_' . $i);
                $imagePath = 'photo/' . $filename;
            }

            if ($imagePath) {
                HeroSlide::updateOrCreate(
                    ['id' => $existingSlideIds[$i] ?? null],
                    ['image_path' => $imagePath, 'sort_order' => $i]
                );
            }
        }

        // Handle Other Fixed Images
        $fixedImageKeys = ['about_secondary_image'];
        foreach ($fixedImageKeys as $imageKey) {
            if ($request->hasFile($imageKey)) {
                $file = $request->file($imageKey);
                $filename = ImageOptimizer::save($file, 'photo', $imageKey . '_' . time());
                SiteSetting::setValue($imageKey, 'photo/' . $filename, 'about');
            }
        }

        // Handle Dynamic Team Gallery
        // 1. Clean up existing team keys first (optional but recommended for dynamic list)
        SiteSetting::where('group', 'about')->where('key', 'like', 'about_team_image_%')->delete();
        SiteSetting::where('group', 'about')->where('key', 'like', 'about_team_name_%')->delete();
        SiteSetting::where('group', 'about')->where('key', 'like', 'about_team_role_%')->delete();

        $teamNames = $request->input('team_names', []);
        $teamRoles = $request->input('team_roles', []);
        $teamExistingImages = $request->input('team_existing_images', []);

        foreach ($teamNames as $i => $name) {
            $index = $i + 1;
            SiteSetting::setValue("about_team_name_$index", $name, 'about');
            SiteSetting::setValue("about_team_role_$index", $teamRoles[$i] ?? '', 'about');
            
            $imagePath = $teamExistingImages[$i] ?? '';
            $fileKey = "team_images_$i";
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $filename = ImageOptimizer::save($file, 'photo', 'crew_' . time() . '_' . $index);
                $imagePath = 'photo/' . $filename;
            }
            
            if (!empty($imagePath)) {
                SiteSetting::setValue("about_team_image_$index", $imagePath, 'about');
            }
        }

        toastr()->success('About page content updated!', 'Success');
        return redirect()->route('settings.about');
    }

    /**
     * Show the Membership page editor form.
     */
    public function membershipIndex()
    {
        $settings = SiteSetting::getGroup('membership');
        return view('settings.membership', compact('settings'));
    }

    /**
     * Save Membership page settings.
     */
    public function membershipUpdate(Request $request)
    {
        $keys = [
            'membership_hero_title',
            'membership_hero_subtitle',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                $value_en = $request->input($key . '_en');
                SiteSetting::setValue($key, $request->input($key), 'membership', $value_en);
            }
        }

        if ($request->hasFile('membership_hero_image')) {
            $file = $request->file('membership_hero_image');
            $filename = ImageOptimizer::save($file, 'photo', 'membership_' . time());
            SiteSetting::setValue('membership_hero_image', 'photo/' . $filename, 'membership');
        }

        toastr()->success('Membership page content updated!', 'Success');
        return redirect()->route('settings.membership');
    }
}
