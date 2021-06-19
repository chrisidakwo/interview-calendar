# Interview Calendar

## Get Started
To get started, clone the repository and follow the steps below:
- `cd` into the application directory and install `PHP` packages using `composer install`
- Next, migrate the database tables and seed default data using `php artisan migrate --seed`
- Finally, run the application using the `php artisan serve` command
- For tests,`cd` into the database directory to create the `sqlite` database using this command: `touch database.sqlite`

**Note:** There's no need to install `JS` packages. `app.css` already has the compiled output

## Using the Application
The application has three types of users: `admin`, `interviewer`, and `candidate`. These are defined as roles in the `users` record. Access to pages and actions is defined by the role/type of the authenticated user. 

### Admin
- An admin user will be created when you seed the database using the `--seed` flag or `php artisan db:seed` command.
- Email and password for the admin are: `admin@inventory.com` and `password`
- Log into the admin to create interviewers. Default password for any user account created is `password`
  
### Interviewer
- To access an interviewer account, log out of the admin and log in using any of the created interviewer record. Not forgetting to use the default password: `password`
- An interviewer can create candidates and interviews, add candidates to interviews, and add other interviewers to an interview
- However, to add any of this, an interviewer must have set available time slots

### Candidate
- To access a candidate account, use any the created candidate record.
- A candidate can select a convenient time for an interview from a list of available time slots for each day. The available time slot is gotten from the candidate's availability and availability of associated interviewers.
- To select an interview time, a candidate must have set available time slots


## REST API
- From the API, you can retrieve a list of available time slots for a given interview using the endpoint:
  `http://interview.test/api/interviews/{interview_id}/available-slots` where `interview_id` represents the interview ID
  
**API Documentation Link:** https://documenter.getpostman.com/view/4566306/TzeZD6QE

