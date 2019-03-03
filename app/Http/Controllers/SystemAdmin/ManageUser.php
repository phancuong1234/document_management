<?php

namespace App\Http\Controllers\SystemAdmin;

use App\Models\DepartmentUser;
use App\Models\Position;
use App\Models\User;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ManageUser extends Controller
{
    public function index()
    {
        $user = User::all();
        $position = Position::pluck('name', 'id');
        $department = Department::pluck('name', 'id');

        return view('systemAdmin.users.index', compact('user', 'position', 'department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('systemAdmin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        User::create($input);
        $id = DB::table('users')->select('id')->where('email', $input['email'])->first();
        DB::table('department_users')->insert(['user_id' => $id->id, 'start_date' => Carbon::now(),'end_date' => $input['end_date']]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxdp(Request $request,$id_dp){
        $input = $request->all();
        DB::table('department_users')->where('user_id', $id_dp)->update(['department_id' => $input['depart']]);

        return redirect()->route('users.index');
    }

    public function ajaxps(Request $request,$id_dp){
        $input = $request->all();
        DB::table('department_users')->where('user_id', $id_dp)->update(['position_id' => $input['positions']]);

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        try
        {
            $user = User::findOrFail($id);

            return view('systemAdmin.users.edit', compact('user'));
        }
        catch (Exception $exception)
        {
            return redirect()->back()->with('msgFail', "loi nhap");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        User::find($id)->update($input);
        DB::table('department_users')->where('user_id', $id)->update(['start_date' => Carbon::now(),'end_date' => $input['end_date']]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $user = User::findOrFail($id);
            DepartmentUser::where('user_id',$user->id)->delete();
            $user->delete();

            return redirect()->route('users.index')->with('messageD', 'Xoa Thanh Cong');
        }
        catch (Exception $exception)
        {
            return redirect()->back()->with('messageD', 'Xoa That Bai');
        }
    }
}
