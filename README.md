# Employee Management docs

Clone the repo

```bash
  git clone https://github.com/shubham4agrawal/employee_management/
  cd employee_management/
```  

Install composer packages
```bash
  composer install
```
Copy the .env.example file to .env
```bash
  cp .env.example .env
  php artisan key:generate
```  
Run migration command to create database and tables
```bash
  php artisan migrate
```

Run the artisan command to insert fake data. Use the command in the speified order
```bash
  php artisan insert:fake-data Departments 1
  php artisan insert:fake-data Employees {count}
  php artisan insert:fake-data ContactNumbers {count}
  php artisan insert:fake-data Addresses {count}
```

To serve the application locally, run the below command
```bash
  php artisan serve
```


## API Reference

###   Department Endpoints
#### Get all departments

```http
  GET /api/departments
```

#### Get department by id
```http
  GET /api/departments/${id}
```

| Parameter | Type      | Description                            |
|:----------|:----------|:---------------------------------------|
| `id`      | `integer` | **Required** Id of department to fetch |




#### Create a new department
```http
  POST /api/departments/
```

| Request body param | Type     | Description                               |
|:-------------------|:---------|:------------------------------------------|
| `name`             | `string` | **Required** name of department to create |

Request body example:
```json
{
    "name": "department-name"
}
```

#### Update existing department
```http
  PUT /api/departments/${id}
```

| Parameter | Type     | Description                               |
|:----------|:---------|:------------------------------------------|
| `name`    | `string` | **Required** name of department to update |

Request body example:
```json
{
    "name": "department-name"
}
```

#### Delete department

```http
  DELETE /api/departments/${id}
```


###   Employee Endpoints
#### Get all Employees

```http
  GET /api/employees
```

| Parameter       | Type      | Description                    |
|:----------------|:----------|:-------------------------------|
| `firstname`     | `string`  | search on the firstname        |
| `lastname`      | `string`  | search on the lastname         |
| `department_id` | `integer` | filter employees by department |
| `email`         | `string`  | filter employees by email      |


#### Get employees by id
```http
  GET /api/employees/${id}
```

| Parameter | Type      | Description                          |
|:----------|:----------|:-------------------------------------|
| `id`      | `integer` | **Required** Id of employee to fetch |




#### Create a new employee
```http
  POST /api/employees/
```
| Request body param                 | Type      | Description                                              |
|:-----------------------------------|:----------|:---------------------------------------------------------|
| `firstname`                        | `string`  | **Required** firstname of employee                       |
| `lastname`                         | `string`  | **Required** lastname of employee                        |
| `department_id`                    | `integer` | **Required** department_id of employee he/she belongs to |
| `email`                            | `string`  | **Required** email id of the employee                    |
| `contact_numbers`                  | `array`   | **Required** array of object of employee's contact num   |
| `contact_numbers.*.contact_number` | `string`  | **Required** contact number of the employee              |
| `addresses`                        | `array`   | **Required** array of object of the employee's address   |
| `addresses.*.address`              | `string`  | **Required** address of the employee                     |
| `addresses.*.city`                 | `string`  | **Required** city of the employee                        |
| `addresses.*.state`                | `string`  | **Required** state of the employee                       |
| `addresses.*.pin_code`             | `string`  | **Required** pin code of the employee                    |


Request body example:
```json
{
    "firstname": "John",
    "lastname": "Doe",
    "department_id": 2,
    "email": "johndoe@example",
    "contact_numbers": [
      {
        "contact_number": "8181818181"
      },
       {
        "contact_number": "9191919191"
        }
    ],
    "addresses": [
      {
        "address": "Andheri West",
        "city": "Mumbai",
        "state": "Maharashtra",
        "pin_code": "400 001"
      }
    ]
}
```

#### Update existing employee
```http
  PUT /api/employees/${id}
```
| Request body param                 | Type       | Description                                 |
|:-----------------------------------|:-----------|:--------------------------------------------|
| `firstname`                        | `string`   | firstname of employee                       |
| `lastname`                         | `string`   | lastname of employee                        |
| `department_id`                    | `integer`  | department_id of employee he/she belongs to |
| `contact_numbers`                  | `array`    | array of object of employee's contact num   |
| `contact_numbers.*.contact_number` | `string`   | contact number of the employee              |
| `addresses`                        | `array`    | array of object of the employee's address   |
| `addresses.*.address`              | `string`   | address of the employee                     |
| `addresses.*.city`                 | `string`   | city of the employee                        |
| `addresses.*.state`                | `string`   | state of the employee                       |
| `addresses.*.pin_code`             | `string`   | pin code of the employee                    |

Request body example:
```json
{
    "firstname": "John",
    "lastname": "Doe",
    "department_id": 2,
    "contact_numbers": [
      {
        "contact_number": "8181818181"
      }
    ],
    "addresses": [
      {
        "address": "Andheri East",
        "city": "Mumbai",
        "state": "Maharashtra",
        "pin_code": "400 093"
      }
    ]
}
```

#### Delete Employee

```http
  DELETE /api/employees/${id}
```

