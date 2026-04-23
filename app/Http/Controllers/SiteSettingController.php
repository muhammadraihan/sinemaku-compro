<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;

class SiteSettingController extends Controller
{
    /**
     * Show the About page editor form.
     */
    public function aboutIndex()
    {
        $settings = SiteSetting::getGroup('about');
        return view('settings.about', compact('settings'));
    }

    /**
     * Save all About page settings in one POST.
     */
    public function aboutUpdate(Request $request)
    {
        $keys = [
            'about_hero_title',
            'about_hero_subtitle',
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

        // Handle Images (Fixed Keys)
        $fixedImageKeys = ['about_hero_image', 'about_secondary_image'];
        foreach ($fixedImageKeys as $imageKey) {
            if ($request->hasFile($imageKey)) {
                $file = $request->file($imageKey);
                $filename = $imageKey . '_' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('photo'), $filename);
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
                $filename = 'crew_' . time() . '_' . $index . '_' . $file->getClientOriginalName();
                $file->move(public_path('photo'), $filename);
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
            $filename = 'membership_' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('photo'), $filename);
            SiteSetting::setValue('membership_hero_image', 'photo/' . $filename, 'membership');
        }

        toastr()->success('Membership page content updated!', 'Success');
        return redirect()->route('settings.membership');
    }
}
