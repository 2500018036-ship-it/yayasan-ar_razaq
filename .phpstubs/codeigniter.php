<?php
/**
 * CodeIgniter 3 PHPDoc Stubs
 *
 * File ini adalah stub khusus untuk membantu linter (misalnya Intelephense)
 * memahami property-property yang di-inject secara dinamis oleh CodeIgniter 3.
 *
 * File ini TIDAK dieksekusi oleh PHP pada saat runtime.
 * Tambahkan path file ini ke pengaturan "intelephense.stubs" di .vscode/settings.json.
 */

if (false) {
    /**
     * CodeIgniter base controller with all common magic-injected properties.
     *
     * @property CI_Session         $session
     * @property CI_Security        $security
     * @property CI_Input           $input
     * @property CI_Output          $output
     * @property CI_Config          $config
     * @property CI_Loader          $load
     * @property CI_Router          $router
     * @property CI_URI             $uri
     * @property CI_DB_query_builder $db
     * @property CI_Upload          $upload
     * @property CI_Email           $email
     * @property CI_Form_validation $form_validation
     * @property CI_Pagination      $pagination
     * @property CI_Image_lib       $image_lib
     */
    class CI_Controller
    {
        /** @var CI_Session */
        public $session;

        /** @var CI_Security */
        public $security;

        /** @var CI_Input */
        public $input;

        /** @var CI_Output */
        public $output;

        /** @var CI_Config */
        public $config;

        /** @var CI_Loader */
        public $load;

        /** @var CI_Router */
        public $router;

        /** @var CI_URI */
        public $uri;

        /** @var CI_DB_query_builder */
        public $db;

        /** @var CI_Upload */
        public $upload;

        /** @var CI_Email */
        public $email;

        /** @var CI_Form_validation */
        public $form_validation;

        /** @var CI_Pagination */
        public $pagination;

        /** @var CI_Image_lib */
        public $image_lib;

        /**
         * @return static
         */
        public static function &get_instance()
        {
        }
    }
}
