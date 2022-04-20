<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Car;
use App\Booking;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            if ($this->role != 'admin') {
                Auth::logout();
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function addcar()
    {
        $data = DB::table('cars')->get();
        return view('admin.addcar', ['data'=>$data]);
    }

    public function details()
    {
        $data = DB::table('bookings')->join('cars','bookings.carid','=','cars.carid')->get();
        return view('admin.details', ['data'=>$data]);
    }

    public function savecar(Request $request)
    {
        try
        {
            //dd($request->input());
            $filename = "";
            $staticname = date('Ydmihs')."__";
            $file = $request->file('carimage');
            if($file){
                $filename = $staticname.$file->getClientOriginalName();
            }

            $destinationPath = 'media/cars';

            $car = new Car;
            $car->vehicletype = $request->vehicletype;
            $car->carname = $request->carname;
            $car->carno = $request->carno;
            $car->seat = $request->seat;
            $car->mobile = $request->mobile;
            $car->carimage = $filename;
            $car->save();

            if($file){
                $file->move($destinationPath,$filename);
            }

            return redirect(route('admin_addcar'))->with('success', 'Car Addedd Successfully');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_addcar'))->with('failed', 'Operation Error !!');
        }
    }

    public function offerfare(Request $request)
    {
        try
        {
            //dd($request->input());
            DB::table('bookings')->where('bookid', $request->bookid)->update([
                'offer'=>$request->offer
            ]);
            return redirect(route('admin_details'))->with('success', 'Offer Addedd Successfully');
        }
        catch(Exception $e)
        {
            dd($e);
            return redirect(route('admin_details'))->with('failed', 'Operation Error !!');
        }
    }

    public function editcar(Request $request)
    {
        try
        {
            //dd($request->input());
            DB::table('cars')->where('carid', $request->carid)->update([
                'vehicletype'=>$request->vehicletype,
                'carname'=>$request->carname,
                'seat'=>$request->seat,
                'mobile'=>$request->mobile
            ]);
            return redirect(route('admin_addcar'))->with('success', 'Car Edited Successfully');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_addcar'))->with('failed', 'Operation Error !!');
        }
    }

    public function deletecar(Request $request)
    {
        try
        {
            //dd($request->input());
            DB::table('cars')->where('carid', $request->carid)->delete();
            DB::table('bookings')->where('carid', $request->carid)->delete();
            return redirect(route('admin_addcar'))->with('success', 'Car Deleted Successfully');
        }
        catch(Exception $e)
        {
            dd($e);
            return redirect(route('admin_addcar'))->with('failed', 'Operation Error !!');
        }
    }

    public function notavailable(Request $request)
    {
        try
        {
            //dd($request->input());
            DB::table('bookings')->where('bookid', $request->bookid)->update(['status'=>'rejected', 'response'=>'Not Available']);
            return redirect(route('admin_details'))->with('success', 'Booking Rejected Successfully');
        }
        catch(Exception $e)
        {
            return redirect(route('admin_details'))->with('failed', 'Operation Error !!');
        }
    }


}
