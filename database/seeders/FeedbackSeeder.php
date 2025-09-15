<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample app info JSON
        $appInfo = json_encode([
            'appVersion' => '2.5.3',
            'buildNumber' => '253',
            'platform' => 'Android',
            'apiServer' => 'https://mpt-server.vercel.app/api/v2'
        ]);

        // Sample device info JSON based on provided example
        $deviceInfo1 = json_encode([
            'device' => 'TECNO-KL8',
            'androidSdk' => '34',
            'brand' => 'TECNO',
            'model' => 'TECNO KL8',
            'androidVersion' => '14',
            'deviceLocale' => 'en_US',
            'supportedABIs' => ['arm64-v8a', 'armeabi-v7a', 'armeabi'],
            'timezone' => '8:00:00.000000'
        ]);

        $platformInfo1 = json_encode([
            'platform' => 'Flutter',
            'channel' => 'stable',
            'version' => '3.7.12',
            'dart_sdk' => '3.0.6',
        ]);

        $platformInfo2 = json_encode([
            'platform' => 'React Native',
            'channel' => 'beta',
            'version' => '0.72.4',
            'js_engine' => 'Hermes',
        ]);

        $deviceInfo2 = json_encode([
            'device' => 'Redmi-Note10',
            'androidSdk' => '33',
            'brand' => 'Xiaomi',
            'model' => 'Redmi Note 10',
            'androidVersion' => '13',
            'deviceLocale' => 'ms_MY',
            'supportedABIs' => ['arm64-v8a', 'armeabi-v7a', 'armeabi'],
            'timezone' => '8:00:00.000000'
        ]);

        $additionalInfo1 = json_encode([
            'prayerAPI' => 'https://mpt-server.vercel.app/api/v2/solat/SWK08?year=2025&month=3',
            'accessGranted' => true,
            'notifications' => 'allowed',
            'userPreferences' => [
                'theme' => 'dark',
                'language' => 'malay'
            ]
        ]);

        $additionalInfo2 = json_encode([
            'prayerAPI' => 'https://mpt-server.vercel.app/api/v2/solat/SGR01?year=2023&month=5',
            'accessGranted' => true,
            'notifications' => 'allowed',
            'userPreferences' => [
                'theme' => 'light',
                'language' => 'english'
            ]
        ]);

        // Insert sample feedback records
        DB::table('feedbacks')->insert([
            [
                'name' => 'Muhammad Aiman',
                'public_id' => 'MPT-1DA2D',
                'email' => 'aiman.muhammad@example.com',
                'phone' => '60123456789',
                'subject' => 'Notification Issue',
                'message' => 'As Salam, Dh install dlm hp baru,setting semua dh granted,tetapi azan ada masa ada,kadang takde langsung, x taulaa kenapa..sblm ni pakai ke hp Redmi, lancar je, sejak beralih ke Tecno spark 30 5g ni..harap isu boleh di selesaikan',
                'app_info' => $appInfo,
                'device_info' => $deviceInfo1,
                'platform_info' => $platformInfo1,
                'additional_info' => $additionalInfo1,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3)
            ],
            [
                'name' => 'Nur Faizah',
                'public_id' => 'MPT-21504',
                'email' => 'faizah.nur@example.com',
                'phone' => '60198765432',
                'subject' => 'Feature Request',
                'message' => 'Assalamualaikum, mohon tambah fungsi widget untuk memaparkan waktu solat di home screen. Terima kasih.',
                'app_info' => $appInfo,
                'device_info' => $deviceInfo2,
                'platform_info' => $platformInfo2,
                'additional_info' => $additionalInfo2,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5)
            ],
            [
                'name' => 'Mohammad Hariz',
                'public_id' => 'MPT-30B19',
                'email' => 'hariz.m@example.com',
                'phone' => '60167894563',
                'subject' => 'App Crash',
                'message' => 'Salam, app selalu crash bila saya buka calendar view. Boleh tolong perbaiki? Terima kasih.',
                'app_info' => $appInfo,
                'device_info' => $deviceInfo2,
                'platform_info' => $platformInfo2,
                'additional_info' => $additionalInfo2,
                'created_at' => Carbon::now()->subWeeks(1),
                'updated_at' => Carbon::now()->subWeeks(1)
            ],
            [
                'name' => 'Sarah Abdullah',
                'public_id' => 'MPT-36F8C',
                'email' => 'sarah.a@example.com',
                'phone' => '60132589674',
                'subject' => 'Location Issue',
                'message' => 'App tidak boleh detect lokasi dengan tepat. Saya di Selangor tapi app tunjukkan waktu solat untuk Kedah.',
                'app_info' => $appInfo,
                'device_info' => $deviceInfo1,
                'platform_info' => $platformInfo1,
                'additional_info' => $additionalInfo1,
                'created_at' => Carbon::now()->subWeeks(2),
                'updated_at' => Carbon::now()->subWeeks(2)
            ],
            [
                'name' => 'Ismail Hamid',
                'public_id' => 'MPT-47740',
                'email' => 'ismail.h@example.com',
                'phone' => '60145678921',
                'subject' => 'Compliment',
                'message' => 'Alhamdulillah, terima kasih kerana mencipta app yang sangat membantu. Semoga Allah memberkati usaha anda.',
                'app_info' => $appInfo,
                'device_info' => $deviceInfo2,
                'platform_info' => null,
                'additional_info' => $additionalInfo2,
                'created_at' => Carbon::now()->subWeeks(3),
                'updated_at' => Carbon::now()->subWeeks(3)
            ],
        ]);
    }
}
