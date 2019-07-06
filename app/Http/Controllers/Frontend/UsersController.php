<?php

namespace App\Http\Controllers\Frontend;
use App\Models\BankList;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $banklist = BankList::all();
        return view('frontend.user',compact('user','banklist'));
    }

    public  function donate()
    {
        return view('frontend.donate');
    }

    public function update(ProfileUpdate $request,$id)
    {
        if ($id = Auth::id())
        {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
//            $user->bank_id = $request->bank_id;
//            $user->bank_account_id = $request->bank_account_id;
//            $user->bank_account_name = $request->bank_account_name;
            $user->address = $request->address;
            if (!empty($request->password))
            {
                $user->password =  Hash::make($request->password);
            }
            $user->update();

            return redirect()->back()->with('Message', 'Hồ sơ đã cập nhật thành công!');

        }
        else {

            return redirect()->back()->with('Message', 'Có lỗi xảy ra!');
        }
    }

    
}
