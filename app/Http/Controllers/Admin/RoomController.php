<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Admin\Admin;
use App\Admin\Post;
use Image;
use DB;
use Hash;
use View;
use App\User;
use App\Admin\Checkin;
use App\Admin\Checkout;
use App\Admin\RoomType;
class RoomController extends Controller
{
    public function checkinView()
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        $checkins = Checkin::with('roomType')->where('admin_id', $admin_id)->get();
        $typeofRooms = RoomType::get();
        Session::flash('page', 'checkin');
        return view('admin.room.view_checkin', compact('checkins', 'typeofRooms'));
    }

    public function addCheckin(Request $request)
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
       $data = request()->all();
        //    return $data;
       $rules = [
        'room_type_id' => 'required',
        'name' =>'required',
        // 'price' =>'required',
        // 'url' =>'required',

        ];

        $customMessages = [
        'room_type_id.required' => 'Please select room type required',
        'name.required' => 'Item name field is required',
        // 'price.required' => 'price field is required',
        // 'url.required' => 'Url field is required',

        ];
        $this->validate($request, $rules, $customMessages);

        if(empty($data['pax'])){
            $data['pax']='';
        }
        if(empty($data['travel_agent']))
        {
            $data['travel_agent'] = "";
        }
        if(empty($data['agent_name']))
        {
            $data['agent_name'] = "";
        }
        if(empty($data['room_type_id']))
        {
            $data['room_type_id'] = "";
        }
        if(empty($data['id_card'])){
            $data['id_card']='';
            $imagePath = "";
        }
        if($data['id_card']){
            $image_tmp = $data['id_card'];
            // dd($image_tmp);
            if($image_tmp->isValid())
            {
                // get extension
                $extension = $image_tmp->getClientOriginalExtension();
                // generate new image name
                $imageName = rand(111,99999).'.'.$extension;
                $imagePath = 'image/item'.$imageName;
                $result = Image::make($image_tmp)->resize(570,380)->save($imagePath);
                // dd($result);

            }
        }
        $item = new Checkin;
        $item->admin_id =  auth('admin')->user()->id;
        $item->name = $data['name'];
        $item->address = $data['address'];
        $item->contact = $data['contact'];
        $item->pax = $data['pax'];
        $item->room_type_id = $data['room_type_id'];
        $item->room_no = $data['room_no'];
        $item->travel_agent = $data['travel_agent'];
        $item->agent_name = $data['agent_name'];
        $item->additional_charge = $data['aditional_charge'];
        $item->discount = $data['discount'];
        $item->amount = $data['amount'];
        $item->advance = $data['advance'];
        $item->arrival_date = $data['arrival_date'];
        $item->arrival_time = $data['arrival_time'];
        $item->depature_time = $data['depature_time'];
        $item->depature_date = $data['depature_date'];
        $item->id_card = $imagePath;
        $item->save();
        return redirect()->back()->with('success_message', 'Checkin has been added successfully!');

    }
    public function editCheckin($id, Request $request)
    {
        if(auth('admin')->user()->parent_id > 0){
                $admin_id = auth('admin')->user()->parent_id;
            }else{
                $admin_id = auth('admin')->user()->id;
            }
        $data = request()->all();
        //    return $data;
        $rules = [
            'arrival_time' => 'required',
            'name' =>'required',
            // 'price' =>'required',
            // 'url' =>'required',

        ];

        $customMessages = [
            'arrival_time.required' => 'Arrival Time is required',
            'name.required' => 'Item name field is required',
            'price.required' => 'price field is required',
            'url.required' => 'Url field is required',

        ];
        // $this->validate($request, $rules, $customMessages);

        if(empty($data['description'])){
            $data['description']='';
        }
        if(empty($data['meta_title']))
        {
            $data['meta_title'] = "";
        }
        if(empty($data['meta_description']))
        {
            $data['meta_description'] = "";
        }
        if(empty($data['meta_keywords']))
        {
            $data['meta_keywords'] = "";
        }
        if(empty($data['id_card']) && !empty($data['old_image'])){
            $imagePath = $data['old_image'];
        }
        if(empty($data['old_image']))
        {
            $imagePath = '';

        }
        if(!empty($data['id_card'])){
            $image_tmp = $data['id_card'];
            // dd($image_tmp);
            if($image_tmp->isValid())
            {
                // get extension
                $extension = $image_tmp->getClientOriginalExtension();
                // generate new image name
                $imageName = rand(111,99999).'.'.$extension;
                $imagePath = 'image/item'.$imageName;
                $result = Image::make($image_tmp)->resize(570,380)->save($imagePath);
                // dd($result);

            }
        }
        $item =  Checkin::find($id);
        $item->admin_id =  auth('admin')->user()->id;
        $item->name = $data['name'];
        $item->address = $data['address'];
        $item->contact = $data['contact'];
        $item->pax = $data['pax'];
        $item->room_type_id = $data['room_type_id'];
        $item->room_no = $data['room_no'];
        $item->travel_agent = $data['travel_agent'];
        $item->agent_name = $data['agent_name'];
        $item->additional_charge = $data['aditional_charge'];
        $item->discount = $data['discount'];
        $item->amount = $data['amount'];
        $item->advance = $data['advance'];
        $item->arrival_date = $data['arrival_date'];
        $item->arrival_time = $data['arrival_time'];
        $item->depature_time = $data['depature_time'];
        $item->depature_date = $data['depature_date'];
        $item->id_card = $imagePath;
        $item->save();
        return redirect()->back()->with('success_message', 'Checkin has been added successfully!');

    }


    public function checkoutView()
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        $typeofRooms = RoomType::get();

        $checkouts = Checkin::where('admin_id', $admin_id)->get();
        Session::flash('page', 'checkout');
        return view('admin.room.view_checkout', compact('checkouts', 'typeofRooms'));
    }

    public function roomDetail($id)
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        $admins = Admin::find($admin_id);
        $checkinDetails = Checkin::where('id', $id)->first();
        Session::flash('page', 'checkout');
        return view('admin.room.checkout_innovice', compact('checkinDetails','admins'));
    }

    public function checkoutUserBill($id)
    {
        $data = request()->all();
        // return $data;
        $item =  Checkin::find($id);
        $item->depature_date =  $data['depature_date'];
        $item->depature_time = $data['depature_time'];
        $item->amount = $data['amount'];
        $item->additional_charge = $data['additional_charge'];
        $item->advance = $data['advance'];
        $item->discount = $data['discount'];
        $item->save();
        return redirect()->back()->with('success_message', 'Checkout has been added successfully!');
    
    }
    public function bill($id)
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        $admins = Admin::find($admin_id);
        $checkinDetails = Checkin::where('id', $id)->first();
        Session::flash('page', 'checkout');
        return view('admin.room.bill_print_checkout', compact('checkinDetails','admins'));
    }
}
