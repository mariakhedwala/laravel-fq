<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\JobTitle;
use App\Country;
use App\City;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $users = $user->getUsers();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user, JobTitle $job_title, Country $country, City $city)
    {
        $job_titles = $job_title->getJobs();
        $cities = $city->getCities();
        $countries = $country->getCountries();
        return view('user.create', compact('user', 'job_titles', 'countries', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required','max:255'],
                'email' => ['required','email'],
                'job_title' => ['nullable', 'string'],
                'city' => ['nullable', 'string'],
                'country' => ['nullable', 'string'],
                'password' => ['required', 'confirmed', 'min:4', 'max:10'],
                'password_confirmation' => ['required', 'min:4'],
            ]);
            
            if ($validated) {
                $createUser = new User;
                $createUser = $createUser->createUsers($validated);
                
                if ($createUser) {
                    $request->session()->flash('success', 'Contact created');
                    return redirect('users');
                }else {
                    $request->session()->flash('danger', 'Contact creation failed');
                    return redirect('users.create');
                }
            } else {
                return redirect()->route('users.create')->with('error');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return redirect()->back()->withErrors(['email' => 'Email ID already exist']);
            } else {
                return redirect()->back()->with('error');
            }
        } catch(Exception $e) {
            return redirect()->back()->with('error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, JobTitle $job_title, Country $country, City $city)
    {
        $job_titles = $job_title->getJobs();
        $cities = $city->getCities();
        $countries = $country->getCountries();
        return view('user.create', compact('user', 'job_titles', 'countries', 'cities'));
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
        $id = (int) $id;
        try {
            $validated = $request->validate([
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email', "unique:users,email,$id"],
                'job_title' => ['nullable', 'string'],
                'city' => ['nullable', 'string'],
                'country' => ['nullable', 'string'],
                'password' => ['nullable', 'confirmed', 'min:4', 'max:8'],
                'password_confirmation' => ['nullable', 'min:4'],
            ]);

            $user = User::findOrFail($id);
            $newPassword = $request->get('password');
            
            if ($validated) {
                if (empty($newPassword)) {
                    $updateUser = $user->update($request->except('password'));
                } else {
                    $updateUser = $user->editUser($validated);
                }

                if ($updateUser == true) {
                    $request->session()->flash('success', 'Contact updated');
                    return redirect('users');
                } else {
                    $request->session()->flash('danger', 'Contact update failed');
                    return redirect('users');
                }
            } else {
                return redirect()->route('users.create')->with('error');
            }
            return redirect('users');

        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return redirect()->back()->withErrors(['email' => 'Email ID already exist']);
            } else {
                return redirect()->back()->with('error');
            }   
        } catch (Exception $e) {
            return redirect()->back()->with('error');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $delete = $user->delete();

        if ($delete) {
            $request->session()->flash('success', 'Contact deleted');
            return redirect('users');
        } else {
            $request->session()->flash('danger', 'Contact delete failed');
            return redirect('users');
        }

        return redirect('users');
    }
}
