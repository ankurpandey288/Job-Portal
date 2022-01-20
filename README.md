# InfyJobs


### Process to setup project : 
- Clone the repo
- Set your database information into `.env`
    - Set DB env variables
    - Set Mail env variables
- Run `composer install`
- Run `npm install`
- Run `npm run dev`
- Run `php artisan migrate`
- And you are ready to go.

#### Commit Rules :
There are some standard commit rules that helps you to underhand what code are committed by reading specific commit. 
Follow the given rules while committing :  
- Wrap lines at 72 characters
- Follow the conversational commit rules e.g (`<type>[module name / scope]: <description>`)
 - You can find commit types and module names into below section.  
 - Commit should be done as : `feat(users): users crud added`
 
##### Commit Types
    - feat (use this when you want to commit new feature) 
    - refactor (use this when some code refactored)
    - style (use this when style related changes are made)
    - fix (use this when you have fixed some bugs/issues)
    - docs (use this when docs related changes are made)
    - chore (use this when composer/package or any other libraries are installed)
    
