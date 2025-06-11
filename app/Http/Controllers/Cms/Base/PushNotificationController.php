<?php

namespace App\Http\Controllers\Cms\Base;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\OneSignalHelper;
use App\Models\UserPush;
use App\Models\PushInbox;
use Storage;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:push_notifications-create', ['only' => ['index', 'bulk_push', 'single_push']]);
    }

    public function page_info(){
        $page_info = [
            'title' => 'Push Notifications',
            'link' => 'push-notifications'
        ];
        return $page_info;
    }

    public function index()
    {
        $page_info = $this->page_info();

        // For Bulk Push
        $segments = [
            [
                'id' => 'Subscribed Users',
                'title' => 'Subscribed Users (All users that are subscribed to receive notifications)'
            ],
            [
                'id' => 'Active Users',
                'title' => 'Active Users (Last Session less than 168 hours ago)'
            ],
            [
                'id' => 'Inactive Users',
                'title' => 'Inactive Users (Last Session greater than 168 hours ago)'
            ],
            [
                'id' => 'Engaged Users',
                'title' => 'Engaged Users (Last frequent Session less than 168 hours ago)'
            ],
            [
                'id' => 'Test Segment',
                'title' => 'Test Segment'
            ]
        ];

        // For Targeted Push
        $users_push = [];
        $users_push_db = UserPush::has('Users')->get();
        foreach($users_push_db as $key => $user){
            $users_push[$key]['id'] = $user->user_id;
            $users_push[$key]['title'] = $user->Users->first_name . ' ' . $user->Users->last_name . ' - ' . $user->Users->email;
        }

        return view('cms.base.'.$page_info['link'].'.index', compact('page_info', 'segments', 'users_push'));
    }

    public function bulk_push(Request $request)
    {
        $page_info = $this->page_info();

        $this->validate($request, [
            'segments' => 'required',
            'bulk_subject' => 'required',
            'bulk_message' => 'required'
        ]);

        $return_success = [];
        $return_error = [];
        $player_ids = [];
        $included_segments = [];
        $data = [];
        $info = [];

        // Check if a file exist and is valid.
        $notification_image_path = '';
        if($request->hasFile('bulk_image')) {
            if($request->file('bulk_image')->isValid()) {

                $this->validate($request, [
                    'bulk_image' => 'required|mimes:png,jpg,jpeg|max:500'
                ]);

                $notification_image_path = FilesHelper::storeFile($page_info['link'], $request->bulk_image);
                $image_path = secure_asset($notification_image_path);

                /*
                * This image will be displayed in the notification
                */

                // Android
                $info['big_picture'] = $image_path;

                // iOS
                $media_id = 'id'.Str::random(5);
                $info['ios_attachments'] = [$media_id => $image_path];

                /*
                * At the same time, we will send the image in "data" in case
                * they want to display it int the application
                */

                list($width, $height, $type, $attr) = getimagesize($image_path);
                $data['image_width'] = $width;
                $data['image_height'] = $height;
                $data['image_url'] = $image_path;
            }
        }

        // Could be "All", "Active Users", "Inactive Users"
        $included_segments = [$request->segments];

        $headings = [
            "en" => trim(request()->bulk_subject)
        ];
        $contents = [
            "en" => trim(request()->bulk_message)
        ];

        $info['headings'] = $headings;
        $info['contents'] = $contents;
        $info['data'] = $data;
        $info['player_ids'] = $player_ids;
        $info['included_segments'] = $included_segments;

        $result = OneSignalHelper::oneSignal($info);

        if(!empty($result['error'])){
            $return_error = $result['error'];
        } else {
            $status = $result['status'];
            $message = $result['message'];
            $debugger = $result['debugger'];
            if($status == 'OK'){
                PushInbox::create([
                    'user_id' => null,
                    'subject' => trim(request()->bulk_subject),
                    'message' => trim(request()->bulk_message),
                    'image' => $notification_image_path,
                    'type' => 'bulk'
                ]);

                $return_success = $debugger;
            } else {
                if($status == 'OK_WITH_ERRORS'){
                    $return_success = $debugger;
                } else {
                    $return_error = $debugger;
                }
            }
        }

        if($return_success){
            return redirect()->back()->withSuccess($return_success);
        } elseif($return_error){
            return redirect()->back()->withError($return_error);
        }
    }

    public function single_push(Request $request)
    {
        $page_info = $this->page_info();

        $this->validate($request, [
            'users' => 'required|array',
            'single_subject' => 'required',
            'single_message' => 'required'
        ]);

        $return_success = [];
        $return_error = [];
        $player_ids = [];
        $data = [];
        $info = [];

        // Check if a file exist and is valid.
        $notification_image_path = '';
        if($request->hasFile('single_image')) {
            if($request->file('single_image')->isValid()) {

                $this->validate($request, [
                    'single_image' => 'required|mimes:png,jpg,jpeg|max:500'
                ]);

                $notification_image_path = FilesHelper::storeFile($page_info['link'], $request->single_image);
                $image_path = secure_asset($notification_image_path);

                /**
                 * this image will be displayed in the notification
                 */
                // Android
                $info['big_picture'] = $image_path;

                // iOS
                $media_id = 'id'.Str::random(5);
                $info['ios_attachments'] = [$media_id => $image_path];
                /**
                 * at the same time, we will send the image in "data" in case
                 * they want to display it int the application
                 */
                list($width, $height, $type, $attr) = getimagesize($image_path);
                $data['image_width'] = $width;
                $data['image_height'] = $height;
                $data['image_url'] = $image_path;
            }
        }

        // Set badge
        $info['ios_badgeType'] = 'Increase';
        $info['ios_badgeCount'] = '1';

        /**
         * Get Selected Player IDs
         */

        $users = UserPush::select('user_id', 'player_id')->whereIn('user_id', $request->users)->get();

        if(count($users) > 0) {
            foreach($users as $user){
                $player_ids[] = $user->player_id;
            }
        }

        if(empty($player_ids)){
            return redirect()->back()->withWarning('No Users Found');
        }

        $headings = [
            "en" => trim(request()->single_subject)
        ];
        $contents = [
            "en" => trim(request()->single_message)
        ];

        $info['headings'] = $headings;
        $info['contents'] = $contents;
        $info['data'] = $data;
        $info['player_ids'] = $player_ids;
        $info['filter'] = [];

        $result = OneSignalHelper::oneSignal($info);

        if(!empty($result['error'])){
            $return_error = $result['error'];
        } else {
            $status = $result['status'];
            $message = $result['message'];
            $debugger = $result['debugger'];
            if($status == 'OK'){
                foreach($users as $user){
                    PushInbox::create([
                        'user_id' => $user->user_id,
                        'subject' => trim(request()->single_subject),
                        'message' => trim(request()->single_message),
                        'image' => $notification_image_path,
                        'type' => 'single'
                    ]);
                }

                $return_success = $debugger;
            } else {
                if($status == 'OK_WITH_ERRORS'){
                    $return_success = $debugger;
                } else {
                    $return_error = $debugger;
                }
            }
        }

        if($return_success){
            return redirect()->back()->withSuccess($return_success);
        } elseif($return_error){
            return redirect()->back()->withSuccess($return_error);
        }
    }

}
