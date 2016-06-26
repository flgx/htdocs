<?php


class ContactController extends \BaseController {

public function getContactUsForm(){

        //Get all the data and store it inside Store Variable
        $data = Input::all();

        //Validation rules
        $rules = array (
            'nombre' => 'required', 
            'email' => 'required|email', 
            'mensaje' => 'required|min:5'
        );

        //Validate data
        $validator = Validator::make ($data, $rules);

        //If everything is correct than run passes.
        if ($validator -> passes()){

           Mail::send('emails.template', array('nombre'=>Input::get('nombre'),'email'=>Input::get('email'),'mensajex'=>Input::get('mensaje')), function($mensaje) use ($data)
            {
                //$message->from($data['email'] , $data['first_name']); uncomment if using first name and email fields 
                $mensaje->from(Input::get('email'), 'Mensaje desde Naturaleza.com.ar');
				//email 'To' field: cahnge this to emails that you want to be notified.                    
				$mensaje->to('test@ecoturismo.com.ar', 'Fran')->subject('Naturaleza.com.ar');

            });
            // Redirect to page
   return Redirect::to('/')
    ->with('message', 'Your message has been sent. Thank You!');


            //return View::make('contact');  
         }else{
   //return contact form with errors
            return Redirect::to('/')
             ->with('error', 'Feedback must contain more than 5 characters. Try Again.');

         }
     }
} 

