<?php

namespace Includes\Modules\Leads;

class SimpleContact extends Leads
{
    public function __construct ()
    {
        parent::__construct ();
        parent::assembleLeadData(
            array(
                'county' => 'County',
                'phone_number' => 'Phone Number'
            )
        );
        parent::set('postType', 'Contact Submission');
        //parent::set('ccEmail', 'web@kerigan.com');
        parent::set('adminEmail', 'CHarcus@lmccares.org');
    }

    protected function showForm()
    {
        $form = file_get_contents(locate_template('template-parts/forms/contact-form.php'));
        $formSubmitted = (isset($_POST['sec']) ? ($_POST['sec'] == '' ? true : false) : false );
        ob_start();
        if($formSubmitted){
            if($this->handleLead($_POST)){
                return '<div class="alert alert-success">Thank you for your interest in foster parenting. We will contact you soon with training information, requirements and opportunities near you.</div>';
            }else{
                return '<div class="alert alert-danger">There was an error with your submission. Please try again.</div>';
                echo $form;
                return ob_get_clean();
            }
        }else{
            echo $form;
            return ob_get_clean();
        }
    }

    public function setupShortcode()
    {
        add_shortcode( 'contact_form', function( $atts ){
            return $this->showForm();
        } );
    }

}