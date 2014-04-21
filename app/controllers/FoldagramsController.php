<?php

class FoldagramsController extends BaseController{
    public function postCreate() {
        $foldagram = new Foldagram;        
        $foldagram->message = Input::get('message');
        $foldagram->save();
        
        if(Input::hasFile('image')){
            $image = Input::file('image');
            $filename = $foldagram->id.
                "_".
                str_random(8).
                ".".
                $image->getClientOriginalExtension()
            ;

            $destinationPath = 'img/uploads';
            $thumbnailPath = 'img/thumbnails/'.$filename;

            Input::file('image')->move($destinationPath, $filename);

            Image::make($destinationPath.'/'.$filename)
                ->resize(10, 100)
                ->save($thumbnailPath);

            $foldagram->image = $filename;
            $foldagram->save();
        }
        
        
        
        return Redirect::to(URL::route('/'));
    }
}
