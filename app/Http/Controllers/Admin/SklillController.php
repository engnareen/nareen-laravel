<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use DataTables;


class SklillController extends Controller
{
    public function index()
    {
        return view('skills.skills-list');
    }

    public function addSkill(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:skills',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $skill = new Skill();
            $skill->name = $request->name;
            $skill->range = $request->range;
            $query = $skill->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'New Skill has been successfully saved']);
            }
        }
    }

    // GET ALL SKILLS
    public function getSkillsList(Request $request)
    {
        $skills = Skill::all();
        return DataTables::of($skills)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                    <button style="margin-right: 10px" class="btn btn-sm btn-info" data-id="' . $row['id'] . '" id="editSkillBtn">Edit</button>
                    <button class="btn btn-sm btn-danger" data-id="' . $row['id'] . '" id="deleteSkillBtn">Delete</button>
            </div>';
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" name="skill_checkbox" data-id="' . $row['id'] . '"><label></label>';
            })

            ->rawColumns(['actions', 'checkbox'])
            ->make(true);
    }

    //GET Skills DETAILS
    public function getSkillsDetails(Request $request)
    {
        $skill_id = $request->skill_id;
        $skillDetails = Skill::find($skill_id);
        return response()->json(['details' => $skillDetails]);
    }

     //UPDATE SKILLS DETAILS
    public function updateSkillDetails(Request $request)
    {
        $skill_id = $request->cid;

        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:skills,name,' . $skill_id,

        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $skill = Skill::find($skill_id);
            $skill->name = $request->name;
            $skill->range = $request->range;
            $query = $skill->save();

            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Skill Details have been updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    // DELETE Skill RECORD
    public function deleteSkill(Request $request)
    {
        $skill_id = $request->skill_id;
        $query = Skill::find($skill_id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Skill has been deleted from database']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }


    public function deleteSelectedSkills(Request $request)
    {
        $skill_ids = $request->skill_ids;
        Skill::whereIn('id', $skill_ids)->delete();
        return response()->json(['code' => 1, 'msg' => 'Skills have been deleted from database']);
    }

}
