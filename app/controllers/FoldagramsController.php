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
        
        
        $recipients_input = Input::get('add');
        
        if(!empty($recipients_input)){
            
            $recipients = array();
            
            foreach($recipients_input as $value){
                $recipient = new Recipient(array(
                    'fullname' => $value['fullname'],
                    'address_one' => $value['address_one'],
                ));
                
                $foldagram->recipients()->save($recipient);
            }
        }
        
        try{
            $qty = count(Input::get('add'));
            
            $item = array(
                'id'            => $foldagram->id,
                'quantity'      =>$qty,
                'price'         =>Config::get('foldagram.price'),
                'name'          =>'Foldagram'
            );
            
            //Add the item to the shopping cart
            Cart::insert($item);
            
            return Redirect::route('/')
                    ->with('success', "Your Foldagram Has Saved")
                    ->with('redirect', "preview");
        } catch (Exception $ex) {
            return Redirect::route('/')->with('error', $ex->getMessage());
        }
    }
}
