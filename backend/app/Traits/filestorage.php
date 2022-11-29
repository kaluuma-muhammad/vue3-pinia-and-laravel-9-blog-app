<?php
namespace App\Traits;
use Image;

trait filestorage
{
	public function storeimage( $image,  $destinationPath, $fileName ) {
        if($image){
            $pathstored = public_path($destinationPath);
            $image->move($pathstored, $fileName );
            $filePath = $pathstored.$fileName;
        }else{
        	flash('Invalid Image File!')->error()->important();
            return redirect()->back()->withInput();
        }
        return null;
    }
}
