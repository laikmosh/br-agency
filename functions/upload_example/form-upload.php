<?php

// ------------------------------ FORM Configuration ---------------------------------------

// --- Some default variables ---
$success_message   = "<p class='message'>Thanks for your message!</p>";

// --- All form fields as nested array ---
// using html form field name => template field nam, from the page you're going to create
$form_fields = array(
    'images'                => array('type' => 'file', 'required' => true)
);

// --- WireUpload settings ---
$upload_path        = $config->paths->assets . "files/.tmp_uploads/"; // tmp upload folder
$file_extensions    = array('jpg', 'jpeg', 'gif', 'png');
$max_files          = 3;
$max_upload_size    = 1*1024*1024; // make sure PHP's upload and post max size is also set to a reasonable size
$overwrite          = false;

// --- Page creation settings ---
$template           = "usr_images"; // the template used to create the page
$parent             = $pages->get("/usr_images/");
$file_field         = "profile_image";
$page_fields        = array();

// $page_fields = define the fields (except file) you want to save value to a page
// this is for the form process to populate page fields.
// Your page template must have the same field names existent


// ------------------------------ FORM Processing ---------------------------------------

// ------------------------------ FORM Processing ---------------------------------------

$errors            = null;
$success           = false;

// helper function to format form errors
function showError($e){
    return "<p class='error'>$e</p>";
}

// dump some variables
// var_dump($_FILES,$_POST,$_SESSION);

/**
 * Cast and save field values in array $form_fields
 * this is also done even form not submited to make populating the form later easier.
 *
 * Also used for pupulating page when form was valid
 */
$required_fields = array();
foreach($form_fields as $key => $f){
    // store required fields in array
    if($f['required']) $required_fields[] = $key;
}




/**
 * form was submitted, start processing the form
 */

if($input->post->action == 'send'){

    // validate CSRF token first to check if it's a valid request
    if(!$session->CSRF->hasValidToken()){
        $errors['csrf'] = "Form submit was not valid, please try again.";
    }

    /**
     * Ceck for required fields and make sure they have a value
     */
    foreach($required_fields as $req){

        // required upload file field
        if($form_fields[$req]['type'] == 'file'){
            if(empty($_FILES[$req]['name'][0])){
                $errors[$req] = "Select files to upload.";
            }
        }
    }

    /**
     * if no required errors found yet continue file upload form processing
     */
    if(empty($errors)) {

        // RC: create temp path if it isn't there already
        if(!is_dir($upload_path)) {
            if(!wireMkdir($upload_path)) throw new WireException("No upload path!");
        }

        // setup new wire upload
        $u = new WireUpload($file_field);
        $u->setMaxFiles($max_files);
        $u->setMaxFileSize($max_upload_size);
        $u->setOverwrite($overwrite);
        $u->setDestinationPath($upload_path);
        $u->setValidExtensions($file_extensions);

        // start the upload of the files
        $files = $u->execute();

        // if no errors when uploading files
        if(!$u->getErrors()){

            // create the new page to add field values and uploaded images
            $uploadpage = new Page();
            $uploadpage->template = $template;
            $uploadpage->parent = $parent;

            // add title/name and make it unique with time and uniqid
            $uploadpage->title = date("d-m-Y H:i:s") . " - " . uniqid();

            // RC: for safety, only add user uploaded files to an unpublished page, for later approval
            // RC: also ensure that using v2.3+, and $config->pagefileSecure=true; in your /site/config.php
            // $uploadpage->addStatus(Page::statusUnpublished);
            $uploadpage->save();

            // Now page is created we can add images upload to the page file field
            foreach($files as $filename) {
                $uploadpage->$file_field = $upload_path . $filename;
                // remove tmp file uploaded
                unlink($upload_path . $filename);
            }
            $uploadpage->save();

            // $success_message .= "<p>Page created: <a href='$uploadpage->url'>$uploadpage->title</a></p>";
            $success = true;

            // reset the token so no double posts happen
            // also prevent submit button to from double clicking is a good pratice
            $session->CSRF->resetToken();

        } else {
            // errors found
            $success = false;

            // remove files uploaded
            foreach($files as $filename) unlink($upload_path . $filename);

            // get the errors
            if(count($u->getErrors()) > 1){ // if multiple error
                foreach($u->getErrors() as $e) {
                    $errors[$file_field][] = $e;
                }
            } else { // if single error
                $errors[$file_field] = $u->getErrors();
            }
        }
    }
}


?>

<!-- ========================= FORM HTML markup  ================================== -->

<?php

/**
 * Some vars used on the form markup for error and population of fields
 *
 * $errors[fieldname]; to get errors
 * $form_fields[fieldname]['value'];
 *
 * Some helper function to get error markup
 * echo showError(string);
 *
 * Prevent CSRF attacks by adding hidden field with name and value
 * you an get by using $session->CSRF
 * $session->CSRF->getTokenName();
 * $session->CSRF->getTokenValue();
 *
 * $errors['csrf']; used to check for CSRF error
 *
 */

?>
<link rel="stylesheet" type="text/css" href="<?=cacher('/agency/site/templates/functions/upload_example/form.css')?>">
<script src="<?=cacher('/agency/site/templates/functions/upload_example/form.js')?>"></script>


<separador><span>Galería de imágenes</span></separador>

<?php if(!$success) : ?>

    <?php if(!empty($errors)) echo showError("Form contains errors"); ?>
    <?php if(!empty($errors['csrf'])) echo showError($errors['csrf']); ?>

    <form name="myform" class="myform" id="myform" method="post" action="./" enctype="multipart/form-data">

        <input type="hidden" name="<?php echo $session->CSRF->getTokenName(); ?>" value="<?php echo $session->CSRF->getTokenValue(); ?>"/>

        <div class="row <?php if(isset($errors['images'])) echo "error";?>">
<!--             <label for="profile_image"></label><br/>
            <input type="file" name="profile_image" id="profile_image" accept="image/jpg,image/jpeg,image/gif,image/png"/> --><!-- tag para multi: multiple="multiple" agregar [] en name-->
<!--             <input type="file" name="profile_image" id="profile_image" accept="image/jpg,image/jpeg,image/gif,image/png" hidden/> 
            <div class="foto_label" id="profile_image_uploader" onclick="$('#profile_image').click()">
                <div class="foto_descr">
                    <div class="foto_descr_icono"><i class="fa fa-upload" aria-hidden="true"></i></div>
                    <div class="foto_descr_texto">Arrastra una foto de perfil aquí, o haz click para seleccionar un archivo.</div>
                </div>
                <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="/>
            </div> -->
            <?php
            // show upload errors
            if(isset($errors['images'])){
                // if multiple errors
                if(is_array($errors['images'])){
                    foreach($errors['images'] as $e){
                        echo showError($e);
                    }
                } else { // if single error
                    echo showError($errors['images']);
                }
            }
            ?>
        </div>
        <div class="row">
            <input type="hidden" name="action" id="action" value="send"/>
            <input type="submit" name="submit" id="submit" value="Submit"/>
        </div>
    </form>

<?php else: ?>

    <p><?php echo $success_message; ?></p>

<?php endif; ?>

