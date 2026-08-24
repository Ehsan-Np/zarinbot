<?php

namespace App\Http\Controllers;

use App\Models\WhatsAppGroupContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WhatsAppGroupScraperController extends Controller
{
    /**
     * استخراج اعضای گروه‌ها/کانال‌های واتساپ و ذخیره با ردگیری صریح کاربر استخراج‌کننده
     */
    public function scrapeAndStore(Request $request): JsonResponse
    {
        $request->validate([
            'group_or_channel_name' => 'required|string',
            'contacts' => 'required|array',
            'contacts.*.member_phone_number' => 'required|string',
        ]);

        $extractedByUserId = $request->input('user_id', 1);
        $extractedByFullName = $request->input('user_full_name', 'احسان نادری پناه');
        $extractedByPhone = $request->input('user_phone_number', '09024561001');
        $groupName = $request->input('group_or_channel_name');

        $storedContacts = [];
        foreach ($request->input('contacts') as $c) {
            $contact = WhatsAppGroupContact::create([
                'extracted_by_user_id' => $extractedByUserId,
                'extracted_by_full_name' => $extractedByFullName,
                'extracted_by_phone_number' => $extractedByPhone,
                'group_or_channel_name' => $groupName,
                'group_or_channel_id' => 'group_' . md5($groupName),
                'member_phone_number' => $c['member_phone_number'],
                'member_full_name' => $c['member_full_name'] ?? 'مخاطب واتساپ',
            ]);
            $storedContacts[] = $contact;
        }

        return response()->json([
            'status' => 'success',
            'message' => count($storedContacts) . ' مخاطب با موفقیت استخراج و در بانک متمرکز سوپر ادمین همگام گردید.',
            'data' => [
                'extracted_count' => count($storedContacts),
                'extracted_by' => [
                    'full_name' => $extractedByFullName,
                    'phone_number' => $extractedByPhone
                ]
            ]
        ]);
    }

    /**
     * مشاهده لیست مخاطبین گروه‌ها در پنل متمرکز سوپر ادمین
     */
    public function getMasterDirectory(): JsonResponse
    {
        $contacts = WhatsAppGroupContact::orderBy('id', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'count' => $contacts->count(),
            'data' => $contacts
        ]);
    }
}
