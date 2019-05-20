<?php

/**
 * This class file is a library for Text related services
 *
 * PHP versions 7.2.12
 * @version 1: /library/TextService 2019-05-01 $
 * @category Library
 * @author Rahul Naik
 * @since File available since Release 1.0  
 */
class TextService {

    /**
     * Initialize TextService 
     * 
     * @method initialize
     * @access public
     * @since 1.0.0
     * @author Rahul N. 
     */
    public function initialize() {
        // Do nothing
    }

    /**
     * Manage errors in application
     * Error will only display in dev and test environment
     * In case of stage and production environment 500 page will be displayed 
     * 
     * @method getError
     * @access public
     * @since 1.0.0
     * @global object $config
     * @param object $e
     * @param string $url
     * @param string $type
     * @author Rahul N. 
     * @example TextService::getError($error);
     */
    public static function getError($e, $url, $type = 'Exception') {
        global $config;
        if (ENV == 'dev' || ENV == 'test') {
            echo 'Error caught in programming <br>';
            echo "Error Code: " . $e->getCode();
            echo "<br> Error Body: <pre>";
            print_r($e->getMessage());
            exit;
        }
        header('Location: ' . $url);
    }

    /**
     * Format string where required
     * 
     * @method format
     * @access public
     * @since 1.0.0
     * @param string $string
     * @type string $type ex, ucfirst
     * @return string
     * @author Rahul N. 
     * @example TextService::format("good morning user");
     */
    public static function format($string, $type = 'ucwords') {
        $support = ['ucwords', 'ucfirst', 'strtolower', 'strtoupper', 
                    'strlen', 'sha1', 'md5', 'str_word_count', 'lcfirst'];
        return (in_array($type, $support)) ? 
            $type(strtolower($string)) : 
            'format supports only mentioned functions: ' . implode(', ', $support);
    }

    /**
     * Print data in dev or test environment
     * 
     * @method p
     * @since 1.0.0
     * @param mixed $data
     * @author Rahul N. 
     * @example 1. TextService::P($data);
     * @example 2. TextService::P([$request, $responce]);
     */
    public static function p(array $data) {
        if (ENV == 'dev' || ENV == 'test') {
            echo '<pre>';
            print_r($data);
            exit;
        }
    }
    
    /**
     * Create a name from name string, get first name and last name 
     * 
     * @method makeName
     * @since 1.0.0
     * @param string $name
     * @return array
     * @author Rahul N. 
     * @example 1. John Doe      -> salutation - '',    first name - 'John',      last name - 'Doe'
     * @example 2. John K. Doe   -> salutation - '',    first name - 'John',      last name - 'K. Doe'
     * @example 3. JohnK.Doe     -> salutation - '',    first name - 'JohnK.Doe', last name - ''
     * @example 4. Dr. John Doe  -> salutation - 'Dr.', first name - 'John',      last name - 'Doe'
     * @example 5. John          -> salutation - '',    first name - 'John',      last name - ''
     */
    public static function makeName($name) {
        ## Uncomment constant or add it to constants/config file, add if required
        /**
         * define('SALUATATIONS', [
         *          'Mr',
         *          'Mrs',
         *          'Ms',
         *          'Dr',
         *          'Prof',
         *          'Mr.',
         *          'Mrs.',
         *          'Ms.',
         *          'Dr.',
         *          'Prof.',
         *      ]
         * );
         */
        if($name == '') { return []; }
        
        $name = explode(' ', $name);
        $salutation = '';
        
        // Check if name contains salutation
        if(in_array($name[0], SALUATATIONS)) {
            $salutation = array_shift($name);
        }
        if(count($name) > 1) {
            $first_name = array_shift($name);
            $last_name  = implode(' ', $name);
        } else {
            $first_name = array_shift($name);
            $last_name  = '';
        }
        return [
            'salutation' => ucfirst($salutation), 
            'first_name' => ucfirst($first_name), 
            'last_name'  => ucfirst($last_name)
        ];
    }
    
    /**
     * Make address from user defined variables 
     * 
     * @method makeAddress
     * @since 1.0.0
     * @param array $data 
     * @return string
     * @author Rahul N.  
     * @example TextService::makeAddress(['address_line_1' => 'London']);
     */
    public static function makeAddress(array $data, string $separater = ', ') {
        $address_line_1 = $data['address_line_1'];
        $address_line_2 = $data['address_line_2'];
        $city           = $data['city'];
        $state          = $data['state'];
        $country        = $data['country'];
        $zip_code       = $data['zip_code'];
        $address        = '';
        $address       .= ($address_line_1 != '') ? $address_line_1              : '';
        $address       .= ($address_line_2 != '') ? $separater . $address_line_2 : '';
        $address       .= ($city != '')           ? $separater . $city           : '';
        $address       .= ($state != '')          ? $separater . $state          : '';
        $address       .= ($country != '')        ? $separater . $country        : '';
        $address       .= ($zip_code != '')       ? ' - ' . $zip_code            : '';
        
        return ($address != '') ? $address . '.' : '';
    }
    
    /**
     * Get date in format required, input date must be in Y-m-d format
     * It will work best with date captured from input type date html element
     * 
     * @method getDateInFormat
     * @since 1.0.0
     * @param string $date
     * @param string $format
     * @return date | string
     * @author Rahul N. 
     * @example TextService::getDateInFormat('2019-05-01');
     */
    public static function getDateInFormat($date = '', $format = 'd/m/Y') {
        if($date == '') return '';
        
        $date = date_create($date);
        return date_format($date, $format);
    }

}
