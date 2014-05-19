<?php

class UploadController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$currentUser = null;
		if(Auth::user()){
			$currentUser = Auth::user()->toArray();
		}
		return Response::json(array('files'=>Image::get()->toArray(), 'authUser' => $currentUser));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Grab our files input
		$files = Input::file('files');
    // We will store our uploads in public/uploads/basic
		$assetPath = '/uploads';
		$uploadPath = public_path($assetPath);
    // We need an empty arry for us to put the files back into
		$results = array();

		foreach ($files as $file) {

        // set our results to have our asset path
			$image = new Image;
			$name = $file->getClientOriginalName();

			$image->name = $name;
			$image->size = $file->getSize();
			$image->description = $name;
			// $image->url = $path;
			// $image->thumbnailUrl = $path;
			
			// gem i database for at kunne bruge id
			$image->save();

			$imageUrl = $assetPath . '/' . $image->id . '_' . $name;
			$thumbnailUrl = $assetPath . '/thumbnails/' . $image->id . '_' . $name;
			$thumbnailPath = $uploadPath . '/thumbnails/' . $image->id . '_' . $name;


			$image->url = $imageUrl;
			$image->thumbnailUrl = $thumbnailUrl;
			$image->save();

			ImageManipulation::make($file->getRealPath())->grab(150)->save($thumbnailPath);
			// $thumbnail->save($thumbnailPath);

			$file->move($uploadPath, $imageUrl);
		}

    // return all images as json
		return Response::json(array('files'=> array('0' => $image->toArray())));
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
    	$image = Image::find($id);

    	File::delete(public_path($image->url));
    	File::delete(public_path($image->thumbnailUrl));

        Image::destroy($id);

        return Response::json(array('success' => true));
    }
}
