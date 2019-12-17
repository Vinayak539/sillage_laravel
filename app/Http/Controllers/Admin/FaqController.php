<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('id', 'DESC')->paginate(50);
        return view('backend.admin.faqs.index', compact('faqs'));
    }
    
    public function manage()
    {
        $faqs = Faq::orderBy('id', 'ASC')->paginate(10);
        return view('frontend.faq', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer'   => 'required|string',
        ],
            [
                'question.required' => 'Please Enter Question',
                'answer.required'   => 'Please Enter Answer',
            ]);

        Faq::create([
            'question' => $request->question,
            'answer'   => $request->answer,
            'status'   => true,
        ]);

        return redirect(route('admin.faqs.all'))->with('messageSuccess', 'Faq has been added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $faq = Faq::where('id', $id)->firstOrFail();
            return view('backend.admin.faqs.edit', compact('faq'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.faqs.all'))->with('messageDanger', 'Whoops, Faq Not Found with id : ' . $id);
            }
            return redirect(route('admin.faqs.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'answer'   => 'required|string',
            'status'   => 'required|string|max:191',
        ],
            [
                'question.required' => 'Please Enter Question',
                'answer.required'   => 'Please Enter Answer',
                'status.required'   => 'Please Select Status',
            ]);
        try {

            $faq = Faq::where('id', $id)->firstOrFail();

            $faq->update([
                'question' => $request->question,
                'answer'   => $request->answer,
                'status'   => $request->status,
            ]);

            return redirect(route('admin.faqs.edit', $id))->with('messageSuccess', 'Faq has been Updated Successfully !');

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.faqs.all'))->with('messageDanger', 'Whoops, Faq Not Found with id : ' . $id);
            }
            return redirect(route('admin.faqs.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $faq = Faq::where('id', $id)->firstOrFail();

            $faq->delete();

            return redirect(route('admin.faqs.all'))->with('messageSuccess', 'Faq has been deleted Successfully !');

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.faqs.all'))->with('messageDanger', 'Whoops, Faq Not Found with id : ' . $id);
            }
            return redirect(route('admin.faqs.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }
}
