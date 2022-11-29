<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

//Traits
use App\Traits\Validatormsgs;
use App\Traits\filestorage;
use App\Traits\returnmessages;

//Models
use App\Models\Blog;

class BlogsController extends Controller
{
    use Validatormsgs, filestorage, returnmessages;

    public function search_blog(Request $request){
        $messages =  $this->valmsgs();
        $validator = Validator::make($request->all(), [
            'search' => 'required|max:255',
        ], $messages);

        if($validator->fails()){
            return response()->json([
                'msg'=> $validator->errors(),
                'status' => 400
            ], 400);
        }else{
            $searchdata = $request->search;
            $data = Blog::where('title', 'like', '%' .$searchdata. '%')->paginate();
            $msg = "Blog data fetched Successfully";
            return $this->returnsuccess($data, $msg);
        }
    }

    public function create_blog(Request $request){
        $messages =  $this->valmsgs();
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'meta' => ['required'],
            'caption' => ['required'],
            'image' => ['required'],
            'details' => ['required'],
        ], $messages);

        if($validator->fails()){
            return response()->json([
                'msg'=> $validator->errors(),
                'status' => 400
            ], 400);
        }else{
            $data = new Blog;
            return $this->save_blog($request, $data);
        }
    }

    public function update_blog(Request $request, $id){
        $messages =  $this->valmsgs();
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'meta' => ['required'],
            'caption' => ['required'],
            'details' => ['required'],
        ], $messages);

        if($validator->fails()){
            return response()->json([
                'msg'=> $validator->errors(),
                'status' => 400
            ], 400);
        }else{
            $data = Blog::find($id);
            if($data){
                return $this->save_blog($request, $data);
            }else{
                $msg = "We did not find the blog your requesting";
               return $this->returnerrormsg($msg);  
            }   
        }
    }

    public function save_blog($request, $data){
        $data->user_id =  Auth::user()->id;
        $data->title = $request->title;
        $data->meta = $request->meta;
        $data->caption = $request->caption;
        $data->details = $request->details;
        $image = $request->image;
        if($image){
            $fileName = time() . '.'.$image->getClientOriginalExtension();
            $destinationPathweb = '/uploads/blogs/';
            $destinationPath = $destinationPathweb;
            $path = $this->storeimage($image, $destinationPath, $fileName);
            $pathsave = $destinationPathweb .$fileName;
            $data->image_url = env('APP_URL').$pathsave;
            $data->image = $fileName;
        }
        $data->save();
        
        if($data->save()){
            return $this->blogs();
        }else{
            $msg ="The Action got issues during Execution";
            return $this->returnerrormsg($msg);
        }
    }

    public function blogs(){
        $data = Blog::with(['user'])->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        if($data){
            $msg = "Blogs data fetched Successfully";
            return $this->returnsuccess($data, $msg);
        }else{
            $msg = "Blogs data Empty";
            return $this->returnerrormsg($msg);
        }
    }

    public function blog_details($id){
        $data = Blog::with(['user'])->find($id);

        if($data){
            $msg = "Blogs data fetched Successfully";
            return $this->returnsuccess($data, $msg);
        }else{
            $msg = "Blogs data Empty";
            return $this->returnerrormsg($msg);
        }
    }

    public function update_image(Request $request, $id){
        $messages =  $this->valmsgs();
        $validator = Validator::make($request->all(), [
            'image' => 'required',
        ], $messages);


        if($validator->fails()){
             return response()->json([
                'msg'=> $validator->errors(),
                'status' => 400
            ], 400);
        }else{
            $data = Blog::find($id);
            if($data){
                $image = $request->image;
                if($image){
                    $fileName = time() . '.'.$image->getClientOriginalExtension();
                    $destinationPathweb = '/uploads/blogs/';
                    $destinationPath = $destinationPathweb;
                    $path = $this->storeimage($image, $destinationPath, $fileName);
                    $pathsave = $destinationPathweb .$fileName;
                    $data->image_url = env('APP_URL').$pathsave;
                    $data->image = $fileName;
                }
                $data->save();

                if($data->save()){
                    return $this->blog_details($id);
                }else{
                    $msg = "Blog data Error";
                    return $this->returnerrormsg($msg);
                }
            }else{
                $msg = "Blog data Empty";
                return $this->returnerrormsg($msg);
            }
        }
    }

    public function change_status($id){
        $data = Blog::find($id);
        if($data){
            if($data->status == 1) {
                $data->status = 2;
                $data->save();
                return $this->blogs();
            }else{
                $data->status = 1;
                $data->save();
                return $this->blogs();
            } 
        }else{
            $msg = "Blogs data Empty";
            return $this->returnerrormsg($msg);
        }
    }

    public function delete_blog($id){
        $data = Blog::find($id);
        if($data){
            $data->delete();
            return $this->blogs();
        }else{
            $msg = "Blogs data Empty";
            return $this->returnerrormsg($msg);
        }
    }
}
