<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts/about');
        //return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function layoutAbout()
    {
        $site_contents = DB::select("SELECT * FROM site_contents WHERE id = 2");
        $data['site_contents']  = $site_contents[0];
        return view('layouts/about',$data);
    }
    public function layoutTermsAndConditions()
    {
        $site_contents = DB::select("SELECT * FROM site_contents WHERE id = 1");
        $data['site_contents']  = $site_contents[0];
        return view('layouts/terms-and-conditions',$data);
    }

    public function layoutclinicalpracticeguidelines()
    {
        $site_contents = DB::select("SELECT * FROM site_contents WHERE id = 1");
        $data['site_contents']  = $site_contents[0];
        return view('layouts/clinicalpracticeguidelines',$data);
    }

    public function faq()
    {
        $faqs = DB::select("SELECT * FROM faqs WHERE deleted_at is NULL");
        $data['faqs']  = $faqs;
        return view('layouts/faq',$data);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function layoutClinicalPracticeGuiddelines()
    {
        $site_contents = DB::select("SELECT * FROM site_contents WHERE id = 1");
        $data['site_contents']  = $site_contents[0];

        return view('layouts/clinicalpracticeguidelines',$data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function layoutSecurity()
    {
        return view('layouts/security');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function layoutPayment()
    {
        return view('layouts/payment');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generatePDF()
    {
        $data = [
            'foo' => 'bar'
        ];

        $pdf = PDF::loadView('welcome', $data);

        return $pdf->stream('document.pdf');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function algoTest()
    {
        // Code Here
        //use dd() for data dump

        echo "<pre>";
        print_r("algoTest");
        exit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postContact(Request $request)
    {
        $param_rules['name'] = 'required';
        $param_rules['email'] = 'required';

        $this->__is_redirect = true;
        $this->__view = 'contact';
        $response = $this->__validateRequestParams($request->all(), $param_rules);

        //Session::put('posting_data', $_POST);

        if ($this->__is_error == true) {
            Session::put('posting_data', $_POST);
            return $response;
        }

        $mail_params['USER_NAME'] = $request['name'];

        $mail_params['LOGO'] = '<img style="width: 120px;" src="' . URL::to("image/logo.png") . '">';
        //$mail_params['CONFIRMATION_LINK'] = env('APP_URL')."/user/registration/$hash";

        //$mail_params['USER_LINK'] = env('APP_URL').'/user/login';
        $mail_params['APP_NAME'] = env('APP_NAME');
        $mail_params['EMAIL'] = $request['email'];
        $mail_params['MESSAGE'] = $request['message'];
        // make forgot password url and implement its email configuration.
        $this->__sendMail('contact_email_admin', env("MAIL_FROM_EMAIL"), $mail_params);
        return Redirect::to('/contact?s');
    }
}
