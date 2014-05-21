<?php

class UploadController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(array('files'=>Image::get()->toArray()));
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
		$uploadedImages = array();
		foreach ($files as $file) {
			$image = new Image;
			$imgFile = ImageManipulation::make($file->getRealPath());
			$name = $file->getClientOriginalName();

			$image->name = $name;
			$image->description = $name;
			
			// save to the database to get id
			$image->save();

			$imageUrl = $assetPath . '/' . $image->id . '_' . $name;
			$imagePath = $uploadPath . '/' . $image->id . '_' . $name;
			$thumbnailUrl = $assetPath . '/thumbnails/' . $image->id . '_' . $name;
			$thumbnailPath = $uploadPath . '/thumbnails/' . $image->id . '_' . $name;
			//scale img if to big
			if($imgFile->height() > 1200){
				$imgFile->heighten(1200);
			}
			// save image file
			$imgFile->save($imagePath);
			//save image to db
			$image->size = filesize($imagePath); // get the new file size
			$image->url = $imageUrl;
			$image->thumbnailUrl = $thumbnailUrl;
			$image->save();
			//Create and save thumbnail
			$imgFile->fit(150)->save($thumbnailPath);
			array_push($uploadedImages, $image->toArray());
		}
    	// return all images as json
		return Response::json(array('files'=> $uploadedImages));
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
