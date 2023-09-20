<?php

namespace App\Http\Controllers\Api;

use App\BloodType;
use App\Governorate;
use App\Client;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function notifications(Request $request)
    {
        $notifications = $request->user()->notifications()->paginate(10);
        return $notifications;
    }

    public function viewNotificationsSettings(Request $Request) 
    {
         $notifyText     = Setting::get('notification_text');
         $bloodTypes     = BloodType::all();
         $governorates   = Governorate::all();
         $client = $Request->user();
         $clientBloodTypes   = $client->bloodTypesNotify()->pluck('blood_types.id');
         $clientGovernorates = $client->governoratesNotify()->pluck('governorates.id');

         return response()->json([
                'notification_text' => $notifyText,
                'blood_types' => $bloodTypes,
                'client_blood_types' => $clientBloodTypes,
                'governorates' => $governorates,
                'client_governorates' => $clientGovernorates
            ]);
    }

    public function updateNotificationsSettings(Request $Request) 
    {
        $client = $Request->user();
        $client->bloodTypesNotify()->sync($Request->bloodValues);
        $client->governoratesNotify()->sync($Request->governorateValues);
        return response()->json('Done updating your data!');
    }

}
