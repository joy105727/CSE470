<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Booking;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->role;
            if ($this->role != 'customer') {
                Auth::logout();
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $data = DB::table('cars')->where('sts','active')->get();
        return view('customer.dashboard', ['data'=>$data]);
    }

    public function bookings()
    {
        $data = DB::table('bookings')->join('cars','bookings.carid','=','cars.carid')->where('cid',Auth()->user()->id)->get();
        return view('customer.bookings', ['data'=>$data]);
    }

    public function bookcar(Request $request)
    {
        try
        {
            $check = DB::table('bookings')->where(['carid'=>$request->carid, 'cid'=>Auth()->user()->id, 'status'=>'pending'])->count();
            if($check < 1)
            {
                $book = new Booking;
                $book->carid = $request->carid;
                $book->cid = Auth()->user()->id;
                $book->bookdate = $request->bookdate;
                $book->pickup = $request->pickup;
                $book->destination = $request->destination;
                $book->starttime = $request->starttime;
                $book->endtime = $request->endtime;
                $book->mobile = $request->mobile;
                $book->save();
                return redirect(route('customer_bookings'))->with('success', 'Car Booked Successfully');
            }
            else
            {
                return redirect(route('customer_bookings'))->with('failed', 'Car Already Booked');
            }
        }
        catch(Exception $e)
        {
            return redirect(route('customer_dashboard'))->with('failed', 'Operation Error !!');
        }
    }

    public function deletebooking(Request $request)
    {
        try
        {
            DB::table('bookings')->where(['bookid'=>$request->bookid, 'cid'=>Auth()->user()->id])->delete();
            return redirect(route('customer_bookings'))->with('success', 'Booking Deleted Successfully');

        }
        catch(Exception $e)
        {
            return redirect(route('customer_dashboard'))->with('failed', 'Operation Error !!');
        }
    }

    public function acceptfare(Request $request)
    {
        try
        {
            DB::table('bookings')->where('bookid', $request->bookid)->update(['status'=>'accepted', 'response'=>'Accepted']);
            return redirect(route('customer_bookings'))->with('success', 'Car Booked Successfully');

        }
        catch(Exception $e)
        {
            return redirect(route('customer_dashboard'))->with('failed', 'Operation Error !!');
        }
    }
}
