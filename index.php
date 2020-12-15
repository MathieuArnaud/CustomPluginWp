<?php

/*
Plugin Name: MathSimplon
Plugin URI: https://roulette-ruse.com/
Description: Just for fun
Author: MathieuArnaud
Author URI: https://roulette-ruse.com/portfolio
Text Domain: simplonplug
Domain Path: /languages/
Version: 1.0.0
*/


add_action('admin_menu', 'create_form_upload');

/**
 * func create_form_upload()
 * init the plugin menu in back then launch func :
 * create form html before testing in func_test();
 *  func_add_form_and_test() -> func_test();
 * 
 * src :  https://blog.idrsolutions.com/2014/07/creating-wordpress-plugin-part-2-uploading-media-linking-web-service/
 * 
 * 
 */
function create_form_upload()
{
    add_menu_page(
        'custom page',
        'MyCustomPlug',
        'manage_options',
        'test-plugin',
        'func_add_form_and_test' //
    );
}

function func_add_form_and_test()
{
    func_test();
?>




    <div class="div-p">

        <h1 class="title-p">Welcome</h1>
        <h2 class="sub-title-p">This is just for fun</h2>

        <!-- Form to handle the upload - The enctype value here is very important -->
        <form method="post" enctype="multipart/form-data" class="form-p">
            <label for="files_uploaded" class="label-border">
                Select your file ...
            </label>
            <input type='file' id='files_uploaded' name='files_uploaded' style="visibility:hidden;"></input>
            <input type="submit" value="Add" class="input-p">
            <?php
            //  submit_button('Add files') if u want to use func wp submit just remove input submit in html
            ?>
        </form>

    </div>

    <?php

}


function func_test()
{
    // First check if the file appears on the _FILES array
    if (isset($_FILES['files_uploaded'])) {
        $test = $_FILES['files_uploaded'];

        // Use the wordpress function to upload
        // files_uploaded corresponds to the position in the $_FILES array
        // 0 means the content is not associated with any other posts
        $uploaded = media_handle_upload('files_uploaded', 0);
        // Error checking using WP functions
        if (is_wp_error($uploaded)) {
    ?>
            <p class="error"><?php echo "Error : " . $uploaded->get_error_message(); ?></p>
        <?php

        } else {
        ?>

            <p class="gg"><?php echo "GG your file(s) is(are) now added!"; ?></p>

<?php
        }
    }
}
function shortcode_bienvenue()
{
    return "<h2>Bienvenue chez moi !</h2>";
}


function get_text()
{
    return 'on verra';
}


function get_js($param)
{
    return '<script src="' . $param . '"></script>';
}

add_shortcode('txt', 'get_js');
add_shortcode('txt', 'get_text');
add_shortcode('bienvenue', 'shortcode_bienvenue');


function admin_enqueue_scripts()
{
    wp_enqueue_script('main', plugin_dir_url(__FILE__) . 'main.js');
    wp_enqueue_style('admin-css', plugin_dir_url(__FILE__) . 'admin-css.css');
}
add_action('admin_enqueue_scripts', 'admin_enqueue_scripts');

?>