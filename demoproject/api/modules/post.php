<?php

/**
 * Post Class
 *
 * This PHP class provides methods for adding employees and jobs.
 *
 * Usage:
 * 1. Include this class in your project.
 * 2. Create an instance of the class to access the provided methods.
 * 3. Call the appropriate method to add new employees or jobs with the provided data.
 *
 * Example Usage:
 * ```
 * $post = new Post();
 * $employeeData = ... // prepare employee data as an associative array or object
 * $addedEmployee = $post->add_employees($employeeData);
 *
 * $jobData = ... // prepare job data as an associative array or object
 * $addedJob = $post->add_jobs($jobData);
 * ```
 *
 * Note: Customize the methods as needed to handle the addition of data to your actual data source (e.g., database, API).
 */

class Post{
    private $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function sendPayload($data, $remarks, $message, $code){
        $status = array(
            "remarks"=>$remarks, 
            "message"=>$message
        );

        http_response_code($code);
        return array(
            "status"=>$status,
            "payload"=>$data,
            "prepared_by"=>"Jasmin Andrea Turalba",
            "timestamp"=>date_create()
        );
    }
    /**
     * Add a new employee with the provided data.
     *
     * @param array|object $data
     *   The data representing the new employee.
     *
     * @return array|object
     *   The added employee data.
     */
    public function add_employees($data){
        $code = 0;
        $errmsg = "";
    
        $sql = "INSERT INTO employees(EMPLOYEE_ID, FIRST_NAME, LAST_NAME, EMAIL, HIRE_DATE, PHONE_NUMBER, SALARY, JOB_ID, DEPARTMENT_ID)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $data->EMPLOYEE_ID,
                $data->FIRST_NAME,
                $data->LAST_NAME,
                $data->EMAIL,
                $data->HIRED_DATE,
                $data->PHONE_NUMBER,
                $data->SALARY,
                $data->JOB_ID,
                $data->DEPARTMENT_ID,
                
            ]);
           

        } catch (\PDOException $e) {
            $errmsg = $e->getMessage();
             // Internal Server Error
        }
    
        return ["code" => $code, "errmsg" => $errmsg];
    }

    /**
     * Add a new job with the provided data.
     *
     * @param array|object $data
     *   The data representing the new job.
     *
     * @return array|object
     *   The added job data.
     */
    public function add_jobs($data){
       
    }
}

