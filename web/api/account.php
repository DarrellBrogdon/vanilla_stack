<?php
require '../../vendor/autoload.php';

class Account {
    const EX_UNAUTHORIZED = 1001;

    /**
     * @property Object $dbh The database handle
     */
    private $dbh;
    
    /**
     * The constructor
     * 
     * Sets up the database connection.
     */
    public function __construct() {
        // $DB_HOST   = isset($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : getenv('DB_HOST');
        // $DB_PORT   = isset($_ENV['DB_PORT']) ? $_ENV['DB_PORT'] : getenv('DB_PORT');
        // $DB_NAME   = isset($_ENV['DB_NAME']) ? $_ENV['DB_NAME'] : getenv('DB_NAME');
        // $DB_USER   = isset($_ENV['DB_USER']) ? $_ENV['DB_USER'] : getenv('DB_USER');
        // $DB_PASS   = isset($_ENV['DB_PASS']) ? $_ENV['DB_PASS'] : getenv('DB_PASS');
        // $this->dbh = new PDO("pgsql:host={$DB_HOST};port={$DB_PORT};dbname={$DB_NAME}", $DB_USER, $DB_PASS);
    }

    /**
     * authenticate
     * 
     * Authenticate a account
     * 
     * @param Object $params An Object of valid column names to be used when verifying
     * @return Array `['id' => Int, 'email_address' => String, 'name' => String, 'authentication_token' => String]`
     */
    public function authenticate($params) {
        if (password_verify($params->password, password_hash('asdf', PASSWORD_DEFAULT))) {
            return [
                'id' => 1,
                'email_address' => 'foo@bar.com', 
                'name' => 'Foo Bar',
                'authentication_token' => '1234567890',
            ];
        } else {
            throw new Exception("Unauthorized", self::EX_UNAUTHORIZED);
        }
    }

    /**
     * resetPassword
     * 
     * Reset the user's password
     * 
     * @param Object $params An Object of valid column names to be used when verifying
     * @return Array `['success' => Bool]`
     */
    public function resetPassword($params) {
        return ['success' => true];
    }

    /**
     * getAccount
     * 
     * Get an account
     * 
     * @param Object $params An Object of valid column names to be used when verifying
     * @return Array `['id' => Int, 'first_name' => String, 'last_name' => String, 'email_address' => String]`
     */
    public function getAccount($params) {
        return [
            'id' => 1,
            'first_name' => 'Foo',
            'last_name' => 'Bar',
            'email_address' => 'foo@bar.com',
        ];
    }
}