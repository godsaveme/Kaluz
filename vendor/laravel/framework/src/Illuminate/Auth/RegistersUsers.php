<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Salesfly\User;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    public function get_string_between($string, $start, $end){
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        //Auth::login($this->create($request->all()));
        $user = $this->create($request->except('image'));

        if($request->has('image') and substr($request->input('image'),5,5) === 'image'){
            $image = $request->input('image');
            $mime = $this->get_string_between($image,'/',';');
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
            Image::make($image)->resize(200,200)->save('images/users/'.$user->id.'.'.$mime);
            $user->image='/images/users/'.$user->id.'.'.$mime;
            $user->save();
        }

        //return redirect($this->redirectPath());
        return response()->json(['estado'=>true, 'nombres'=>$user->name]);
    }

    public function edit(Request $request)
    {
        $validator = $this->validatorEdit($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $user = $this->update(User::find($request->input('id')),$request->except('image'));

        if($request->has('image') and substr($request->input('image'),5,5) === 'image'){
            $image = $request->input('image');
            $mime = $this->get_string_between($image,'/',';');
            $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
            Image::make($image)->resize(200,200)->save('images/users/'.$user->id.'.'.$mime);
            $user->image='/images/users/'.$user->id.'.'.$mime;
            $user->save();
        }

        //return redirect($this->redirectPath());
        return response()->json(['estado'=>true, 'nombres'=>$user->name]);

    }

}
