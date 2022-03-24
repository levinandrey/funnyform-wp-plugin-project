<?php

/**
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Funnyform
 */


/**
 *  Contact Form HTML
 **/

function form_contact_html(){
    $html = '
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12 col-lg-8 gy-4">
                <form class="row g-3 needs-validation" id="fform" method="post" enctype="multipart/form-data">
                    <h2>Funny Contact Form by Andrew Levin</h2>
    
                    <div class="col-md-6">
                        <label for="ff_firstname" class="form-label">First name</label>
                        <input type="text" class="form-control" id="ff_firstname" name="ff_firstname" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <label for="ff_lastname" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="ff_lastname" name="ff_lastname" placeholder="" value="" required="">
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
    
    
                    <div class="col-md-6">
                        <label for="ff_email" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-envelope-open"></i></span>
                            <input type="text" class="form-control" id="ff_email" name="ff_email" placeholder="you@example.com" value="" required="">
                            <div class="invalid-feedback">
                                Your email is required.
                            </div>
                        </div>
                    </div>
    
    
                    <div class="col-md-6">
                        <label for="ff_date" class="form-label">Date of Birth</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                            <input type="text" class="form-control" id="ff_date" name="ff_date" placeholder="2001-12-24" value="" required="">
                            <div class="invalid-feedback">
                                Your birth date is required.
                            </div>
                        </div>
                    </div>
    
    
    
                    <div class="col-md-6">
                        <label for="ff_phone" class="form-label">Phone number</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="text" class="form-control" id="ff_phone" name="ff_phone" placeholder="+12345678901" value="" required="">
                            <div class="invalid-feedback">
                                Your phone number is required.
                            </div>
                        </div>
                    </div>
    
    
                    <div class="col-md-6">
                        <label for="ff_file" class="form-label">Upload file</label>
                        <div class="input-group mb-3">                    
                            ' .wp_nonce_field("ff_file", "ff_file_nonce") . '
                            <input type="file" class="form-control" id="ff_file" name="ff_file">
                        </div>
                    </div>
    
    
    
                    <div class="row justify-content-center gy-3">
                        <div class="col-auto">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="true" id="ff_newsletters" name="ff_newsletters" checked>
                                <label class="form-check-label" for="ff_newsletters">
                                    Subscribe to our newsletters
                                </label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div>
                        </div>
                    </div>
    
    
                    <div class="row justify-content-center gy-2">
                        <div class="col-auto ">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="true" id="ff_privacy" name="ff_privacy" required>
                                <label class="form-check-label" for="ff_privacy">
                                    Agree to terms and conditions
                                </label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div>
                        </div>
                    </div>
    
    
                    <div class="row justify-content-center gy-3">
                        <div class="col-auto">
                            <button name="ff_form" id="ff_form" class="btn btn-primary" type="submit">Submit form</button>
                        </div>
                    </div>
    
                </form>
            </div>
        </div>
    </div>
    ';

    return $html;
}