bookmarks
=========
To setup:

1. Have php, php-mysql, apache and mysql setup and running
2. Link the CodeIgniter_2.1.3/ directory in the codebase to your doc_root/codeigniter (doc_root/codeigniter => CODE_ROOT/CodeIgniter_2.1.1/)
3. Create a user called 'db_user' with password 'db_password' and grant it all privileges on bookmarking.*
4. Make sure the db root user and password is setup properly in ./setup.sh
5. execute ./setup.sh
6. Try to access http://127.0.0.1/codeigniter/

To Do's

1. Refactoring of php controllers to remove duplicates
2. Controller actions are not transactional 
3. Search not implemented

Workarounds

1. To create a tag try adding a tag to a bookmark
2. setup.sh creates some test data. It can be used to reset the database with the test data in case something should go wrong.
