<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

use DB;
use QrCode;

class PdfController extends Controller
{
    //


    public function viewPDF()
    {
        $users = DB::table('users')->get();

        $image = base64_encode(file_get_contents(public_path('/assets/images/RELIA-ENERGY-Logo-2020 (1).png')));

        $pdf = PDF::loadView('pdftest', array('users' =>  $users, 'image' => $image))
        ->setPaper('a4', 'portrait');

        return $pdf->stream();

    }


    public function invoicepdf(Request $request){

        $invoices = DB::table('invoice')->where([['id', $request->invoice],['status', 'Unpaid']])->get();

        if($invoices[0]->invoicetype == "Sheet 1"){

            $invoicesheets = DB::table('invoicesheet1')->where('pvid', $invoices[0]->id)->get();

        }else if($invoices[0]->invoicetype == "Sheet 2"){

            $invoicesheets = DB::table('invoicesheet2')->where('pvid', $invoices[0]->id)->get();

        }else if($invoices[0]->invoicetype == "Sheet 3"){

            $invoicesheets = DB::table('invoicesheet3')->where('pvid', $invoices[0]->id)->get();

        }else if($invoices[0]->invoicetype == "Sheet 4"){

            $invoicesheets = DB::table('invoicesheet4')->where('pvid', $invoices[0]->id)->get();

        }


        $office = DB::table('companyinfo')->where('id', $invoices[0]->office)->get();

        $image = base64_encode(file_get_contents(public_path($office[0]->logo)));

        $pdf = PDF::loadView('pdf.invoice', array('invoices' =>  $invoices, 'image' => $image, 'vsheets' => $invoicesheets, 'office' => $office))
        ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }



    public function receiptpdf(Request $request){

        $invoices = DB::table('invoice')->where([['id', $request->invoice],['status', 'Paid']])->get();

        if($invoices[0]->invoicetype == "Sheet 1"){

            $invoicesheets = DB::table('invoicesheet1')->where('pvid', $invoices[0]->id)->get();

        }else if($invoices[0]->invoicetype == "Sheet 2"){

            $invoicesheets = DB::table('invoicesheet2')->where('pvid', $invoices[0]->id)->get();

        }else if($invoices[0]->invoicetype == "Sheet 3"){

            $invoicesheets = DB::table('invoicesheet3')->where('pvid', $invoices[0]->id)->get();

        }else if($invoices[0]->invoicetype == "Sheet 4"){

            $invoicesheets = DB::table('invoicesheet4')->where('pvid', $invoices[0]->id)->get();

        }

        $office = DB::table('companyinfo')->where('id', $invoices[0]->office)->get();

        $image = base64_encode(file_get_contents(public_path($office[0]->logo)));

        $pdf = PDF::loadView('pdf.receipt', array('invoices' =>  $invoices, 'image' => $image, 'vsheets' => $invoicesheets, 'office' => $office))
        ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }


    public function individualpayslippdf(Request $request){

        $recipient = DB::table('generalpayslip')->where('month', $request->month)->value('recipient');

        $payslips = DB::table('individualpayslip')->where([['staff', $request->staff], ['month', $request->month]])->get();

        $allowances = DB::table('monthallowances')->where([['staff', $request->staff], ['month', $request->month]])->get();

        $deductions = DB::table('monthdeduction')->where([['staff', $request->staff], ['month', $request->month]])->get();

        $bonuses = DB::table('bonuses')->where([['staff', $request->staff], ['month', $request->month]])->get();

        $staffdeductions = DB::table('deductions')->where([['staff', $request->staff], ['month', $request->month]])->get();

        $employerdeductions = DB::table('employerdeduction')->where([['staff', $request->staff], ['month', $request->month]])->value('amount');


        $office = DB::table('companyinfo')->limit(1)->get();

        $image = base64_encode(file_get_contents(public_path($office[0]->logo)));

        $pdf = PDF::loadView('pdf.individualpayslip', array('payslips' =>  $payslips, 'image' => $image, 'recipient' => $recipient, 'office' => $office, 'allowances' => $allowances, 'deductions' => $deductions, 'bonuses' => $bonuses, 'staffdeductions' => $staffdeductions, 'employerdeductions' => $employerdeductions))
        ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }



    public function generalpayslippdf(Request $request){

        $payrolls = DB::table('generalpayslip')->where('id', $request->id)->get();

        $payslips = DB::table('individualpayslip')->where('payid', $request->id)->get();

        $employerdeductions = DB::table('employerdeduction')->where('month', $payrolls[0]->month)->sum('amount');


        $office = DB::table('companyinfo')->limit(1)->get();

        $image = base64_encode(file_get_contents(public_path($office[0]->logo)));

        $pdf = PDF::loadView('pdf.generalpayslippdf', array('payslips' =>  $payslips, 'image' => $image, 'payrolls' => $payrolls, 'office' => $office, 'employerdeductions' => $employerdeductions))
        ->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
    

    

    public function qrcode(){

        return view('qrcode');
    }
}
