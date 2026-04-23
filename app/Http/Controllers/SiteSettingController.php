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
            'about_values_1_title',
            'about_values_1_body',
            'about_values_2_title',
            'about_values_2_body',
            'about_values_3_title',
            'about_values_3_body',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                $value_en = $request->input($key . '_en');
                SiteSetting::setValue($key, $request->input($key), 'about', $value_en);
            }
        }

        $imageKeys = [
            'about_hero_image',
            'about_secondary_image',
            'about_team_image_1',
            'about_team_image_2',
            'about_team_image_3',
            'about_team_image_4',
            'about_team_image_5',
            'about_team_image_6',
        ];

        foreach ($imageKeys as $imageKey) {
            if ($request->hasFile($imageKey)) {
                $file = $request->file($imageKey);
                $filename = 'about_' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('photo'), $filename);
                SiteSetting::setValue($imageKey, 'photo/' . $filename, 'about');
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
