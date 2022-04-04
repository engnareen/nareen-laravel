<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Event;
use App\Models\Feature;
use App\Models\Gallary;
use App\Models\Plan;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Team;
use App\Models\User;
use App\Models\Work;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewClientNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class FrontController extends Controller
{
    public function index(){
        $articles = Article::take(8)->orderBy('created_at','desc')->get();
        $teams = Team::take(6)->orderBy('created_at','desc')->get();
        $services = Service::take(6)->orderBy('created_at','desc')->get();
        // $gallaries = Gallary::take(6)->orderBy('id','desc')->get();
        $gallaries = Gallary::take(6)->inRandomOrder()->get();
        $skills = Skill::take(5)->orderBy('created_at','desc')->get();
        $features = Feature::take(3)->orderBy('created_at','desc')->get();
        $plans = Plan::with('tags')->take(3)->orderBy('created_at','desc')->get();
        $works = Work::take(3)->orderBy('created_at','desc')->get();


        $events = Event::take(1)->orderBy('created_at','desc')->get();

        $getDate = Event::take(1)->orderBy('created_at','desc')->first();
        $date = $getDate->date;
        //$time = $getDate->time;

        //$dhms= Carbon::createFromFormat('H:i:s', $time); // this is the true
        $dhms= Carbon::createFromFormat('Y-m-d H:i:s', now()); // this is the true




        $start_time = \Carbon\Carbon::parse(now());
        $finish_time = \Carbon\Carbon::parse($date);

        $days = $start_time->diffInDays($finish_time, false);
        $hours = $start_time->diffInHours($finish_time,false);
        $minutes = $start_time->diffInMinutes($finish_time, false);
        $seconds = $start_time->diffInSeconds($finish_time, false);

        // $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', now());
        // $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', '2022-04-03 09:27:23');
        // $diff_in_hours = $to->diffInHours($from);


        // $end = Carbon::parse($events->get('created_at'));
        // $current = Carbon::now();
        // $length = $end->diffInDays($current);
        // //dd($length);




        return view('front.index', [
            'articles' => $articles,
            'teams' => $teams,
            'services' => $services,
            'gallaries' => $gallaries,
            'skills' => $skills,
            'events' => $events,
            'features' => $features,
            'works' => $works,
            'plans' => $plans,
            'days' => $days,
            'hours' => $hours,
            'minutes' => $minutes,
            'seconds' => $seconds,
            'dhms' => $dhms,
            // 'diff_in_hours' => $diff_in_hours,
            // 'length' => $length,
            // 'end' => $end,

        ]);
    }

    public function getArticles(){
        $articles = Article::take(8)->orderBy('created_at','desc')->get();
        return view('front.article', [
            'articles' => $articles
        ]);
    }

    public function getGalleries(){
        $galeries = Gallary::take(6)->orderBy('created_at','desc')->get();
        return view('front.gallery', [
            'galeries' => $galeries
        ]);
    }

    public function getTeams(){
        $teams = Team::take(6)->orderBy('created_at','asc')->get();

        return view('front.team', [
            'teams' => $teams
        ]);
    }

    public function discountForm()
    {
        return view('front.discountForm');
    }
    public function storeDiscountForm(Request $request){

            $valdiation = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email:filter',
                'mobile'=> 'nullable',
                'Details' => 'required',
            ]);
            if($valdiation->fails()) {
                return response()->json(['code' => '400', 'msg' => $valdiation->errors()->first()]);
            }


            $user = Auth::user();
            $clientDiscount = Client::create($request->all());
            // Send Notifiaction
            $user->notify(new NewClientNotification($clientDiscount));
            // If i want to send mail to all users or admin do as below
            $admins = User::all();

            return response()->json(['code' => 200, 'msg' => 'Thanks for contacting us, we will get back to you soon.']);

        }

        public function team(){

        }
        public function service(){

        }
    }

