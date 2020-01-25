<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\MapProductSection;
use App\Model\MsSection;
use App\Model\TxnProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MasterSectionController extends Controller
{
    public function index()
    {
        $msections = MsSection::orderBy('id', 'DESC')->paginate(50);
        return view('backend.admin.sections.index', compact('msections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
        ],
            [
                'title.required' => 'Please Enter Section Title',
            ]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50|unique:ms_sections,SectionName',
        ],
            [
                'title.required' => 'Please Enter Section Title',
                'title.max' => 'Please Enter Section Title in Maximum 50 Character',
                'title.unique' => $request->title . ' Section Already Exists',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Add Section', $validator->errors()->first());
            return redirect(route('admin.sections.all'))->withInput();
        }

        MsSection::create([
            'SectionName' => $request->title,
            'status' => true,
        ]);

        connectify('success', 'Section Added', 'Section has been Added Successfully !');

        return redirect(route('admin.sections.all'));
    }

    public function assignPage($id)
    {
        try {

            $section = MsSection::where('id', $id)->firstOrFail();
            $products = TxnProduct::where('status', true)->get();
            $assignedProducts = MapProductSection::where('section_id', $id)->with('product')->get();
            return view('backend.admin.sections.assign', compact('products', 'section', 'assignedProducts'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Section Updated', 'Whoops, Section Not Found !');

                return redirect(route('admin.sections.all'));
            }

            Log::error(['Edit Section' => $ex->getMessage()]);

            connectify('error', 'Section Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.sections.all'));
        }
    }

    public function assign(Request $request, $id)
    {
        $request->validate([
            'assign' => 'required|array',
        ],
            [
                'assign.required' => 'Please Select Atleast One Product',
            ]);

        try {

            $section = MsSection::where('id', $id)->firstOrFail();

            \DB::table('map_product_sections')->where('section_id', $section->id)->delete();

            foreach ($request->assign as $asection) {
                MapProductSection::updateOrCreate(
                    [
                        'section_id' => $section->id,
                        'product_id' => $asection,
                    ]
                    , [
                        'section_id' => $section->id,
                        'product_id' => $asection,
                    ]);
            }

            connectify('success', 'Section Assigned', 'Products assign to ' . $section->SectionName . ' has been created successfully !');

            return redirect(route('admin.sections.all'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Section Assign', 'Whoops, Section Not Found !');

                return redirect(route('admin.sections.all'));
            }

            Log::error(['Assign Section' => $ex->getMessage()]);

            connectify('error', 'Section Assign', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.sections.all'));
        }
    }

    public function edit($id)
    {
        try {

            $section = MsSection::where('id', $id)->firstOrFail();
            return view('backend.admin.sections.edit', compact('section'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Section Edit', 'Whoops, Section Not Found !');

                return redirect(route('admin.sections.all'));
            }

            Log::error(['Edit Section' => $ex->getMessage()]);

            connectify('error', 'Section Edit', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.sections.all'));
        }
    }

    public function viewAssign($id)
    {
        try {

            $section = MsSection::where('id', $id)->firstOrFail();
            $assignedProducts = MapProductSection::where('section_id', $id)->with('product')->get();

            return view('backend.admin.sections.removeAssign', compact('section', 'assignedProducts'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Section View Assigned', 'Whoops, Section Not Found !');

                return redirect(route('admin.sections.all'));
            }

            Log::error(['View Assigned Section' => $ex->getMessage()]);

            connectify('error', 'Section View Assigned', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.sections.all'));
        }
    }

    public function removeAssign(Request $request, $id)
    {
        $request->validate([
            'assign' => 'required|array',
        ],
            [
                'assign.required' => 'Please Select Atleast One Product to Remove',
            ]);

        try {

            $section = MsSection::where('id', $id)->firstOrFail();

            foreach ($request->assign as $asection) {

                $map_assign = MapProductSection::where('id', $asection)->first();
                $map_assign->delete();

            }

            connectify('success', 'Removed Assign Product', 'Products Removed from ' . $section->SectionName . ' successfully !');

            return redirect(route('admin.sections.viewAssign', $section->id));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Section Updated', 'Whoops, Section Not Found !');

                return redirect(route('admin.sections.all'));
            }

            Log::error(['Edit Section' => $ex->getMessage()]);

            connectify('error', 'Section Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.sections.all'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:191',
        ],
            [
                'title.required' => 'Please Enter Section Title',
            ]);

        try {

            $section = MsSection::where('id', $id)->firstOrFail();
            $section->update([
                'SectionName' => $request->title,
                'status' => $request->status,
            ]);

            connectify('success', 'Section Updated', 'Section has been updated successfully !');

            return redirect(route('admin.sections.edit', $id));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Section Updated', 'Whoops, Section Not Found !');

                return redirect(route('admin.sections.all'));
            }

            Log::error(['Edit Section' => $ex->getMessage()]);

            connectify('error', 'Section Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.sections.all'));
        }
    }
}
