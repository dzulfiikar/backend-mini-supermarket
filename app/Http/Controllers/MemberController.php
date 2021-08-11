<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberStoreRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Models\Member;
use Exception;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Member::all(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberStoreRequest $request)
    {
        $request_data = $request->validated();
        try {
            $member = Member::create($request_data);
            return response()->json([
                'status' => 'success',
                'data' => $member
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'data' => []
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return response()->json([
            'status' => 'success',
            'data' => $member
        ], 200);
    }

    public function showAvailableVouchers(Member $member){
        return response()->json([
            'status '=> 'success',
            'data' => Member::getAvailableVouchers($member)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MemberUpdateRequest $request, Member $member)
    {
        $update_data = $request->validated();
        try {
            $member->member_name = $update_data['member_name'];
            $member->member_address = $update_data['member_address'];
            $member->member_phone = $update_data['member_phone'];
            $member->save();
            return response()->json([
                'status' => 'success',
                'data' => $member
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'data' => []
            ], 400);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        try {
            $member->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Member has been deleted',
                'data' => []
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'data' => []
            ], 400);
        }
    }
}
